<?php

namespace App\Http\Controllers\user;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Classify;
use App\Model\Cart;
use App\Model\CartDetail;
use App\Model\ProductClassification;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::where('active',1)->orderBy('id','DESC')->limit(6)->get();

        $data['listMenu'] = $category;
        $data['new_product'] = Product::with(['productClassify' => function($c){
        }])->where('active', 1)->orderBy('id','DESC')->limit(8)->get();

        foreach ($category as $key => $value) {
            $category[$key]['list_product'] = Product::with(['productClassify' => function($c){
            }])->where('category_id', $value->id)->where('active',1)->limit(8)->get();
        }
        $data['category'] = $category;

        return view('user.home', $data);
    }
    public function ajaxGetProduct(Request $request)
    {
        $product =  Product::with(['productClassify' => function($c){
        }])->where('id', $request->id)->get()->toArray();
        foreach ($product as $key => $value){
            foreach ($value['product_classify'] as $k => $cf){
                $product[$key]['product_classify'][$k]['classify'] = Classify::find($cf['classify_id'])->toArray();
            }
        }
        return response()->json($product);
    }
    public function ajaxAddCart(Request $request)
    {
        $count = 0;
        $carts = json_decode($request->carts);
        $check_cart =  Cart::where('user_id', Auth::user()->id)->get();
        if(!empty($check_cart->toArray())){
            $check_cart = $check_cart[0];
            // nếu người dùng đã có giỏ hàng thì tìm từng sp
            foreach ($carts as $v){
                $pc = ProductClassification::find($v->product_classify_id);
                $p = Product::find($v->id);
                if(!$pc || empty($pc->toArray()) || !$p || empty($p->toArray())){
                    continue;
                }
                $detail =  CartDetail::where('cart_id',$check_cart->id)
                ->where('product_id', $v->id)
                ->where('product_classification_id', $v->product_classify_id)->first();
                if(!is_null($detail)){
                    //nếu có sp trong giỏ hàng thì thêm số lượng
                    $detail->amount = $v->amount+$detail->amount;
                    $detail->save();
                }else{
                    // chưa có sp trong giỏ hàng thì theem sp vào
                    $detail_new = new CartDetail();
                    $detail_new->product_id = $v->id;
                    $detail_new->cart_id = $check_cart->id;
                    $detail_new->product_classification_id = $v->product_classify_id;
                    $detail_new->amount = $v->amount;
                    $detail_new->save();
                }
            }
            $count = CartDetail::where('cart_id',$check_cart->id)->count();
        }else{
            // chưa có giỏ hàng thì tạo giỏ hàng
            $cart_new = new Cart();
            $cart_new->user_id = Auth::user()->id;
            $cart_new->save();
            foreach ($carts as $v){
                $pc = ProductClassification::find($v->product_classify_id);
                $p = Product::find($v->id);
                if(!$pc || empty($pc->toArray()) || !$p || empty($p->toArray())){
                    continue;
                }
                // chưa có sp trong giỏ hàng thì theem sp vào
                $detail_new = new CartDetail();
                $detail_new->product_id = $v->id;
                $detail_new->cart_id = $cart_new->id;
                $detail_new->product_classification_id = $v->product_classify_id;
                $detail_new->amount = $v->amount;
                $detail_new->save();
            }
            $count = CartDetail::where('cart_id',$cart_new->id)->count();
        }
        
        return response()->json(['count'=>$count]);
    }

    public function ajaxCountCart(Request $request)
    {
        $check_cart =  Cart::where('user_id', Auth::user()->id)->get();
        $count = 0;
        if(!empty($check_cart->toArray())){
            $count = CartDetail::where('cart_id',$check_cart[0]->id)->count();
        }
        return response()->json(['count'=>$count]);

    }
}
