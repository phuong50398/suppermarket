<?php

namespace App\Http\Controllers\user;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Address;

class ProfileController extends Controller
{
    public function index()
    {
        $category = Category::where('active',1)->orderBy('id','DESC')->limit(6)->get();

        $data['listMenu'] = $category;
        $data['category'] = $category;
        $data['city'] = Address::city();
        $data['district'] = Address::district();
        $data['town'] = Address::town();
        return view('user.profile', $data);
    }
    public function update(Request $request, $id)
    {
        $path =  null;
        if($request->images){
            $path = $request->images->store('uploads/user','public');
            DB::table('users')
            ->where('id', $id)
            ->update(
                [
                'avatar' => $path,
                ]
            );
            
            Auth::user()->avatar = $path;
        }
        DB::table('users')
        ->where('id', $id)
        ->update(
            ['name' => $request->hoten,
             'birth' => $request->ngaysinh,
             'gender' => $request->gioitinh,
             'phone' => $request->sdt,
             'address' => json_encode((object)['tinh' => $request->tinh, 'huyen' => $request->huyen, 'xa' => $request->xa, 'diachi' => $request->diachi])
            ]
        );
        Auth::user()->name = $request->hoten;
        Auth::user()->ngaysinh = $request->ngaysinh;
        Auth::user()->gioitinh = $request->gioitinh;
        Auth::user()->sdt = $request->sdt;
        Auth::user()->tinh = $request->tinh;
        Auth::user()->huyen = $request->huyen;
        Auth::user()->xa = $request->xa;
        Auth::user()->diachi = $request->diachi;
        return redirect('/profile');
    }
    public function ajaxGetAndress(Request $request)
    {
        if($request->type=='huyen'){
            $district = array_filter(
                Address::district(),
                function ($key) use ($request){
                    return $key->city_id == $request->value;
                });
                
            return response()->json(array_values($district));
        }else{
            $town =  array_filter(Address::town(),
            function ($key) use ($request) {
                return $key->district_id == $request->value;
            });
            return response()->json(array_values($town));
        }
        
    }
    
}
