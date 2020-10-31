<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Producer;

class ProducerController extends Controller
{
    public function index()
    {
        $producers = Producer::with(['product' => function($c){
        }])->orderBy('id','desc')->get();
        $data['producers'] = $producers;
        return View('admin/producer', $data);
    }

    public function store(Request $request)
    {
        $producer = new Producer();
        $producer->name = $request->name;
        $producer->code = $request->code;
        $producer->email = $request->email;
        $producer->phone = $request->phone;
        $producer->address = $request->address;
        if($request->images!=null){
            if($request->images->getSize() > 2096128){
                return redirect()->route('producer.create')->with('warning',"Hình ảnh không được vượt quá 2047MB");
            }
            $path = $request->images->store('uploads','public');
            $producer->logo = $path;
        }

        $producer->save();
        return redirect()->route('producer.index')->with('success',"Thêm thành công");
    }

    public function edit($id)
    {
        $producers = Producer::with(['product' => function($c){
        }])->orderBy('id','desc')->get();
        $producer = Producer::find($id);
        $data['producers'] = $producers;
        $data['producer'] = $producer;
        $data['action'] = 'edit';
        return View('admin/producer', $data);
    }
    public function update(Request $request, $id)
    {
        $producer = Producer::find($id);
        $producer->name = $request->name;
        $producer->code = $request->code;
        $producer->email = $request->email;
        $producer->phone = $request->phone;
        $producer->address = $request->address;
        // chek xem có chọn ảnh k
        if($request->images!=null){
            if($request->images->getSize() > 2096128){
                return redirect()->route('producer.create')->with('warning',"Hình ảnh không được vượt quá 2047MB");
            }
            $path = $request->images->store('uploads','public');
            $producer->logo = $path;
        }
        $producer->save();
        return redirect()->route('producer.index')->with('success',"Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producer = Producer::find($id);
        $producer->delete();
        return redirect()->route('producer.index')->with('success',"Xóa thành công");
    }
}
