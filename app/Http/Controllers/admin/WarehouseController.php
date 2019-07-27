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
        $warehouse = Warehouse::with(['product'])
                    ->groupBy('product_id')
                    ->selectRaw('sum(toncuoi) as sumtoncuoi, sum(tongnhap) as sumtongnhap, sum(tongxuat) as sumtongxuat, product_id')
                    ->latest()->paginate(20);
        $billImport = BillImport::where('nhapkho',0)
                    ->join('bill_import_details','bill_imports.id','bill_import_details.bill_import_id')
                    ->groupBy('product_id')
                    ->selectRaw('sum(amount_import) as sum_import, product_id')->pluck('sum_import','product_id');
        $billExport = BillExport::where('chuyenhang',0)
                    ->join('bill_export_details','bill_exports.id','bill_export_details.bill_export_id')
                    ->groupBy('product_id')
                    ->selectRaw('sum(amount_export) as sum_export, product_id')->pluck('sum_export','product_id');
        // dd($billExport);
        $data['billImport'] = $billImport;
        $data['billExport'] = $billExport;
        $data['warehouse'] = $warehouse;
        return view('admin/warehouse', $data);
    }
}
