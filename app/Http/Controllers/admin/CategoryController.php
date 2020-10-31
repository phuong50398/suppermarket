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
        // Lấy ds danh mục và sản phẩm của từng đanh mục => trả xuống view
        $listCategory = Category::with(['product' => function($c){
        }])->orderBy('id','desc')->get();
        $data['listCategory'] = $listCategory;
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
        // hàm thêm
        $category = new Category();
        $category->name = $request->name;
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
        // hàm đổ  lại form để sửa
        $listCategory = Category::orderBy('id','desc')->get();
        $category = Category::find($id);
        $data['listCategory'] = $listCategory;
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
        // hàm ấn cập nhật dữ iệu
        $category = Category::find($id);
        $category->name = $request->name;
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
        // xóa danh much
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success',"Xóa thành công");
    }
}
