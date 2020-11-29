<?php

namespace App\Http\Controllers\admin;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Provider;
use App\Model\Product;
use App\Model\BillImport;
use App\Model\BillImportDetail;
use App\Model\Warehouse;
use App\Model\BillExportDetail;

class BillImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tương tự đơn xuất hàng
        $provider =  Provider::all();
        $arr_provider = [];
        foreach ($provider as $key => $value) {
            $arr_provider[$value->id] = $value->name . ' - ' . $value->code;
        }
        $data['provider'] = $arr_provider;
        $data['listBillImport'] = BillImport::withCount(['billDetail'])->latest()->paginate(20);
        // dd($data['listBillImport']);
        return View('admin/billImport', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['provider'] = Provider::all();
        $data['product'] = Product::latest()->get();
        return View('admin/create_billImport', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'bill_imports'");
        $nextId = $statement[0]->Auto_increment;

        $billImport = new BillImport();
        $billImport->provider_id = $request->provider;
        $billImport->user_id = Auth::id();
        $billImport->payments = 0;
        $billImport->cost = str_replace(',','',$request->cost);
        $billImport->note = $request->note;
        $billImport->date_of_import = date('Y-m-d H:i:s', time());
        $billImport->status = $request->status;

        $listAmount = $request->amount;
        $listPrice = $request->price;
        $listProduct = $request->product;
        $arrDetail = [];
        foreach ($listAmount as $key => $value) {
            $detail = array(
                'bill_import_id' => $nextId,
                'product_id' => $listProduct[$key],
                'amount_import' => $listAmount[$key],
                'price_import' => str_replace(',','',$listPrice[$key])
            );
            $billImport->payments += str_replace(',','',$listPrice[$key]);
            array_push($arrDetail,$detail);
        }
        $billImport->payments += $billImport->cost;
        $billImport->save();
        BillImportDetail::insert($arrDetail);
        $this->updateWarehouse($listProduct);
        return redirect()->route('billImport.index')->with('success',"Tạo đơn nhập hàng thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $billImport = BillImport::with(['billDetail'])->where('id', $id)->get();
        $arrIdProduct = [];
        $sumPrice = 0;
        foreach ($billImport[0]->billDetail as $key => $value) {
            $arrIdProduct[] = $value->product_id;
            $sumPrice += $value->amount_import*$value->price_import;
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
        $data['billImport'] = $billImport[0];
        $data['provider'] = Provider::all();
        $data['product'] = $product;
        $data['action'] = 'edit';
        $data['nhapkho'] = 'nhapkho';
        return View('admin/create_billImport', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $billImport = BillImport::with(['billDetail'])->where('id', $id)->get();
        $arrIdProduct = [];
        $sumPrice = 0;
        foreach ($billImport[0]->billDetail as $key => $value) {
            $arrIdProduct[] = $value->product_id;
            $sumPrice += $value->amount_import*$value->price_import;
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
        $data['billImport'] = $billImport[0];
        $data['provider'] = Provider::all();
        $data['product'] = $product;
        $data['action'] = 'edit';
        return View('admin/create_billImport', $data);
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
        if($request->status=='nhapkho'){
            $billImport = BillImport::find($id);
            $billImport->status = 1;
            $billImport->date_of_import = date('Y-m-d H:i:s', time());
            $billImport->save();
            $listProduct = BillImportDetail::where('bill_import_id', $id)->pluck('product_id');
            $this->updateWarehouse($listProduct);
            return redirect()->route('billImport.index')->with('success',"Đơn hàng đã được nhập kho");
        }else{
            $billImport = BillImport::find($id);
            $billImport->provider_id = $request->provider;
            $billImport->user_id = Auth::id();
            $billImport->payments = 0;
            $billImport->cost = str_replace(',','',$request->cost);
            $billImport->note = $request->note;
            $billImport->date_of_import = date('Y-m-d H:i:s', time());
            $billImport->status = $request->status;

            $listAmount = $request->amount;
            $listPrice = $request->price;
            $listProduct = $request->product;
            $deleteBillDetail = BillImportDetail::where('bill_import_id', $id);
            $deleteBillDetail->delete();
            $arrDetail = [];
            foreach ($listAmount as $key => $value) {
                $detail = array(
                    'bill_import_id' => $id,
                    'product_id' => $listProduct[$key],
                    'amount_import' => $listAmount[$key],
                    'price_import' => str_replace(',','',$listPrice[$key])
                );
                $billImport->payments += str_replace(',','',$listPrice[$key]);
                array_push($arrDetail,$detail);
            }
            $billImport->payments += $billImport->cost;
            $billImport->save();
            BillImportDetail::insert($arrDetail);
            $this->updateWarehouse($listProduct);
            return redirect()->route('billImport.edit', $id)->with('success',"Cập nhật đơn nhập hàng thành công");
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
        $billImport = BillImport::find($id);
        BillImportDetail::where('bill_import_id',$id)->delete();
        $billImport->delete();
        return redirect()->route('billImport.index')->with('success',"Xóa đơn nhập hàng thành công");
    }

    public function updateWarehouse($arrIdProduct)
    {
        // $listProduct = Product::latest()->paginate(20)->toArray();
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

    public function ajaxSaveProvider(Request $request)
    {
        $provider = new Provider();
        $provider->name = $request->name;
        $provider->email = $request->email;
        $provider->phone = $request->phone;
        $provider->andress = $request->andress;
        if($provider->save()){
            return response()->json($provider);
        }else{
            return response()->json('fail');
        }
    }
}
