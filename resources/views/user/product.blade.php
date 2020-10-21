@extends('layouts/master')

@section('content')
@include('shared.menu')
@include('shared.carousel')
<link rel="stylesheet" href="{{url('custom/css/flexslider.css')}}" type="text/css" media="screen" />
<div class="single p-t-40">
    <div class="container">
        <div class="single-top-main">
            <div class="col-md-5 single-top">
                <div class="single-w3agile">
                    <div id="picture-frame">
                        <div class="flexslider">
                            <ul class="slides">
                                @foreach ($product->album as $item)
                                    <li data-thumb="{{url('public/'.$item->link)}}">
                                        <div class="thumb-image">
                                        <img src="{{url('public/'.$item->link)}}" data-imagezoom="true"   class="img-responsive" alt=""> </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 single-top-left ">
                <div class="single-right">
                    <h3>{{$product->name}}</h3>
                    <div class="pr-single">
                    <p class="reduced "><del>{{$product->price}} đ</del>{{$product->price}} đ</p>
                    </div>
                    <div class="block block-w3">
                        <div class="starbox small ghosting"> </div>
                    </div>
                    <p class="in-pa"> {{$product->summary}}</p>
                    <div class="add add-3">
                        <button  data-toggle="modal" data-target="#myModal" class="btn btn-danger my-cart-btn my-cart-b" data-id="{{$product->id}}">Thêm giỏ hàng</button>
                        <button class="btn btn-danger my-cart-btn my-cart-b muangay"  data-id="{{$product->id}}">Mua ngay</button>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="col-md-12 p-t-40">
            <h3 class="fs-21 p-b-30">MÔ TẢ SẢN PHẨM</h3>
            <div class="col-md-12 mota">
                {{$product->description}}
            </div>
        </div>

        <div class="col-md-12 p-t-50">
            <div class="spec ">
                <h3>SẢN PHẨM LIÊN QUAN</h3>
                <div class="ser-t">
                    <b></b>
                    <span><i></i></span>
                    <b class="line"></b>
                </div>
            </div>
        </div>
        <div class=" con-w3l">
            @foreach ($related_products as $item)
                <div class="col-md-3 pro-1">
                    <div class="col-m">
                        <a href="{{url($item->slug)}}" class="offer-img">
                            <img src="{{url('public/'.$item->images)}}" class="img-responsive" alt="">
                        </a>
                        <div class="mid-1">
                            <div class="name_product">
                                <h6><a href="{{url($item->slug)}}">{{$item->name}}</a></h6>
                            </div>
                            <div class="mid-2">
                                <p ><label>{{$item->price}} đ</label> <em class="item_price">{{$item->price}} đ</em></p>
                                    <div class="block">
                                    <div class="starbox small ghosting"> </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="add">
                                <button  data-toggle="modal" data-target="#myModal" class="btn btn-danger my-cart-btn my-cart-b" data-id="{{$item->id}}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<script src="{{url('custom/js/imagezoom.js')}}"></script>
@endsection
