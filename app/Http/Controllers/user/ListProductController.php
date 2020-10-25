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
   
            $list_product = Product::select('products.*', 'categories.name as ctname')->where('products.active', 1)
                                        ->join('categories', 'products.category_id','=','categories.id')
                                        ->where('categories.active',1)->where('categories.slug',$name)->latest()->paginate(8);
        
        $category = Category::where('active',1)->orderBy('id','DESC')->limit(6)->get();
        $namecg = '';
        $namecg = Category::where('slug',$name)->get()->toArray();
        if(isset($namecg[0])){
            $data['namecg'] = $namecg[0];
        }else{
            $data['namecg'] = [];
        }
        $data['category'] = $category;
        $data['list_product'] = $list_product;
        $data['type'] = request()->query('item');
        return view('user.category', $data);
    }
}
