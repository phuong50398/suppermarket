<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Classify;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::where('active',1)->orderBy('id','DESC')->limit(6)->get();

        $data['listMenu'] = $category;
        $data['new_product'] = Product::with(['productClassify' => function($c){
        }])->where('active', 1)->orderBy('id','DESC')->limit(8)->get();

        foreach ($category as $key => $value) {
            $category[$key]['list_product'] = Product::with(['productClassify' => function($c){
            }])->where('category_id', $value->id)->where('active',1)->limit(8)->get();
        }
        $data['category'] = $category;

        return view('user.home', $data);
    }
    public function ajaxGetProduct(Request $request)
    {
        $product =  Product::with(['productClassify' => function($c){
        }])->where('id', $request->id)->get()->toArray();
        foreach ($product as $key => $value){
            foreach ($value['product_classify'] as $k => $cf){
                $product[$key]['product_classify'][$k]['classify'] = Classify::find($cf['classify_id'])->toArray();
            }
        }
        return response()->json($product);
    }
}
