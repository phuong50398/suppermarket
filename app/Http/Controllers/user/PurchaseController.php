<?php

namespace App\Http\Controllers\user;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\PurchaseOrder;

class PurchaseController extends Controller
{
    public function index()
    {

        // hàm lấy danh sách các đơn đặt hàng
        $category = Category::where('active',1)->orderBy('id','DESC')->limit(6)->get();

        $data['listMenu'] = $category;
        $data['category'] = $category;
        $purchase = PurchaseOrder::where('user_id', Auth::user()->id)
                                    ->with(['purchaseOrderDetail' => function($pod){
                                        $pod->with(['product']);
                                    }])->orderBy('id','DESC')->get();
                                    
        // các trạng thái đơn hàng
        $constStatus = array(
            0 => 'Đã đặt hàng',
            1 => 'Đã xác nhận',
            2 => 'Đã tới đơn vị vận chuyển',
            3 => 'Đã giao hàng',
            5 => 'Đã hủy đơn',
            4 => 'Yêu cầu hủy'
        );
                                    // dd($purchase);
        $data['purchase'] = $purchase;
        $data['constStatus'] = $constStatus;
        return view('user.purchase', $data);
    }
    public function request(Request $request)
    {
        $billOrder = PurchaseOrder::find($request->id);
        $billOrder->status = $request->status;
        $billOrder->save();
        return redirect()->route('purchase');
    }
}
