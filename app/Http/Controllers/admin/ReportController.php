<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PurchaseOrder;
use App\Model\Product;
use App\Model\PurchaseOrderDetail;
use App\Model\BillImportDetail;
use App\Model\BillImport;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    public function index()
    {
        // Hàm xử lý báo cáo bán hàng

        // lấy giá trị năm tháng khi tìm kiếm
        $nam =isset($_GET['nam']) ? $_GET['nam'] : '';
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        if($thang && $nam && $thang !='tatca' && $nam !='tatca'){
            // nếu có giá trị tìm kiếm thì lọc theo điều kiện, chỉ lấy những đơn hàng có trạng thái = 3 (đã giao hàng)
            $done = PurchaseOrder::whereYear('date', '=', $nam)
            ->whereMonth('date', '=', $thang)->where('status', 3)->get()->toArray();
        }else{
            // lấy những đơn hàng có trạng thái = 3 (đã giao hàng)
            $done = PurchaseOrder::where('status', 3)->get()->toArray();
        }
        

            // lấy chi tiết đơn đặt hàng cho những đơn hàng ở trên
        $ids = array_column($done, 'id');
        $report = PurchaseOrderDetail::with(['product'])
                    ->whereIn('purchase_order_id', $ids)
                    ->groupBy('product_id')
                    ->selectRaw('sum(amount) as sumamount, sum(price) as sumprice, product_id')
                    ->latest()->paginate(20); 
        $data['nam'] = $nam;
        $data['thang'] = $thang;
        $data['report'] = $report;
        return View('admin/report', $data);
    }

    public function reportImport()
    {

        // hàm báo cáo nhập hàng
         // lấy giá trị năm tháng khi tìm kiếm
        $nam =isset($_GET['nam']) ? $_GET['nam'] : '';
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        if($thang && $nam && $thang !='tatca' && $nam !='tatca'){
            // lấy những đơn nhập hàng theo điều kiện với trạng thái đã nhập hàng
            $done = BillImport::with(['provider'])->whereYear('date_of_import', '=', $nam)
            ->whereMonth('date_of_import', '=', $thang)->where('status', 1)->get()->toArray();
        }else{
            // lấy những đơn nhập hàng  với trạng thái đã nhập hàng
            $done = BillImport::with(['provider'])->where('status', 1)->get()->toArray();
        }
        
        // tạo mảng ngày nhập hàng theo id đơn hàng
        $date_import = [];
        $provider_import = [];
        foreach($done as $key => $value){
            $date_import[$value['id']] = $value['date_of_import'];
            $provider_import[$value['id']] = $value['provider'];
        }
        // lấy danh sách chi tiết đơn nhập hàng của những đơn hàng trên. phân trang 20 bản ghi/trang
        $ids = array_column($done, 'id');
        $report = BillImportDetail::with(['product'])
                    ->whereIn('bill_import_id', $ids)
                    ->latest()->paginate(20); 
        $data['nam'] = $nam;
        $data['thang'] = $thang;
        $data['date_import'] = $date_import;
        $data['report'] = $report;
        $data['provider_import'] = $provider_import;
        return View('admin/report_import', $data);
    }

    public function reportMoney()
    {
        // Báo cáo tài chính
        $nam =isset($_GET['nam']) ? $_GET['nam'] : '';
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        if($thang && $nam && $thang !='tatca' && $nam !='tatca'){
            // tính tổng trường phí vận chuyển và total trong bảng đơn đặt hàng, gom theo ngày 
            $report = PurchaseOrder::whereYear('date', '=', $nam)
            ->whereMonth('date', '=', $thang)->where('status', 3)->groupBy('date')
            ->selectRaw('sum(transport_fee) as sumfee, sum(total) as sumtotal, date')
            ->latest()->paginate(20); 
        }else{
            $report = PurchaseOrder::where('status', 3)->groupBy('date')
            ->selectRaw('sum(transport_fee) as sumfee, sum(total) as sumtotal, date')
            ->latest()->paginate(20); 
        }
               
        $data['nam'] = $nam;
        $data['thang'] = $thang;
        $data['report'] = $report;
        return View('admin/report_money', $data);
    }
}
