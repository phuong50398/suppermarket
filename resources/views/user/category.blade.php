@extends('layouts/master')

@section('content')
@include('shared.menu')
@include('shared.carousel')

<div class="product p-t-40">
    <div class="container">
        <div class="col-md-12">
            <div class="spec ">
                <h3>{{$list_product[0]->grname}}</h3>
                <div class="ser-t">
                    <b></b>
                    <span><i></i></span>
                    <b class="line"></b>
                </div>
            </div>
        </div>
        <div class=" con-w3l">
            @foreach ($list_product as $item)
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
    <div class="col-md-12 text-center">
        <ul class="pagination">
            <li><a href="{{url()->current()}}?item={{$type}}"><span aria-hidden="true">«</span></span></a></li>
                @for ($i = 1; $i <= $list_product->lastPage(); $i++)
                    <li class="{{($list_product->currentPage()==$i) ? 'active' : ''}}"><a href="{{url()->current()}}?item={{$type}}&page={{$i}}" >{{$i}}</a></li>
                @endfor
            <li><a href="{{url()->current()}}?item={{$type}}&page={{$list_product->lastPage()}}"><span aria-hidden="true">»</span></span></a></li>
        </ul>
    </div>
</div>
@endsection