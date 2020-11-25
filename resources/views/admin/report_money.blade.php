@extends('layouts/admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('custom/admin/assets/extra-libs/multicheck/multicheck.css')}}">
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Báo cáo tài chính</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Báo cáo thống kê</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Báo cáo tài chính</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
            <div class="col-md-12 p-b-20">
                <form action="" method="get">
                    <div class="row">
                            <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="row">
                                    <label class=" control-label col-form-label p-l-10">Chọn tháng</label>
                                    <div class="col-md-11">
                                        <select required name="thang" class="form-control">
                                            <option value="tatca">Tất cả</option>
                                            @for ($i = 1; $i < 13; $i++)
                                                <option {{($thang == $i) ? "selected" : ""}} value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="row">
                                    <label class=" control-label col-form-label p-l-10">Chọn năm</label>
                                    <div class="col-md-11">
                                        <select required name="nam" class="form-control">
                                            <option value="tatca">Tất cả</option>
                                            @for ($i = 2019; $i < date('Y',time())+5; $i++)
                                                <option {{($nam == $i) ? "selected" : ""}} value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <div class="row">
                                    <label class=" control-label col-form-label p-l-10">Tên sản phẩm</label>
                                    <div class="col-md-11">
                                        <input type="text" class="form-control" name="" id="">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-2 m-auto">
                            <button type="submit" name="search" class="btn btn-primary"> <i class=" fas fa-search"></i> Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center">Ngày</th>
                            <th scope="col" class="text-center">Tổng tiền</th>
                            <th scope="col" class="text-center">Tổng tiền hàng</th>
                            <th scope="col" class="text-center">Tổng phí vận chuyển</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ($report as $item)
                            <tr>
                                <td class="text-center">{{date('d/m/Y', strtotime($item->date))}}</td>
                                <td>{{number_format($item->sumtotal)}}</td>
                                <td class="text-center">{{number_format($item->sumtotal-$item->sumfee)}}</td>
                                <td class="text-center">{{number_format($item->sumfee)}}</td>
                                
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 p-r-60 p-t-20">
            <ul class="pagination" style="float: right">
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}"><span aria-hidden="true">«</span></span></a></li>
                    @for ($i = 1; $i <= $report->lastPage(); $i++)
                        <li class="{{($report->currentPage()==$i) ? 'active' : ''}} page-item"><a class="page-link" href="{{url()->current()}}?page={{$i}}" >{{$i}}</a></li>
                    @endfor
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}?page={{$report->lastPage()}}"><span aria-hidden="true">»</span></span></a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
