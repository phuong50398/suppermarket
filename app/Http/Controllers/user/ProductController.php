<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Sale;
use App\Model\SaleProduct;

class ProductController extends Controller
{
    public function index(Request $request, $slug)
    {
        // hàm lấy chi tiết 1 sp và các sp liên quan
        
        $listSale = Sale::with('saleProduct')
            ->where('sale',1)
            ->where('start_time','<=',date('Y-m-d H:i', time()))
            ->where('end_time','>=',date('Y-m-d H:i', time()))->get();

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

        $arrProduct = checkSale($related_products, $listSale);
        $saleProduct = checkSale($product, $listSale);

        $data['product'] = $saleProduct[$product[0]->id];
        $data['arrProduct'] = $arrProduct;
        $data['category'] = $category;
        $data['product'] = $product[0];
        $data['related_products'] = $related_products;
        // dd($related_products);
        return view('user.product', $data);
    }
}
