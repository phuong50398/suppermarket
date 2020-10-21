<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;

class ProductController extends Controller
{
    public function index(Request $request, $slug)
    {
        $category = Category::where('active',1)->orderBy('id','DESC')->limit(6)->get();

        $product = Product::with(['album'])
                            ->where('slug', $slug)
                            ->where('active', 1)
                            ->get();
        $related_products = Product::with(['category'])
                                    ->where('active', 1)
                                    ->where('category_id', $product[0]->category_id)
                                    ->limit(8)
                                    ->orderBy('id', 'DESC')
                                    ->get();
        $data['category'] = $category;
        $data['product'] = $product[0];
        $data['related_products'] = $related_products;
        // dd($related_products);
        return view('user.product', $data);
    }
}
