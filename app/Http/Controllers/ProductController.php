<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\CategoryGroup;
use App\Http\Resources\CategoryGroupResource ;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['hot_product'] = Product::where('active', 1)->orderBy('number_sold','DESC')->limit(8)->get();
        $categoryGroup = CategoryGroup::with(['category' => function($cg) {
            $cg->where('active', '=', 1)->with(['categoryType' => function($c){
                $c->where('active', '=', 1);
            }]);
        }])->where('active',1)->get();
        $group_product = [];
        foreach ($categoryGroup as $key => $cg) {
            $group_product[$key]['id'] = $cg->id;
            $group_product[$key]['name'] = $cg->name;
            foreach ($cg->category as $kc => $c) {
                foreach ($c->categoryType as $kct => $ct){
                    $group_product[$key]['category_type_id'][] = $ct->id;
                }
            }

        }

        foreach ($group_product as $key => $value) {
            $group_product[$key]['list_product'] = Product::whereIn('category_type_id', $group_product[$key]['category_type_id'])->where('active',1)->limit(8)->get();
        }
        $data['group_product'] = $group_product;
        return $data;
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
