@extends('layouts/admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('custom/admin/assets/extra-libs/multicheck/multicheck.css')}}">
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Danh sách khuyến mãi</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Thiết lập hệ thống</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách khuyến mãi</li>
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
                            <th scope="col">Tên khuyến mãi</th>
                            <th scope="col">Phương thức</th>
                            <th scope="col">Chiết khấu</th>
                            <th scope="col">Bắt đầu</th>
                            <th scope="col">Kết thúc</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ($sale as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->method}}</td>
                                <td>{{number_format($item->discount)}}
                                     {{$item->unit == 'dong' ? 'đ' : '%'}}</td>
                                <td>{{date('H:i d/m/Y', strtotime($item->start_time))}}</td>
                                <td>{{date('H:i d/m/Y', strtotime($item->end_time))}}</td>
                                
                                <td>
                                    <a href="{{url('admin/sale/'.$item->id.'/edit')}}"><button class="btn btn-warning btn-sm">Sửa</button></a>
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
                    @for ($i = 1; $i <= $sale->lastPage(); $i++)
                        <li class="{{($sale->currentPage()==$i) ? 'active' : ''}} page-item"><a class="page-link" href="{{url()->current()}}?page={{$i}}" >{{$i}}</a></li>
                    @endfor
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}?page={{$sale->lastPage()}}"><span aria-hidden="true">»</span></span></a></li>
            </ul>
        </div>
    </div>
</div>
{{-- <script src="{{url('custom/admin/product.js')}}"></script> --}}
<script src="{{url('custom/admin/assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>

<script src="{{url('custom/admin/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
@endsection
