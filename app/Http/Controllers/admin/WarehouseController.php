<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Warehouse;
use App\Model\BillImport;
use App\Model\BillExport;

class WarehouseController extends Controller
{
    public function index()
    {
        // lấy ra các thông tin bảng tồn kho, đơn xuất hàng, nhập hàng để truyền xuất view

        // tính tổng tồn đầu, tồn cuối, tổng nhập, xuát theo từng sp
        $nam =isset($_GET['nam']) ? $_GET['nam'] : '';
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        if($thang && $nam && $thang !='tatca' && $nam !='tatca'){
            $warehouse = Warehouse::with(['product'])
            ->where('year', $nam)
            ->where('month', $thang)
            ->groupBy('product_id')
            ->selectRaw('sum(end_inventory) as sumtoncuoi, sum(sum_import) as sumtongnhap, sum(sum_export) as sumtongxuat, product_id')
            ->latest()->paginate(20);
            $billImport = BillImport::whereYear('date_of_import', '=', $nam)
            ->whereMonth('date_of_import', '=', $thang)->where('status',0)
            ->join('bill_import_details','bill_imports.id','bill_import_details.bill_import_id')
            ->groupBy('product_id')
            ->selectRaw('sum(amount_import) as sum_import, product_id')->pluck('sum_import','product_id');
            $billExport = BillExport::whereYear('date_of_export', '=', $nam)
            ->whereMonth('date_of_export', '=', $thang)->where('status',0)
            ->join('bill_export_details','bill_exports.id','bill_export_details.bill_export_id')
            ->groupBy('product_id')
            ->selectRaw('sum(amount_export) as sum_export, product_id')->pluck('sum_export','product_id');
        }else{
            $warehouse = Warehouse::with(['product'])
            ->groupBy('product_id')
            ->selectRaw('sum(end_inventory) as sumtoncuoi, sum(sum_import) as sumtongnhap, sum(sum_export) as sumtongxuat, product_id')
            ->latest()->paginate(20);
            $billImport = BillImport::where('status',0)
            ->join('bill_import_details','bill_imports.id','bill_import_details.bill_import_id')
            ->groupBy('product_id')
            ->selectRaw('sum(amount_import) as sum_import, product_id')->pluck('sum_import','product_id');
            $billExport = BillExport::where('status',0)
            ->join('bill_export_details','bill_exports.id','bill_export_details.bill_export_id')
            ->groupBy('product_id')
            ->selectRaw('sum(amount_export) as sum_export, product_id')->pluck('sum_export','product_id');
            
        }
        
        // dd($billExport);
        $data['nam'] = $nam;
        $data['thang'] = $thang;
        $data['billImport'] = $billImport;
        $data['billExport'] = $billExport;
        $data['warehouse'] = $warehouse;
        return view('admin/warehouse', $data);
    }
}
