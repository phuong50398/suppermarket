@extends('layouts/master')

@section('content')
@include('shared.menu')
@include('shared.carousel')
<div class="check-out">
    <div class="container">
        <div class="spec ">
            <h3>Giỏ hàng</h3>
            <div class="ser-t">
                <b></b>
                <span><i></i></span>
                <b class="line"></b>
            </div>
        </div>
        <script>
        $(document).ready(function(c) {
            $('.close1').on('click', function(c) {
                $('.cross').fadeOut('slow', function(c) {
                    $('.cross').remove();
                });
            });
        });
        </script>
        <script>
        $(document).ready(function(c) {
            $('.close2').on('click', function(c) {
                $('.cross1').fadeOut('slow', function(c) {
                    $('.cross1').remove();
                });
            });
        });
        </script>
        <script>
        $(document).ready(function(c) {
            $('.close3').on('click', function(c) {
                $('.cross2').fadeOut('slow', function(c) {
                    $('.cross2').remove();
                });
            });
        });
        </script>
        <table class="table ">
            <tr>
                <th class="t-head head-it ">Sản phẩm</th>
                <th class="t-head">Giá</th>
                <th class="t-head">Số lượng</th>
                <th class="t-head">Thành tiền</th>
            </tr>
            @foreach ($mycart['cart_detail'] as $item)
            <tr class="cross">
                <td class="ring-in t-data">
                    <a href="{{url($item['product']->slug)}}" class="at-in">
                        <img width='100px' src="{{url('public/'.$item['product']->images)}}" class="img-responsive" alt="">
                    </a>
                    <div class="sed">
                        <h5>{{$item['product']->name}}</h5>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="close1"> <i class="fa fa-times" aria-hidden="true"></i></div>
                </td>
                <td class="t-data">{{number_format($item['product']->price)}}</td>
                <td class="t-data">
                    <div class="quantity">
                        <div class="quantity-select">
                            <div class="entry value-minus">&nbsp;</div>
                            <div class="entry value"><span class="span-1">{{$item['amount']}}</span></div>
                            <div class="entry value-plus active">&nbsp;</div>
                        </div>
                    </div>
                </td>
                <td class="t-data">{{number_format($item['product']->price*$item['amount'])}} đ</td>
            </tr>
            @endforeach
        </table>
        <center>
        <button class=" add-1">Đặt hàng</button>
        </center>
    </div>
</div>
@endsection
