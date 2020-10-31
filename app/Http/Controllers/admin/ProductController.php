<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Category;
use App\Model\Product;
use App\Model\Album;
use App\Model\ProductClassification;
use App\Model\Classify;
use App\Model\CartDetail;
use App\Model\PurchaseOrderDetail;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $arrCategory = [];
        // cái này lặp để gán id của danh mục thành key của mảng, khi đổ ra bảng ds sp thì có cột danh mục
        foreach ($category as $key => $value) {
            $arrCategory[$value->id] = $value->name;
         }
        $data['listProduct'] = Product::latest()->paginate(20);
        // dd($data['listProduct']);
        $data['category'] = $category;
        $data['arrCategory'] = $arrCategory;
        return View('admin/product', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // hàm này gọi khi vào trang thêm mới sp, trả về view create_product
        $classifies = DB::table('classifies')->get();

        // lấy ds danh mục để đổ ra ô select chọn danh mục cho sp, tương tự lấy nhà cc, nhà sx
        $category = Category::where('active',1)->get();
        // dd(stringcode(13,2));
        $data['classifies'] = $classifies;
        $data['category'] = $category;
        $data['producers'] = DB::table('producers')->get();
        $data['providers'] = DB::table('providers')->get();
        return View('admin/create_product', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save sp
        $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
        $nextId = $statement[0]->Auto_increment;

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->summary = $request->summary;
        $product->category_id = $request->category;
        $product->producer_id = $request->producer;
        $product->provider_id = $request->provider;

        // $product->album = $request->album;
        if($request->active != 1){
            $product->active = 0;
        }else{
            $product->active = $request->active;
        }
        // check độ lớn ảnh và album
        if($request->images->getSize() > 2096128){
            return redirect()->route('product.create')->with('warning',"Hình ảnh không được vượt quá 2047MB");
        }
        foreach ($request->album as $album) {
            if($album->getSize() > 2096128){
                return redirect()->route('product.create')->with('warning',"Hình ảnh không được vượt quá 2047MB");
            }
        }
        // upload và trả lại đường dẫn ảnh
        $path = $request->images->store('uploads','public');
        $product->images = $path;
        // cắt ảnh với kích thước 200x280
        $this->resize_crop_image(200, 280, "public/".$path, "public/thumbnails/".$path);

        $product->save();
        foreach ($request->album as $album) {
            $arralbum = new Album();
            $path = $album->store('uploads','public');
            $this->resize_crop_image(200, 280, "public/".$path, "public/thumbnails/".$path);
            $arralbum->link = $path;
            $arralbum->product_id = $nextId;
            $arralbum->save();
        }
        // lặp qua các phân loại sp để lưu vào bảng ProductClassification
        if($request->classifies != null){
            foreach ($request->classifies as $classify){
                $arrclassifies = new ProductClassification();
                $arrclassifies->classify_id = $classify;
                $arrclassifies->product_id = $nextId;
                $arrclassifies->save();
            }
        }
        return redirect()->route('product.edit',$nextId)->with('success',"Thêm thành công");
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
        // đổ lại dữ liêu vào form
        $product = Product::find($id);
        $arralbum = Album::where('product_id', $id)->get();
        $arrclassifies = ProductClassification::where('product_id', $id)->get();
        $arr = [];
        foreach ($arrclassifies as $key => $value) {
            $arr[] = $value->classify_id;
        }
        $classifies = DB::table('classifies')->get();
        // dd($arrclassifies);
        $category = Category::where('active',1)->get();
        // dd(count($arralbum));
        $data['classifies'] = $classifies;
        $data['category'] = $category;
        $data['producers'] = DB::table('producers')->get();
        $data['providers'] = DB::table('providers')->get();
        $data['product'] = $product;
        $data['arralbum'] = $arralbum;
        $data['arrclassifies'] = $arr;
        $data['action'] = 'edit';
        return View('admin/create_product', $data);
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
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->producer_id = $request->producer;
        $product->provider_id = $request->provider;
        if($request->active != 1){
            $product->active = 0;
        }else{
            $product->active = $request->active;
        }
        if($request->images!=null){
            if($request->images->getSize() > 2096128){
                return redirect()->route('product.create')->with('warning',"Hình ảnh không được vượt quá 2047MB");
            }
            $path = $request->images->store('uploads','public');
            $product->images = $path;
            $this->resize_crop_image(200, 280, "public/".$path, "public/thumbnails/".$path);
        }
        $product->save();

        if($request->album!=null){
            foreach ($request->album as $album) {
                if($album->getSize() > 2096128){
                    return redirect()->route('product.create')->with('warning',"Hình ảnh không được vượt quá 2047MB");
                }
            }
            $arralbum = new Album();
            foreach ($request->album as $album) {
                $path = $album->store('uploads','public');
                $this->resize_crop_image(200, 280, "public/".$path, "public/thumbnails/".$path);
                $arralbum->link = $path;
                $arralbum->product_id = $id;
                $arralbum->save();
            }
        }

        if($request->classifies != null){
            // dd($request->classifies);
            // $arrclassifies = ProductClassification::where('product_id', $id);
            // $arrclassifies->delete();

            foreach ($request->classifies as $classify){
                $check_order = ProductClassification::where('classify_id', $classify)->get();
                if(empty($check_order->toArray())){
                    $arrclassifies = new ProductClassification();
                    $arrclassifies->classify_id = $classify;
                    $arrclassifies->product_id = $id;
                    $arrclassifies->save();
                }
                
            }
        }
        return redirect()->route('product.edit',$id)->with('success',"Sửa thành công");
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
    public function getData()
    {
        // hàm này k dùng

        $classifies = DB::table('classifies')->get();

        $category = Category::where('active',1)->get();
        // dd(stringcode(13,2));
        $data['classifies'] = $classifies;
        $data['category'] = $category;
        $data['producers'] = DB::table('producers')->get();
        return data;
    }


    // hàm cắt ảnh
    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
        $imgsize = getimagesize($source_file);
        // dd($imgsize);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
    }


    // hàm nay để lưu phân loại khi ấn nút thêm ở trang tạo sp (gọi ajax)
    // hàm nào có chữ ajax ở đầu là bên jquery gọi ajax đến
    public function ajaxSaveClassify(Request $request)
    {
        $classify = new Classify();
        $classify->value = $request->value;
        $classify->type = $request->type;
        if($classify->save()){
            return response()->json($classify->id);
        }else{
            return response()->json('fail');
        }
    }
}
