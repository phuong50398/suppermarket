<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\CategoryGroup;
use App\Model\CategoryType;

class ProductController extends Controller
{
    public function index(Request $request, $slug)
    {
        $categoryGroup = CategoryGroup::with(['category' => function($cg) {
            $cg->where('active', '=', 1)->with(['categoryType' => function($c){
                $c->where('active', '=', 1);
            }]);
        }])->where('active',1)->get();

        $product = Product::with(['album'])
                            ->where('slug', $slug)
                            ->where('active', 1)
                            ->get();
        $related_products = Product::with(['categoryType'])
                                    ->where('active', 1)
                                    ->where('category_type_id', $product[0]->category_type_id)
                                    ->limit(8)
                                    ->orderBy('id', 'DESC')
                                    ->get();
        $data['listMenu'] = $categoryGroup;
        $data['product'] = $product[0];
        $data['related_products'] = $related_products;
        // dd($related_products);
        return view('user.product', $data);
    }
}
