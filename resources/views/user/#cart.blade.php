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
        
        </script>
        <table class="table ">
            <tr>
                <th class="t-head head-it ">Sản phẩm</th>
                <th class="t-head">Giá</th>
                <th class="t-head">Số lượng</th>
                <th class="t-head">Thành tiền</th>
            </tr>
            @if(Auth::check())
                @foreach ($mycart['cart_detail'] as $item)
                <tr class="cross">
                    <td class="ring-in t-data">
                        <a href="{{url($item['product']->slug)}}" class="at-in">
                            <img width='100px' src="{{url('public/'.$item['product']->images)}}" class="img-responsive" alt="">
                        </a>
                        <div class="sed">
                            <h5>{{$item['product']->name}}</h5>
                            <span class="label label-info">{{$item['classify']->type}} - {{$item['classify']->value}}</span>
                        </div>
                        <div class="clearfix"> </div>
                        <div class="remove-cart close2" data-product="{{$item['product_id']}}" data-cart="{{$item['cart_id']}}" data-classify="{{$item['product_classification_id']}}"> <i class="fa fa-times" aria-hidden="true"></i></div>
                    </td>
                    <td class="t-data price" data-price="{{$item['product']->price}}">{{number_format($item['product']->price)}}</td>
                    <td class="t-data">
                        <div class="quantity">
                            <div class="quantity-select">
                                <div class="entry value-minus" data-product="{{$item['product_id']}}" data-cart="{{$item['cart_id']}}" data-classify="{{$item['product_classification_id']}}">&nbsp;</div>
                                <div class="entry value"><span class="span-1">{{$item['amount']}}</span></div>
                                <div class="entry value-plus active" data-product="{{$item['product_id']}}" data-cart="{{$item['cart_id']}}" data-classify="{{$item['product_classification_id']}}">&nbsp;</div>
                            </div>
                        </div>
                    </td>
                    <td class="t-data pay">{{number_format($item['product']->price*$item['amount'])}} đ</td>
                </tr>
                @endforeach
            @endif
        </table>
        <center>
        <button class=" add-1" id='cart-dathang'>Đặt hàng</button>
        </center>
    </div>
</div>
@endsection
