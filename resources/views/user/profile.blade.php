@extends('layouts/master')

@section('content')
@include('shared.menu')
{{-- @include('shared.carousel') --}}
<link rel="stylesheet" href="{{url('custom/dist/css/select2.min.css')}}">
<div class="single p-t-40">
    <div class="container">
        <div class="col-md-12 p-t-20">
            <div class="spec ">
                <h3>Thông tin khách hàng</h3>
                <div class="ser-t">
                    <b></b>
                    <span><i></i></span>
                    <b class="line"></b>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <form action="{{route('profile.update', Auth::user()->id)}}" method="post"  enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                <div class="col-md-5">
                    <label>Họ tên</label>
                    <input type="text" name="hoten" class="form-control" value="{{Auth::user()->name}}" required>
                    <label>Ngày sinh</label>
                    <input type="date" name="ngaysinh" class="form-control" value="{{Auth::user()->birth}}">
                    <label>Giới tính</label>
                    <div>
                        <input type="radio" name="gioitinh" value="Nam" id="nam" {{Auth::user()->gender == "Nam" ? 'checked' : ''}}><label for="nam">Nam</label>
                        <input type="radio" name="gioitinh" value="Nữ" id="nu" {{Auth::user()->gender == "Nữ" ? 'checked' : ''}}><label for="nu">Nữ</label>
                    </div>
                    <label>Số điện thoại</label>
                    <input type="number" name="sdt" class="form-control"  value="{{Auth::user()->phone}}" required>
                </div>
                <div class="col-md-5">
                    <label>Tỉnh/Thành phố</label>
                    <select name="tinh" class="form-control select2"  required>
                        <option value="">-----Chọn tỉnh-----</option>
                        @foreach ($city as $item1)
                            <option value="{{$item1->id}}" {{$address != null ? ($address->tinh == $item1->id ? 'selected' : '') : ''}}>{{$item1->name_city}}</option>
                        @endforeach
                    </select>
                    <label>Quận/Huyện</label>
                    <select name="huyen" class="form-control select2" required>
                        <option value="">-----Chọn quận/huyện-----</option>
                        @foreach ($district as $item)
                            @if ($address != '' && $item->city_id == $address->tinh)
                                <option value="{{$item->id}}" {{$address != null ? ($address->huyen == $item->id ? 'selected' : '') : ''}}>{{$item->name_district}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>Phường/Xã</label>
                    <select name="xa" class="form-control select2"  required>
                        <option value="">-----Chọn phường/xã-----</option>
                        @foreach ($town as $item)
                            @if ($address!='' && $item->district_id == $address->huyen)
                                <option value="{{$item->id}}" {{$address != null ? ($address->xa == $item1->id ? 'selected' : '') : ''}}>{{$item->name_town}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>Số nhà, Thôn, Xóm</label>
                    <input type="text" name="diachi" class="form-control"  value="{{$address != '' ? $address->diachi : ''}}" required>
                </div>
                <div class="col-md-2 text-center m-a">
                    <div class="col-xs-12">
                        @if (Auth::user()->avatar)
                        <a href="{{url('public/'.Auth::user()->avatar)}}" class="thumbnail">
                            <img src="{{url('public/'.Auth::user()->avatar)}}">
                        </a>
                        @else
                        <a href="{{url('custom/images/icon/user.png')}}" class="thumbnail">
                            <img src="{{url('custom/images/icon/user.png')}}">
                        </a>
                        @endif
                    </div>
                    <input type="file" name="images" id=""  class="fileimg">
                </div>
                <div class="col-md-12 text-center m-b-50 m-t-20">
                    <button type="submit" class=" btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu thông tin</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{url('custom/dist/js/select2.min.js')}}"></script>
<script src="{{url('custom/js/profile.js')}}"></script>
<script>
$('.select2').select2();
</script>
<style>
label{
    margin-top: 14px;
}
.select2{
    border: 1px solid #ccc;
    border-radius: 4px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 32px;
}
.fileimg{
    font-size: 15px;
    width: 77px;
    margin: auto;
}
</style>
@endsection
