<?php

namespace App\Http\Controllers\user;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Sale;
use App\Model\Product;
use App\Model\Cart;
use App\Model\CartDetail;
use App\Model\Address;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('login',['cart'=>'cart']);
        }
        $category = Category::where('active',1)->orderBy('id','DESC')->limit(6)->get();

        $data['listMenu'] = $category;
        $data['category'] = $category;
        // $data['city'] = City::find(Auth::user()->tinh);
        // $data['district'] = District::find(Auth::user()->huyen);
        // $data['town'] = Town::find(Auth::user()->xa);
        return view('user.cart', $data);
    }
    public function store(Request $request)
    {
        ///sale
        $listSale = Sale::with('saleProduct')
            ->where('sale',1)
            ->where('start_time','<=',date('Y-m-d H:i', time()))
            ->where('end_time','>=',date('Y-m-d H:i', time()))->get();
        
        $saleCart = Sale::with('saleProduct')
            ->where('sale',1)
            ->where('type',1)
            ->where('start_time','<=',date('Y-m-d H:i', time()))
            ->where('end_time','>=',date('Y-m-d H:i', time()))->get();

        $statement = DB::select("SHOW TABLE STATUS LIKE 'purchase_orders'");
        $nextId = $statement[0]->Auto_increment;

        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $cartDetail = CartDetail::with('product')
                                ->where('cart_id', $cart[0]->id)
                                ->whereIn('product_id', $request->product)
                                ->get()->toArray();
        $saleProduct = checkSale($cartDetail, $listSale, 1);
        // dd($saleCart);
        $listOder = [];
        $total = 0;
        $list_sale = '';
        foreach ($saleProduct as $key => $value) {
            $price = (isset($value['price_sale'])) ? $value['price_sale'] : $value['price'];
            $listOder[] = [
                'amount' => $value['amount'],
                'price' => $price,
                'purchase_order_id' => $nextId,
                'product_id' => $value['product_id'],
                'product_classification_id' => $value['product_classification_id']
            ];
            if(isset($value['list_sale'])){
                $list_sale .= ','.$value['list_sale'];
            }
            $total += $value['amount'] * $value['product']['price'];
        }

        foreach ($saleCart as $key => $value) {
            $list_sale .= ','.$value->id;
            if($value->unit == 'percent'){
                $total -= $total*($value->discount/100);
            }else{
                $total -= $value->discount;
            }
        }
        $address = json_decode(Auth::user()->address);
        if($address->tinh == '01'){
            $transport_fee = 20000;
        }else{
            $transport_fee = 30000;
        }
        $total += $transport_fee;
        DB::table('purchase_orders')->insert(
            ['delivery_address' => $address->diachi.' '.Address::findId('xa', $address->xa)->name_town.' '.Address::findId('huyen', $address->huyen)->name_district.' '.Address::findId('tinh', $address->tinh)->name_city,
             'total' => $total,
             'date' => date('Y-m-d H:i:s', time()),
             'status' => 0,
             'transport_fee' => $transport_fee,
            //  'list_sale' => $list_sale,
             'user_id' => Auth::user()->id,
             ]
        );
        // dd($listOder);
        DB::table('purchase_order_details')->insert($listOder);
        DB::table('cart_details')
                ->whereIn('product_id', $request->product)
                ->delete();
        return redirect('/purchase');
    }

    public function ajaxGetCart(Request $request)
    {
        $listSale = Sale::with('saleProduct')
            ->where('sale',1)
            ->where('start_time','<=',date('Y-m-d H:i', time()))
            ->where('end_time','>=',date('Y-m-d H:i', time()))->get();
        
        $saleCart = Sale::with('saleProduct')
            ->where('sale',1)
            // ->where('type',1)
            ->where('start_time','<=',date('Y-m-d H:i', time()))
            ->where('end_time','>=',date('Y-m-d H:i', time()))->get();
        if(Auth::user()){
            $cart = DB::table('carts')
                        ->where('carts.user_id',Auth::user()->id)
                        ->first();
            $cart_id = $cart->id;
            $arrIdProduct = DB::table('carts')
                                ->join('cart_details','carts.id','cart_details.cart_id')
                                ->where('carts.user_id',Auth::user()->id)
                                ->where('cart_id', $cart_id)
                                ->pluck('product_id');
            $listClassify = DB::table('cart_details')->whereIn('cart_details.product_id', $arrIdProduct)
                                ->join('product_classifications', 'product_classifications.id', 'cart_details.product_classification_id')
                                ->join('classifies', 'product_classifications.classify_id', 'classifies.id')
                                ->select('classifies.*','cart_details.product_classification_id')->get();
            $arrClassify = [];
            foreach ($listClassify as $key => $value) {
                $arrClassify[$value->product_classification_id] = $value->type.' '.$value->value;
            }
            $product = Product::whereIn('id', $arrIdProduct)->with(['cartDetail'])->get();
            $saleProduct = checkSale($product, $listSale);
            $result['arrClassify'] = $arrClassify;
            $result['saleProduct'] = $saleProduct;
            $result['saleCart'] = $saleCart;
            // dd($saleProduct);
            return json_encode($result);
        }else{

        }
    }
    public function addCart($id, $classify_product, $amount)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $classify_product = ($classify_product=='') ? 0 : $classify_product;
        if(isset($cart[0]->user_id)){
            $cartDetail = CartDetail::where('cart_id', $cart[0]->id)
                                    ->where('product_id', $id)
                                    ->where('product_classification_id', $classify_product)
                                    ->get();
            // dd($cartDetail);
            if(isset($cartDetail[0]->product_id)){
                DB::table('cart_details')
                ->where('product_id', $id)
                ->where('product_classification_id', $classify_product)
                ->where('cart_id', $cart[0]->id)
                ->update(['amount' => $cartDetail[0]->amount + $amount]);
            }else{
                $cartDetail = new CartDetail();
                $cartDetail->cart_id = $cart[0]->id;
                $cartDetail->product_id = $id;
                $cartDetail->amount = $amount;
                if($classify_product != 0){
                    $cartDetail->product_classification_id = 0;
                }
                $cartDetail->save();
            }

        }else{
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();

            $cartDetail = new CartDetail();
            $cartDetail->cart_id = $cart->id;
            $cartDetail->product_id = $id;
            $cartDetail->amount = $amount;
            if($classify_product != NULL){
                $cartDetail->product_classification_id = 0;
            }
            $cartDetail->save();
        }
    }

    public function ajaxDeleteProduct(Request $request)
    {
        if(Auth::user()){
            $cart = Cart::where('user_id', Auth::user()->id)->get();
            DB::table('cart_details')
                ->where('cart_id', $cart[0]->id)
                ->where('product_id', $request->product)
                ->delete();
            return 'ok';
        }else{
            return 'false';
        }
    }
    public function ajaxUpdateAmount(Request $request)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $classify_product = ($request->product_classification == 0 || $request->product_classification == null) ? 0 : $request->product_classification;
        DB::table('cart_details')
                ->where('product_id', $request->product)
                ->where('product_classification_id', $classify_product)
                ->where('cart_id', $cart[0]->id)
                ->update(['amount' => $request->amount]);
        return 'ok';
    }
}
