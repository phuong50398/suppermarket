<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\CategoryGroup;

class HomeController extends Controller
{
    public function index()
    {
        // $categoryGroup = CategoryGroup::with(['category' => function($cg) {
        //     $cg->where('active', '=', 1)->with(['categoryType' => function($c){
        //         $c->where('active', '=', 1);
        //     }]);
        // }])->where('active',1)->get();

        // $data['listMenu'] = $categoryGroup;
        $data['hot_product'] = Product::where('active', 1)->orderBy('number_sold','DESC')->limit(8)->get();
        // $categoryGroup = CategoryGroup::with(['category' => function($cg) {
        //     $cg->where('active', '=', 1)->with(['categoryType' => function($c){
        //         $c->where('active', '=', 1);
        //     }]);
        // }])->where('active',1)->get();
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

        return view('user.home', $data);
    }
}
