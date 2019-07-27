@extends('layouts/master')
@section('content')
@include('shared.menu')
@include('shared.carousel')
<div class="product p-t-40">
    <div class="container">
        <div class="col-md-12">
            <div class="spec ">
                <h3>SẢN PHẨM BÁN CHẠY</h3>
                <div class="ser-t">
                    <b></b>
                    <span><i></i></span>
                    <b class="line"></b>
                </div>
            </div>
        </div>
        <div class=" con-w3l">
            @foreach ($hot_product as $item)
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
        @foreach ($group_product as $group)
            <div class="col-md-12">
                <div class="spec ">
                    <h3>{{$group['name']}}</h3>
                    <div class="ser-t">
                        <b></b>
                        <span><i></i></span>
                        <b class="line"></b>
                    </div>
                </div>
            </div>
            <div class=" con-w3l">
                @foreach ($group['list_product'] as $item)
                    <div class="col-md-3 pro-1">
                        <div class="col-m">
                            <a href="{{url($item->slug)}}" data-toggle="modal" data-target="#myModal24" class="offer-img">
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
        @endforeach
    </div>
</div>
@endsection
