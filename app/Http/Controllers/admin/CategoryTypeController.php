<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CategoryGroup;
use App\Model\CategoryType;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCategory = CategoryGroup::with(['category' => function($c){
            $c->where('active', '=', 1);
        }])->where('active',1)->get();
        $listCategoryType = CategoryType::with(['product' => function($c){
            // $c->where('active', '=', 1);
        }])->orderBy('id','desc')->get();
        $arrcg = [];
        foreach ($listCategory as $key => $cg) {
            foreach ($cg->category as $key => $value) {
               $arrcg[$value->id] = $value->name;
            }
        }
        $data['listCategory'] = $listCategory;
        $data['listCategoryType'] = $listCategoryType;
        $data['arrcg'] = $arrcg;
        return View('admin/categoryType', $data);
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
        $categoryType = new CategoryType();
        $categoryType->name = $request->name;
        $categoryType->category_id = $request->category;
        if($request->active != 1){
            $categoryType->active = 0;
        }else{
            $categoryType->active = $request->active;
        }

        $categoryType->save();
        return redirect()->route('categoryType.index')->with('success',"Thêm thành công");
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
        $listCategory = CategoryGroup::with(['category' => function($c){
            $c->where('active', '=', 1);
        }])->where('active',1)->get();
        $listCategoryType = CategoryType::with(['product' => function($c){
            // $c->where('active', '=', 1);
        }])->orderBy('id','desc')->get();
        $arrcg = [];
        foreach ($listCategory as $key => $cg) {
            foreach ($cg->category as $key => $value) {
               $arrcg[$value->id] = $value->name;
            }
        }
        $categoryType = CategoryType::find($id);
        $data['categoryType'] = $categoryType;
        $data['listCategory'] = $listCategory;
        $data['listCategoryType'] = $listCategoryType;
        $data['arrcg'] = $arrcg;
        $data['action'] = 'edit';
        return View('admin/categoryType', $data);
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
        $categoryType = CategoryType::find($id);
        $categoryType->name = $request->name;
        $categoryType->category_id = $request->category;
        if($request->active != 1){
            $categoryType->active = 0;
        }else{
            $categoryType->active = $request->active;
        }

        $categoryType->save();
        return redirect()->route('categoryType.index')->with('success',"Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryType = CategoryType::find($id);
        $categoryType->delete();
        return redirect()->route('categoryType.index')->with('success',"Xóa thành công");
    }
}
