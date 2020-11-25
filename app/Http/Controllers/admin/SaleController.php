<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sale;
use App\Model\SaleProduct;
use App\Model\Category;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // lấy ds các khuyến mãi và sắp xếp start_time từ lớn đến bé
        $listsale = Sale::orderBy('start_time', 'DESC')->get();
        $data['listsale'] = $listsale;
        return View('admin/sale', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // gọi hàm khi vào trang tạo km
        $data[''] = '';
        return View('admin/create_sale', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //lưu km
        $sale = new Sale();
        $sale->name = $request->name;
        $sale->sale = $request->sale;
        $sale->code = $request->code;
        $sale->type = $request->type;

        $sale->start_time = date('Y-m-d H:i:s', strtotime($request->start_time));
        $sale->end_time = date('Y-m-d H:i:s', strtotime($request->end_time));

        // check xem có chọn không giới hạn số lượng
        if($request->unlimit){
            $sale->amount_applied = 'unlimit';
        }else{
            $sale->amount_applied = $request->amount_applied;
        }

        // check từng phương thức khuyến mãi để lưu vào DB cho đúng
        switch ($request->type) {
          
            case 2:
                $sale->method = 'Chiết khấu theo từng sản phẩm';
                if($request->all){
                    $sale->discount = $request->discount;
                    $sale->unit = $request->unit;
                    $sale->sale_all = 'all';
                    $sale->save();
                }else{
                    $arrsale_product = [];
                    $sale->save();

                    // lặp qua từng sp để lưu vào bảng sale_products
                    foreach ($request->product as $key => $value) {
                        $arrsale_product[] = array(
                            'sale_id' => $sale->id,
                            'product_id' => $value,
                            'discount' => $request->discount[$key],
                            'unit' => $request->unit[$key],
                        );
                    }
                    DB::table('sale_products')->insert($arrsale_product);
                }
                break;
            case 3:
                $sale->method = 'Chiết khấu theo từng loại sản phẩm';
                if($request->all){
                    $sale->discount = $request->discount;
                    $sale->unit = $request->unit;
                    $sale->sale_all = 'all';
                    $sale->save();
                }else{
                    $arrsale_product = [];
                    $sale->save();
                    foreach ($request->product as $key => $value) {
                        $arrsale_product[] = array(
                            'sale_id' => $sale->id,
                            'category_type_id' => $value,
                            'discount' => $request->discount[$key],
                            'unit' => $request->unit[$key],
                        );
                    }
                    DB::table('sale_products')->insert($arrsale_product);
                }
                break;
            case 4:
                $sale->method = 'Chiết khấu theo nhà sản xuất';
                if($request->all){
                    $sale->discount = $request->discount;
                    $sale->unit = $request->unit;
                    $sale->sale_all = 'all';
                    $sale->save();
                }else{
                    $arrsale_product = [];
                    $sale->save();
                    foreach ($request->product as $key => $value) {
                        $arrsale_product[] = array(
                            'sale_id' => $sale->id,
                            'producer_id' => $value,
                            'discount' => $request->discount[$key],
                            'unit' => $request->unit[$key],
                        );
                    }
                    DB::table('sale_products')->insert($arrsale_product);
                }
                break;
            case 5:
                $sale->method = 'Chiết khấu theo nhà cung cấp';
                if($request->all){
                    $sale->discount = $request->discount;
                    $sale->unit = $request->unit;
                    $sale->sale_all = 'all';
                    $sale->save();
                }else{
                    $arrsale_product = [];
                    $sale->save();
                    foreach ($request->product as $key => $value) {
                        $arrsale_product[] = array(
                            'sale_id' => $sale->id,
                            'provider_id' => $value,
                            'discount' => $request->discount[$key],
                            'unit' => $request->unit[$key],
                        );
                    }
                    DB::table('sale_products')->insert($arrsale_product);
                }
                break;
            case 6:
                $sale->method = 'Chiết khấu theo số lượng mua';
                if($request->all){
                    $sale->discount = $request->discount;
                    $sale->unit = $request->unit;
                    $sale->amount_from = $request->amount_from;
                    $sale->amount_to = $request->amount_to;
                    $sale->sale_all = 'all';
                    $sale->save();
                }else{
                    $arrsale_product = [];
                    $sale->save();
                    foreach ($request->product as $key => $value) {
                        $arrsale_product[] = array(
                            'sale_id' => $sale->id,
                            'product_id' => $value,
                            'discount' => $request->discount[$key],
                            'amount_from' => $request->amount_from[$key],
                            'amount_to' => $request->amount_to[$key],
                            'unit' => $request->unit[$key],
                        );
                    }
                    DB::table('sale_products')->insert($arrsale_product);
                }
                break;
            default:
                # code...
                break;
        }
        return redirect()->route('sale.edit', $sale->id)->with('success',"Tạo khuyến mãi thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::with('saleProduct')->where('id',$id)->get();
        // dd($sale);
        $data['sale'] = $sale[0];
        $sanpham =  DB::table('products')->where('active',1)->orderBy('id','DESC')->get();
        $categoryType = Category::where('active',1)->get();
        $producer = DB::table('producers')->get();
        $provider = DB::table('providers')->get();
        $listCategoryType = [];
        foreach ($categoryType as $kc => $c) {
            $listCategoryType[$c['id']] = $c->name;
        }

        $listtensp = [];
        foreach ($sanpham as $key => $value) {
            $listtensp[$value->id] = $value->name;
        }
        $listproducer = [];
        foreach ($producer as $key => $value) {
            $listproducer[$value->id] = $value->name;
        }
        $listprovider = [];
        foreach ($provider as $key => $value) {
            $listprovider[$value->id] = $value->name;
        }
        // dd($listCategoryType);
        $data['provider'] = $provider;
        $data['producer'] = $producer;
        $data['listprovider'] = $listprovider;
        $data['listproducer'] = $listproducer;
        $data['categoryType'] = $categoryType;
        $data['listtensp'] = $listtensp;
        $data['listCategoryType'] = $listCategoryType;
        $data['dssp'] = $sanpham;
        $data['action'] = 'edit';
        return View('admin/create_sale', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        //
        if($request->apdung){
            $sale->sale = 1; 
            $sale->save();
            return redirect()->route('sale.index')->with('success',"Cập nhật khuyến mãi thành công");
        }else{
            DB::table('sale_products')->where('sale_id', '=', $sale->id)->delete();
            $sale->sale = $request->sale;
            $sale->name = $request->name;
            $sale->code = $request->code;
            $sale->type = $request->type;
            // dd($request->start_time);
            $sale->start_time = $request->start_time;
            $sale->end_time = $request->end_time;
            if($request->unlimit){
                $sale->amount_applied = 'unlimit';
            }else{
                $sale->amount_applied = $request->amount_applied;
            }
            switch ($request->type) {
                case 1:
                    $sale->price_form = $request->price_form;
                    $sale->price_to = $request->price_to;
                    $sale->discount = $request->discount;
                    $sale->unit = $request->unit;
                    $sale->method = 'Chiết khấu theo tổng giá trị đơn hàng';
                    $sale->save();
                    break;

                case 2:
                    $sale->method = 'Chiết khấu theo từng sản phẩm';
                    if($request->all){
                        $sale->discount = $request->discount;
                        $sale->unit = $request->unit;
                        $sale->sale_all = 'all';
                        $sale->save();
                    }else{
                        $arrsale_product = [];
                        $sale->sale_all = '';
                        $sale->save();
                        foreach ($request->product as $key => $value) {
                            $arrsale_product[] = array(
                                'sale_id' => $sale->id,
                                'product_id' => $value,
                                'discount' => $request->discount[$key],
                                'unit' => $request->unit[$key],
                            );
                        }
                        DB::table('sale_products')->insert($arrsale_product);
                    }
                    break;
                case 3:
                    $sale->method = 'Chiết khấu theo từng loại sản phẩm';
                    if($request->all){
                        $sale->discount = $request->discount;
                        $sale->unit = $request->unit;
                        $sale->sale_all = 'all';
                        $sale->save();
                    }else{
                        $arrsale_product = [];
                        $sale->discount = null;
                        $sale->sale_all = null;
                        $sale->save();
                        foreach ($request->product as $key => $value) {
                            $arrsale_product[] = array(
                                'sale_id' => $sale->id,
                                'category_type_id' => $value,
                                'discount' => $request->discount[$key],
                                'unit' => $request->unit[$key],
                            );
                        }
                        DB::table('sale_products')->insert($arrsale_product);
                    }
                    break;
                case 4:
                    $sale->method = 'Chiết khấu theo nhà sản xuất';
                    if($request->all){
                        $sale->discount = $request->discount;
                        $sale->unit = $request->unit;
                        $sale->sale_all = 'all';
                        $sale->save();
                    }else{
                        $arrsale_product = [];
                        $sale->discount = null;
                        $sale->sale_all = null;
                        $sale->save();
                        foreach ($request->product as $key => $value) {
                            $arrsale_product[] = array(
                                'sale_id' => $sale->id,
                                'producer_id' => $value,
                                'discount' => $request->discount[$key],
                                'unit' => $request->unit[$key],
                            );
                        }
                        DB::table('sale_products')->insert($arrsale_product);
                    }
                    break;
                case 5:
                    $sale->method = 'Chiết khấu theo nhà cung cấp';
                    if($request->all){
                        $sale->discount = $request->discount;
                        $sale->unit = $request->unit;
                        $sale->sale_all = 'all';
                        $sale->save();
                    }else{
                        $arrsale_product = [];
                        $sale->discount = null;
                        $sale->sale_all = null;
                        $sale->save();
                        foreach ($request->product as $key => $value) {
                            $arrsale_product[] = array(
                                'sale_id' => $sale->id,
                                'provider_id' => $value,
                                'discount' => $request->discount[$key],
                                'unit' => $request->unit[$key],
                            );
                        }
                        DB::table('sale_products')->insert($arrsale_product);
                    }
                    break;
                case 6:
                    $sale->method = 'Chiết khấu theo số lượng mua';
                    if($request->all){
                        $sale->discount = $request->discount;
                        $sale->unit = $request->unit;
                        $sale->amount_from = $request->amount_from;
                        $sale->amount_to = $request->amount_to;
                        $sale->sale_all = 'all';
                        $sale->save();
                    }else{
                        $arrsale_product = [];
                        $sale->discount = null;
                        $sale->sale_all = null;
                        $sale->save();
                        foreach ($request->product as $key => $value) {
                            $arrsale_product[] = array(
                                'sale_id' => $sale->id,
                                'product_id' => $value,
                                'discount' => $request->discount[$key],
                                'amount_from' => $request->amount_from[$key],
                                'amount_to' => $request->amount_to[$key],
                                'unit' => $request->unit[$key],
                            );
                        }
                        DB::table('sale_products')->insert($arrsale_product);
                    }
                    break;
                default:
                    # code...
                    break;
            }
            return redirect()->route('sale.edit', $sale->id)->with('success',"Cập nhật khuyến mãi thành công");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return redirect()->route('sale.index')->with('success',"Xóa thành công");
    }
    public function ajaxSanPham(Request $request)
    {
        if($request->tensanpham != ""){
            $sanpham = DB::table('products')->where('name', 'like', '%'.$request->tensanpham.'%')->where('active',1)->orderBy('id','DESC')->limit(10)->get();
        }else{
            $sanpham = DB::table('products')->where('active',1)->orderBy('id','DESC')->get();
        }
        return response()->json($sanpham);
    }

    public function ajaxCategoryType(Request $request)
    {
        $categoryType = Category::where('active',1)->get();
        return response()->json($categoryType);
    }
    public function ajaxProducer(Request $request)
    {
        $producer = DB::table('producers')->get();
        return response()->json($producer);
    }
    public function ajaxProvider(Request $request)
    {
        $provider = DB::table('providers')->get();
        return response()->json($provider);
    }
}
