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
                                    }])->orderBy('date','DESC')->get();
        // các trạng thái đơn hàng
        $constStatus = array(
            0 => 'Đã đặt hàng',
            1 => 'Đã xác nhận',
            2 => 'Đã chuyển tới đơn vị vận chuyển',
            4 => 'Đã giao hàng',
            5 => 'Đã hủy đơn'
        );
                                    // dd($purchase);
        $data['purchase'] = $purchase;
        $data['constStatus'] = $constStatus;
        return view('user.purchase', $data);
    }
}
