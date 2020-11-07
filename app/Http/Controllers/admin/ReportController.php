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
        $nam =isset($_GET['nam']) ? $_GET['nam'] : '';
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        if($thang && $nam && $thang !='tatca' && $nam !='tatca'){
            $done = PurchaseOrder::whereYear('date', '=', $nam)
            ->whereMonth('date', '=', $thang)->where('status', 3)->get()->toArray();
        }else{
            $done = PurchaseOrder::where('status', 3)->get()->toArray();
        }
        
        // $report = PurchaseOrder::where('status', 3)->groupBy('date')
        //     ->selectRaw('sum(transport_fee) as sumtransport_fee, sum(total) as sumtotal, date')
        //     ->latest()->paginate(20); 


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
        $nam =isset($_GET['nam']) ? $_GET['nam'] : '';
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        if($thang && $nam && $thang !='tatca' && $nam !='tatca'){
            $done = BillImport::whereYear('date_of_import', '=', $nam)
            ->whereMonth('date_of_import', '=', $thang)->where('status', 1)->get()->toArray();
        }else{
            $done = BillImport::where('status', 1)->get()->toArray();
        }
        
        // $report = PurchaseOrder::where('status', 3)->groupBy('date')
        //     ->selectRaw('sum(transport_fee) as sumtransport_fee, sum(total) as sumtotal, date')
        //     ->latest()->paginate(20); 

        $date_import = [];
        foreach($done as $key => $value){
            $date_import[$value['id']] = $value['date_of_import'];
        }
        // dd($date_import);
        $ids = array_column($done, 'id');
        $report = BillImportDetail::with(['product'])
                    ->whereIn('bill_import_id', $ids)
                    ->latest()->paginate(20); 
        $data['nam'] = $nam;
        $data['thang'] = $thang;
        $data['date_import'] = $date_import;
        $data['report'] = $report;
        return View('admin/report_import', $data);
    }

    public function reportMoney()
    {
        $nam =isset($_GET['nam']) ? $_GET['nam'] : '';
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        if($thang && $nam && $thang !='tatca' && $nam !='tatca'){
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
