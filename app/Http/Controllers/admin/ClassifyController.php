<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Classify;

class ClassifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classifies = Classify::with(['productClassify' => function($c){
        }])->orderBy('id','desc')->get();
        $data['classifies'] = $classifies;
        return View('admin/classify', $data);
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
        $classify = new Classify();
        $classify->value = $request->value;
        $classify->type = $request->type;
        $classify->save();
        return redirect()->route('classify.index')->with('success',"Thêm thành công");
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
        $classifies = Classify::with(['productClassify' => function($c){
        }])->orderBy('id','desc')->get();
        $classify = Classify::find($id);
        $data['classifies'] = $classifies;
        $data['classify'] = $classify;
        $data['action'] = 'edit';
        return View('admin/classify', $data);
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
        $classify = Classify::find($id);
        $classify->value = $request->value;
        $classify->type = $request->type;
        $classify->save();
        return redirect()->route('classify.index')->with('success',"Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classify = Classify::find($id);
        $classify->delete();
        return redirect()->route('classify.index')->with('success',"Xóa thành công");
    }
}
