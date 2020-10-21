@extends('layouts/admin')
@section('content')
<div class="page-wrapper">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Phân loại sản phẩm</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Phân loại sản phẩm</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row">
            <div class="col-md-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Phân loại sản phẩm</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{(isset($action)) ? route('classify.update', $classify->id) : route('classify.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            {{(isset($action)) ? method_field('PUT') : ""}}
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Loại (Size, Màu sắc...) *</label>
                                <div class="col-sm-9">
                                    <input required type="text" class="form-control" name="type" value="{{(isset($action)) ? old('type', $classify->type) : ""}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Giá trị (S, M, L...) *</label>
                                <div class="col-sm-9">
                                    <input type="text" required class="form-control" name="value" value="{{(isset($action)) ? old('value', $classify->value) : ""}}">
                                </div>
                            </div>
                            
                            <div class="form-group row text-center m-t-35 m-auto">
                                <button type="submit" class="btn btn-success m-auto"><i class=" fas fa-save" aria-hidden="true"></i> {{(isset($action)) ? "Cập nhật" : "Lưu"}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh sách phân loại</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Loại</th>
                                    <th>Giá trị</th>
                                    <th>Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classifies as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->value}}</td>
                                        <td>
                                            <a href="{{route('classify.edit', $item->id)}}"><button class="btn btn-warning btn-sm" title="Sửa"><i class="fas fa-edit"></i></button></a>
                                            <form action="{{route('classify.destroy', $item->id)}}" method="POST" style="display: contents;">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"" onclick="return confirm('Are you sure?')" {{(count($item->productClassify)>0) ? 'disabled' : ""}} title="Xóa"><i class=" fas fa-trash-alt"></i></button>
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
