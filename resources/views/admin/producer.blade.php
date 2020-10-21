@extends('layouts/admin')
@section('content')
<div class="page-wrapper">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Quản lý nhà sản xuất</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Quản lý đối tác</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Nhà sản xuất</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nhà sản xuất</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{(isset($action)) ? route('producer.update', $producer->id) : route('producer.store')}}" method="POST" class="form-horizontal"  enctype="multipart/form-data">
                            @csrf
                            {{(isset($action)) ? method_field('PUT') : ""}}
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tên *</label>
                                <div class="col-sm-9">
                                    <input required type="text" class="form-control" name="name" value="{{(isset($action)) ? old('name', $producer->name) : ""}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Code *</label>
                                <div class="col-sm-9">
                                    <input type="text" required class="form-control" name="code" value="{{(isset($action)) ? old('code', $producer->code) : ""}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" value="{{(isset($action)) ? old('email', $producer->email) : ""}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="phone" value="{{(isset($action)) ? old('phone', $producer->phone) : ""}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address" value="{{(isset($action)) ? old('address', $producer->address) : ""}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hình ảnh</label>
                                <div class="col-sm-9">
                                    <input type="file" name="images">
                                </div>
                            </div>
                            <div class="form-group row text-center m-t-35 m-auto">
                                <button type="submit" class="btn btn-success m-auto"><i class=" fas fa-save" aria-hidden="true"></i> {{(isset($action)) ? "Cập nhật" : "Lưu"}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh sách nhà sản xuất</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th>Email & SĐT</th>
                                    <th>Địa chỉ</th>
                                    <th>Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($producers as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img src="{{url('public/'.$item->logo)}}" alt="" width="50px"></td>
                                        <td>{{$item->name}} ({{$item->code}})</td>
                                        <td>{{$item->email}} <br> {{$item->phone}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>
                                            <a href="{{route('producer.edit', $item->id)}}"><button class="btn btn-warning btn-sm" title="Sửa"><i class="fas fa-edit"></i></button></a>
                                            <form action="{{route('producer.destroy', $item->id)}}" method="POST" style="display: contents;">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"" onclick="return confirm('Are you sure?')" {{(count($item->product)>0) ? 'disabled' : ""}} title="Xóa"><i class=" fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
