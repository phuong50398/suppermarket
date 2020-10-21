<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Provider;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::with(['product' => function($c){
        }])->orderBy('id','desc')->get();
        $data['providers'] = $providers;
        return View('admin/provider', $data);
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
        $provider = new Provider();
        $provider->name = $request->name;
        $provider->code = $request->code;
        $provider->email = $request->email;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        if($request->images!=null){
            if($request->images->getSize() > 2096128){
                return redirect()->route('provider.create')->with('warning',"Hình ảnh không được vượt quá 2047MB");
            }
            $path = $request->images->store('uploads','public');
            $provider->logo = $path;
        }
        $provider->save();
        return redirect()->route('provider.index')->with('success',"Thêm thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $providers = Provider::with(['product' => function($c){
        }])->orderBy('id','desc')->get();
        $provider = Provider::find($id);
        $data['providers'] = $providers;
        $data['provider'] = $provider;
        $data['action'] = 'edit';
        return View('admin/provider', $data);
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
        $provider = Provider::find($id);
        $provider->name = $request->name;
        $provider->code = $request->code;
        $provider->email = $request->email;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        if($request->images!=null){
            if($request->images->getSize() > 2096128){
                return redirect()->route('provider.create')->with('warning',"Hình ảnh không được vượt quá 2047MB");
            }
            $path = $request->images->store('uploads','public');
            $provider->logo = $path;
        }
        $provider->save();
        return redirect()->route('provider.index')->with('success',"Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        return redirect()->route('provider.index')->with('success',"Xóa thành công");
    }
}
