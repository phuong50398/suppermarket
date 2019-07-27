@extends('layouts/admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('custom/admin/assets/extra-libs/multicheck/multicheck.css')}}">
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Danh sách sản phẩm</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <label class="customcheckbox m-b-20">
                                    <input type="checkbox" id="mainCheckbox" />
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th scope="col">Ảnh đại diện</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Loại danh mục</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ($listProduct as $item)
                            <tr>
                                <th>
                                    <label class="customcheckbox">
                                        <input type="checkbox" class="listCheckbox" />
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <td><img src="{{url('public/'.$item->images)}}" alt="" width="100px"></td>
                                <td>{{$item->name}}</td>
                                <td>{{number_format($item->price)}}₫</td>
                                <td>{{$arrCategoryType[$item->category_type_id]}}</td>
                                <td>{!! ($item->active ==1) ? "<label class='badge badge-success'>active</label>" : "<label class='badge badge-secondary'>not active</label>" !!}</td>
                                <td>
                                    <a href="{{url('admin/product/'.$item->id.'/edit')}}"><button class="btn btn-warning btn-sm">Sửa</button></a>
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 p-r-60 p-t-20">
            <ul class="pagination" style="float: right">
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}"><span aria-hidden="true">«</span></span></a></li>
                    @for ($i = 1; $i <= $listProduct->lastPage(); $i++)
                        <li class="{{($listProduct->currentPage()==$i) ? 'active' : ''}} page-item"><a class="page-link" href="{{url()->current()}}?page={{$i}}" >{{$i}}</a></li>
                    @endfor
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}?page={{$listProduct->lastPage()}}"><span aria-hidden="true">»</span></span></a></li>
            </ul>
        </div>
    </div>
</div>
{{-- <script src="{{url('custom/admin/product.js')}}"></script> --}}
<script src="{{url('custom/admin/assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>

<script src="{{url('custom/admin/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
@endsection
