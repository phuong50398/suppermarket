<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sale'] = Sale::latest()->paginate(20);
        // dd($data['listProduct']);
        return View('admin/sale', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $sale = new Sale();
        $sale->name = $request->name;
        $sale->code = $request->code;
        $sale->type = $request->type;

        $sale->start_time = date('Y-m-d H:i:s', strtotime($request->start_time));
        $sale->end_time = date('Y-m-d H:i:s', strtotime($request->end_time));
        if($request->unlimit){
            $sale->amount_applied = 'unlimit';
        }else{
            $sale->amount_applied = $request->amount_applied;
        }
        // if($request->type == 1){
        //     $sale->price_form = $request->price_form;
        //     $sale->price_to = $request->price_to;
        //     $sale->discount = $request->discount;
        //     $sale->unit = $request->unit;
        //     $sale->method = 'Chiết khấu theo tổng giá trị đơn hàng';
        // }
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
        return redirect()->route('sale.index')->with('success',"Tạo khuyến mãi thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        $categoryType = Category::with(['categoryType' => function ($ct)
        {
           $ct->where('active',1);
        }])->where('active',1)->get();
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
