<?php

namespace App\Http\Controllers\user;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Classify;
use App\Model\Cart;
use App\Model\CartDetail;
use App\Model\ProductClassification;

class CartController extends Controller
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

        $mycart =  Cart::with(['cartDetail' => function($c){
        }])->where('user_id', Auth::user()->id)->first()->toArray();
        foreach ($mycart['cart_detail'] as $k => $detail){
            $mycart['cart_detail'][$k]['product'] = Product::find($detail['product_id']);
            $mycart['cart_detail'][$k]['product_classify'] = ProductClassification::find($detail['product_classification_id']);
            $mycart['cart_detail'][$k]['classify'] = Classify::find($mycart['cart_detail'][$k]['product_classify']->classify_id);

        }
// dd($mycart);
        $data['category'] = $category;
        $data['mycart'] = $mycart;

        return view('user.cart', $data);
    }
}
