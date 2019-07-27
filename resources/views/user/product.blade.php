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
                                    <li data-thumb="{{$item->link}}">
                                        <div class="thumb-image">
                                        <img src="{{$item->link}}" data-imagezoom="true"   class="img-responsive" alt=""> </div>
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
                    <ul class="social-top">
                        <li><a href="#" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span></span></a></li>
                        <li><a href="#" class="icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span></span></a></li>
                        <li><a href="#" class="icon pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span></span></a></li>
                        <li><a href="#" class="icon dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i><span></span></a></li>
                    </ul>
                    <div class="add add-3">
                        <button class="btn btn-danger my-cart-btn my-cart-b themgiohang" data-id="{{$product->id}}">Thêm vào giỏ hàng</button>
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
                                <button class="btn btn-danger my-cart-btn my-cart-b" data-id="1" data-name="product 1" data-summary="summary 1" data-price="0.80" data-quantity="1" data-image="images/of23.png">Add to Cart</button>
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
