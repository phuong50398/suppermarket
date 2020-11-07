@extends('layouts/master')

@section('content')
@include('shared.menu')
{{-- @include('shared.carousel') --}}
<div class="single p-t-40">
    <div class="container">
        <div class="col-md-12 p-t-20">
            <div class="spec ">
                <h3>Đơn đặt hàng</h3>
                <div class="ser-t">
                    <b></b>
                    <span><i></i></span>
                    <b class="line"></b>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @foreach ($purchase as $item)
                <div class="panel panel-info m-b-20">
                    <div class="panel-heading fs-19">Đơn hàng ngày {{date('d/m/Y', strtotime($item->date))}}
                        ({{$constStatus[$item->status]}})
                    </div>
                    <div class="panel-body">
                        <table class="table table-cart m-t-20">
                            <tr class="th-table">
                                <th class="t-head head-it text-center">Sản phẩm</th>
                                <th class="t-head text-center">Giá</th>
                                <th class="t-head text-center">Số lượng</th>
                            </tr>
                            @foreach ($item->purchaseOrderDetail as $detail)
                                <tr class="cross">
                                    <td class="ring-in t-data">
                                        <div class="sed"><a href="{{url('public/'.$detail->product->images)}}" class="at-in"><img src="{{url('public/'.$detail->product->images)}}" class="img-responsive" alt=""></a></div>
                                        <div class="sed"><a href="{{url($detail->product->slug)}}"><h5>{{$detail->product->name}}</h5></a></div></td>
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
                        @if ($item->status<3)
                            <form action="{{route('request', $item->id)}}" method="POST" style="display: contents;">
                                @method('post')
                                @csrf
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button style='float: right; margin: 10px;' name="status" value="4" type="submit" class="btn btn-danger btn-sm">Yêu cầu hủy đơn</button>
                            </form>
                        @endif
                    </div>
              </div>
            @endforeach
            
        </div>
    </div>
</div>
<style>
.panel-info>.panel-heading {
    color: #1b506b;
    background-color: #67b5dc;
    border-color: #64c1d4;
    padding: 15px;
}
.sed{
    display: contents;
}
.sed a{
    margin-right: 10px;
}
</style>
@endsection
