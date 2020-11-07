<?php

namespace App\Http\Controllers\admin;
use DB;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Address;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')
        ->where('level', 2)->latest()->paginate(20);
        foreach ($user as $item){
            $item->dc = $item->address ?  json_decode($item->address)->diachi.' - '.Address::findId('xa', json_decode($item->address)->xa)->name_town.' - '.Address::findId('huyen', json_decode($item->address)->huyen)->name_district.' - '.Address::findId('tinh', json_decode($item->address)->tinh)->name_city : '';
        }
        $data['user'] = $user;
        return View('admin/profile', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        if($request->password==''  || $request->repassword=='')
        {
            return redirect()->route('adminprofile.index')->with('error',"Vui lòng nhập dủ thông tin");
        }
        if($request->password != $request->repassword)
        {
            return redirect()->route('adminprofile.index')->with('error',"Mật khẩu nhập lại không đúng");
        }
                                         
        DB::table('users')
            ->where('id', $request->id)
            ->update(
                [
                'password' => Hash::make($request['password']),
                ]
            );
        return redirect()->route('adminprofile.index')->with('success',"Cập nhật thành công");
      
        
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
   
}
