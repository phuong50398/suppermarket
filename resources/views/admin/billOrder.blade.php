@extends('layouts/admin')
@section('content')
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Danh sách đơn hàng</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Quản lý bán hàng</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
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
                            <th scope="col" style="width: 10%">Khách hàng</th>
                            <th scope="col">Email</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày đặt hàng</th>
                            <th scope="col">Phí vận chuyển</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col" style="width: 20%">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ($purchase as $item)
                            <tr>
                                <td class="text-center">
                                    @if ($item->user->avatar)
                                    <img src="{{url('public/'.$item->user->avatar)}}" alt="avatar" width="50px" >
                                @else
                                    <img src="{{url('custom/images/icon/user.png')}}" alt="avatar" width="50px" >
                                @endif
                                    <p>{{$item->user->name}}</p></td>
                                <td>{{$item->user->email}}</td>
                                <td>{{$item->user->phone}}</td>
                                <td>{{$item->delivery_address}}</td>
                                <td><label class='badge {{$constStatusColor[$item->status]}}'>{{$constStatus[$item->status]}}</label></td>
                                <td>{{date('d/m/Y', strtotime($item->date))}}</td>
                                <td>{{number_format($item->transport_fee)}}</td>
                                <td>{{number_format($item->total)}}</td>
                                <td>
                                    <button  data-toggle="modal" data-target="#myModal{{$item->id}}" class=" btn-sm btn btn-primary">Chi tiết</button>
                                    @if ($item->status!=3 && $item->status!=5)
                                        <form action="{{route('billOrder.update', $item->id)}}" method="POST" style="display: contents;">
                                            @method('PUT')
                                            @csrf
                                            <button name="status" value="{{$item->status+1}}" type="submit" class="btn btn-success btn-sm">Chuyển tiếp</button>
                                        </form>
                                        <form action="{{route('billOrder.update', $item->id)}}" method="POST" style="display: contents;">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" name="status" value="5" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn?')">Hủy đơn</button>
                                        </form>
                                    @endif
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
                    @for ($i = 1; $i <= $purchase->lastPage(); $i++)
                        <li class="{{($purchase->currentPage()==$i) ? 'active' : ''}} page-item"><a class="page-link" href="{{url()->current()}}?page={{$i}}" >{{$i}}</a></li>
                    @endfor
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}?page={{$purchase->lastPage()}}"><span aria-hidden="true">»</span></span></a></li>
            </ul>
        </div>
    </div>
</div>

@foreach ($purchase as $item)
<div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
            </div>
            <div class="modal-body modal-spa">
                <h3 class="p-name">Đơn hàng ngày {{date('d/m/Y', strtotime($item->date))}}
                    ({{$constStatus[$item->status]}})</h3>
                <div class="panel panel-info m-b-20">
                    <div class="panel-body">
                        <table class="table table-bordered m-t-20">
                            <tr class="th-table">
                                <th class="t-head head-it text-center">Hình ảnh</th>
                                <th class="t-head">Sản phẩm</th>
                                <th class="t-head text-center">Giá</th>
                                <th class="t-head text-center">Số lượng</th>
                            </tr>
                            @foreach ($item->purchaseOrderDetail as $detail)
                                <tr class="cross">
                                    <td class="ring-in t-data">
                                        <img width='60px' src="{{url('public/'.$detail->product->images)}}" class="img-responsive" alt="">                                        
                                    </td>
                                    <td class="t-data">
                                        {{$detail->product->name}}
                                    </td>
                                    <td class="t-data text-center">{{number_format($detail->price)}} đ</td>
                                    <td class="t-data text-center">{{$detail->amount}}</td>
                                </tr>
                            @endforeach
                        </table>
                        <h4 class="phivanchuyen text-right">Phí vận chuyển: {{number_format($item->transport_fee)}} đ</h4>
                        <h3 class="tongtien text-right">
                            Thanh toán: {{number_format($item->total)}} đ
                        </h3>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<script src="{{url('custom/admin/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
@endsection
