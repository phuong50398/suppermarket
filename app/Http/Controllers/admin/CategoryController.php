<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\CategoryGroup;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCategoryGroup = CategoryGroup::where('active',1)->get();
        $listCategory = Category::with(['categoryType' => function($c){
            // $c->where('active', '=', 1);
        }])->orderBy('id','desc')->get();
        $arrcg = [];
        foreach ($listCategoryGroup as $key => $value) {
            $arrcg[$value->id] = $value->name;
        }
        $data['listCategoryGroup'] = $listCategoryGroup;
        $data['listCategory'] = $listCategory;
        $data['arrcg'] = $arrcg;
        return View('admin/category', $data);
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
        $category = new Category();
        $category->name = $request->name;
        $category->category_group_id = $request->categoryGroup;
        if($request->active != 1){
            $category->active = 0;
        }else{
            $category->active = $request->active;
        }

        $category->save();
        return redirect()->route('category.index')->with('success',"Thêm thành công");
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
        $listCategoryGroup = CategoryGroup::all();
        $listCategory = Category::with(['categoryType' => function($c){
            // $c->where('active', '=', 1);
        }])->orderBy('id','desc')->get();
        $arrcg = [];
        foreach ($listCategoryGroup as $key => $value) {
            $arrcg[$value->id] = $value->name;
        }
        $category = Category::find($id);

        $data['listCategoryGroup'] = $listCategoryGroup;
        $data['listCategory'] = $listCategory;
        $data['arrcg'] = $arrcg;
        $data['category'] = $category;
        $data['action'] = 'edit';
        return View('admin/category', $data);
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
        $category = Category::find($id);
        $category->name = $request->name;
        $category->category_group_id = $request->categoryGroup;
        if($request->active != 1){
            $category->active = 0;
        }else{
            $category->active = $request->active;
        }

        $category->save();
        return redirect()->route('category.index')->with('success',"Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success',"Xóa thành công");
    }
}