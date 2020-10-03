@extends('layouts/admin')
@section('content')
<div class="page-wrapper">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Danh mục</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Thiết lập hệ thống</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
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
                        <h3 class="panel-title">Danh mục</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{(isset($action)) ? route('category.update', $category->id) : route('category.store')}}" method="POST" class="form-horizontal">
                            @csrf
                            {{(isset($action)) ? method_field('PUT') : ""}}
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" value="{{(isset($action)) ? old('name', $category->name) : ""}}">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Trạng thái</label>
                                <div class="col-sm-9 custom-control custom-checkbox m-t-5">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing1" name="active" value="1" {{(isset($action) && old('active', $category->active)==1) ? "checked" : ""}}>
                                    <label class="custom-control-label" for="customControlAutosizing1">Active</label>
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
                        <h3 class="panel-title">Danh sách danh mục</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Trạng thái</th>
                                    <th>Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listCategory as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>
                                        
                                        <td>{!! ($item->active ==1) ? "<label class='badge badge-success'>active</label>" : "<label class='badge badge-secondary'>not active</label>" !!}</td>
                                        <td>
                                            <a href="{{route('category.edit', $item->id)}}"><button class="btn btn-warning btn-sm" title="Sửa"><i class="fas fa-edit"></i></button></a>
                                            <form action="{{route('category.destroy', $item->id)}}" method="POST" style="display: contents;">
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
