<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CategoryGroup;

class CategoryGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCategoryGroup = CategoryGroup::with(['category' => function($c){
            // $c->where('active', '=', 1);
        }])->orderBy('id','desc')->get();
        // dd($listCategoryGroup[0]->category);
        $data['listCategoryGroup'] = $listCategoryGroup;
        return View('admin/categoryGroup', $data);
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
        $categoryGroup = new CategoryGroup();
        $categoryGroup->name = $request->name;
        if($request->active != 1){
            $categoryGroup->active = 0;
        }else{
            $categoryGroup->active = $request->active;
        }

        $categoryGroup->save();
        return redirect()->route('categoryGroup.index')->with('success',"Thêm thành công");
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
        $listCategoryGroup = CategoryGroup::with(['category' => function($c){
            // $c->where('active', '=', 1);
        }])->orderBy('id','desc')->get();
        $data['listCategoryGroup'] = $listCategoryGroup;

        $categoryGroup = CategoryGroup::find($id);
        $data['categoryGroup'] = $categoryGroup;
        $data['action'] = 'edit';
        return View('admin/categoryGroup', $data);
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
        $categoryGroup = CategoryGroup::find($id);
        $categoryGroup->name = $request->name;
        if($request->active != 1){
            $categoryGroup->active = 0;
        }else{
            $categoryGroup->active = $request->active;
        }
        $categoryGroup->save();
        return redirect()->route('categoryGroup.index')->with('success',"Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryGroup = CategoryGroup::find($id);
        $categoryGroup->delete();
        return redirect()->route('categoryGroup.index')->with('success',"Xóa thành công");
    }
}
