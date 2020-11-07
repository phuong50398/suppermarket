<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PurchaseOrder;
use App\Model\User;

class BillOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = PurchaseOrder::with(['purchaseOrderDetail' => function($pod){
            $pod->with(['product']);
        }])->latest()->paginate(20);
        foreach ($purchase as $v){
            $v->user =  DB::table('users')
        ->where('id', $v->user_id)->first();
        }
       
            // các trạng thái đơn hàng
            $constStatus = array(
            0 => 'Đã đặt hàng',
            1 => 'Đã xác nhận',
            2 => 'Đã tới đơn vị vận chuyển',
            3 => 'Đã giao hàng',
            5 => 'Đã hủy đơn',
            4 => 'Yêu cầu hủy'
            );
            $constStatusColor = array(
            0 => 'badge-warning',
            1 => 'badge-primary',
            2 => 'badge-info',
            3 => 'badge-success',
            5 => 'badge-secondary',
            4 => 'badge-danger'
            );
            $data['purchase'] = $purchase;
            $data['constStatus'] = $constStatus;
            $data['constStatusColor'] = $constStatusColor;
                    // dd($purchase);
            return View('admin/billOrder', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if($request->status){
            $billOrder = PurchaseOrder::find($id);
            $billOrder->status = $request->status;
            $billOrder->save();
            return redirect()->route('billOrder.index')->with('success',"Cập nhật thành công");
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
        //
    }
}
