<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\BillExport;
use App\Model\BillExportDetail;
use App\Model\Warehouse;

class BillExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // lấy danh sách đơn xuất hàng phân trang 20 dòng/1trang
        // gán vào mảng truyền xuống view
        $data['listBillExport'] = BillExport::withCount('billDetail')->latest()->paginate(20);
        return View('admin/billExport', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // gọi hàm khi vào trag tạo đơn xuất hàng, trả về view create_billExport
        // Product::latest() lấy danh sách sản phẩm gần nhất
        $data['product'] = Product::latest()->get();
        return View('admin/create_billExport', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // hàm để lưu đơn xuất
        $statement = DB::select("SHOW TABLE STATUS LIKE 'bill_exports'");
        $nextId = $statement[0]->Auto_increment;

        $billExport = new BillExport();
        $billExport->user_id = Auth::id();
        $billExport->payments = 0;
        $billExport->status = $request->status;
        // định dạng chi phí gửi lên là 10,000 có dấu phẩy nên phải thay thế ',' thành rỗng =>10000 để lưu DB
        $billExport->cost = str_replace(',','',$request->cost);
        $billExport->note = $request->note;
        $billExport->date_of_export = date('Y-m-d H:i:s', time());

        $listAmount = $request->amount;
        $listPrice = $request->price;
        $listProduct = $request->product;
        $arrDetail = [];
        // lặp qua các sản phẩn khi chọn để xuất hàng, để nhét vào mảng rồi lưu BillExportDetail
        foreach ($listAmount as $key => $value) {
            $detail = array(
                'bill_export_id' => $nextId,
                'product_id' => $listProduct[$key],
                'amount_export' => $listAmount[$key],
                'price_export' => str_replace(',','',$listPrice[$key])
            );
            $billExport->payments += str_replace(',','',$listPrice[$key]);
            array_push($arrDetail,$detail);
        }
        $billExport->payments += $billExport->cost;
        $billExport->save();
        // lưu vào bảng chi tiết đơn xuất hàng
        BillExportDetail::insert($arrDetail);
        // update bảng tồn kho
        $this->updateWarehouse($listProduct);
        return redirect()->route('billExport.index')->with('success',"Tạo đơn xuất hàng thành công");
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
        // gọi khi ấn edit để đổ lại dữ liệu vào form
        $billExport = BillExport::with(['billDetail'])->where('id', $id)->get();
        $arrIdProduct = [];
        $sumPrice = 0;
        foreach ($billExport[0]->billDetail as $key => $value) {
            $arrIdProduct[] = $value->product_id;
            $sumPrice += $value->amount_export*$value->price_export;
        }
        $product = Product::latest()->get();
        $arrProduct = [];
        foreach ($product as $key => $value) {
            $arrProduct[$value->id] = $value->name;
        }
        // dd($billImport[0]->billDetail->toArray());
        $data['sumPrice'] = $sumPrice;
        $data['arrProduct'] = $arrProduct;
        $data['arrIdProduct'] = $arrIdProduct;
        $data['billExport'] = $billExport[0];
        $data['product'] = $product;
        $data['action'] = 'edit';
        return View('admin/create_billExport', $data);
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
        // ấn update lại dữ liệu
        if($request->status=='chuyenhang'){
            $billExport = BillExport::find($id);
            $billExport->status = 1;
            $billExport->date_of_export = date('Y-m-d H:i:s', time());
            $billExport->save();
            $listProduct = BillExportDetail::where('bill_export_id', $id)->pluck('product_id');
            $this->updateWarehouse($listProduct);
            return redirect()->route('billExport.index')->with('success',"Đơn hàng đã được chuyển đi");
        }else{
            $billExport = BillExport::find($id);
            $billExport->user_id = Auth::id();
            $billExport->payments = 0;
            $billExport->status = $request->status;
            $billExport->cost = str_replace(',','',$request->cost);
            $billExport->note = $request->note;
            $billExport->date_of_export = date('Y-m-d H:i:s', time());

            $listAmount = $request->amount;
            $listPrice = $request->price;
            $listProduct = $request->product;
            $arrDetail = [];
            $deleteBillDetail = BillExportDetail::where('bill_export_id', $id);
            $deleteBillDetail->delete();
            foreach ($listAmount as $key => $value) {
                $detail = array(
                    'bill_export_id' => $id,
                    'product_id' => $listProduct[$key],
                    'amount_export' => $listAmount[$key],
                    'price_export' => str_replace(',','',$listPrice[$key])
                );
                $billExport->payments += str_replace(',','',$listPrice[$key]);
                array_push($arrDetail,$detail);
            }
            $billExport->payments += $billExport->cost;
            $billExport->save();
            BillExportDetail::insert($arrDetail);
            $this->updateWarehouse($listProduct);
            return redirect()->route('billExport.edit', $id)->with('success',"Cập nhật đơn xuất hàng thành công");
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
        // xóa đơn xuất hàng, phải xóa chi tiết đơn xuất hàng trước
        $billExport = BillExport::find($id);
        BillExportDetail::where('bill_export_id',$id)->delete();
        $billExport->delete();
        return redirect()->route('billExport.index')->with('success',"Xóa đơn xuất hàng thành công");    
    }
    public function updateWarehouse($arrIdProduct)
    {
        // hàm để update tồn kho
        foreach ($arrIdProduct as $key => $value) {
            $warehouse = new Warehouse();
            $productWarehouse = DB::table('warehouses')->where('product_id', $value)
                                ->orderBy('year', 'desc')
                                ->orderBy('month', 'desc')
                                ->limit(1)
                                ->get();
                                
            if($productWarehouse->toArray()==null){
                $warehouse->begin_inventory = 0;
            }else{
                $productWarehouse = $productWarehouse[0];
                if($productWarehouse->month==date('m',time()) && $productWarehouse->year==date('Y',time())){
                    $warehouse->begin_inventory = $productWarehouse->begin_inventory;
                }else{
                    $warehouse->begin_inventory = $productWarehouse->end_inventory;
                }
            }

            $billImport = DB::table('bill_imports')->whereMonth('date_of_import', '=', date('m',time()))
                        ->whereYear('date_of_import', '=', date('Y',time()))
                        ->where('status', 1)
                        ->join('bill_import_details', 'bill_imports.id', '=', 'bill_import_details.bill_import_id')
                        ->where('product_id', $value)->get();
            if($billImport->toArray()==null){
                $warehouse->sum_import = 0;
            }else{
                $warehouse->sum_import = array_sum(array_column($billImport->toArray(), 'amount_import'));
            }

            $billExport = DB::table('bill_exports')->whereMonth('date_of_export', '=', date('m',time()))
                        ->whereYear('date_of_export', '=', date('Y',time()))
                        ->where('status', 1)
                        ->join('bill_export_details', 'bill_exports.id', '=', 'bill_export_details.bill_export_id')
                        ->where('product_id', $value)->get();
            $warehouse->sum_export = ($billExport->toArray()==null) ? 0 : array_sum(array_column($billExport->toArray(), 'amount_export'));
            $warehouse->end_inventory = $warehouse->begin_inventory + $warehouse->sum_import - $warehouse->sum_export;
            $wh = Warehouse::firstOrNew(
                array(
                    'month' => date('m',time()),
                    'year' => date('Y',time()),
                    'product_id' => $value
                ));
            $wh->product_id =  $value;
            $wh->begin_inventory =  $warehouse->begin_inventory;
            $wh->sum_import = $warehouse->sum_import;
            $wh->sum_export = $warehouse->sum_export;
            $wh->end_inventory =  $warehouse->end_inventory;
            $wh->save();
            // dd($warehouse);
        }
    }
}
