<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\CategoryGroup;

class ListProductController extends Controller
{
    public function index($name)
    {
        $type = request()->query('item');
        // dd($type);
        if($type=="item1"){
            $list_product = Product::select('products.*', 'category_groups.name as grname')->where('products.active', 1)
                                    ->join('category_types', 'products.category_type_id','=','category_types.id')
                                    ->where('category_types.active',1)
                                    ->join('categories', 'category_types.category_id','=','categories.id')
                                    ->where('categories.active',1)
                                    ->join('category_groups', 'categories.category_group_id','=','category_groups.id')
                                    ->where('category_groups.active',1)
                                    ->where('category_groups.slug',$name)->latest()->paginate(8);
            }else{
            if($type=="item2"){
                $list_product = Product::select('products.*', 'categories.name as grname')->where('products.active', 1)
                                        ->join('category_types', 'products.category_type_id','=','category_types.id')
                                        ->where('category_types.active',1)
                                        ->join('categories', 'category_types.category_id','=','categories.id')
                                        ->where('categories.active',1)
                                        ->where('categories.slug',$name)->latest()->paginate(8);
            }else{
                $list_product = Product::select('products.*', 'category_types.name as grname')->where('products.active', 1)
                                        ->join('category_types', 'products.category_type_id','=','category_types.id')
                                        ->where('category_types.active',1)->where('category_types.slug',$name)->latest()->paginate(8);
                // $list_product = CategoryType::where('active',1)->where('slug',$name)->latest()->paginate(8);
            }
        }
        $categoryGroup = CategoryGroup::with(['category' => function($cg) {
            $cg->where('active', '=', 1)->with(['categoryType' => function($c){
                $c->where('active', '=', 1);
            }]);
        }])->where('active',1)->get();

        $data['listMenu'] = $categoryGroup;
        $data['list_product'] = $list_product;
        $data['type'] = request()->query('item');
        // dd($list_product);
        return view('user.category', $data);
    }
}
