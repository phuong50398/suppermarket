@extends('layouts/master')

@section('content')
@include('shared.menu')
@include('shared.carousel')

<div class="product p-t-40">
    <div class="container">
        <div class="col-md-12">
            <div class="spec ">
                <h3>{{(!empty($namecg) && isset($namecg['name'])) ?  $namecg['name']   : "Kết quả tìm kiếm"}}</h3>
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
                                @if (isset($item->price_sale))
                                <p ><label>{{number_format($item->price)}} đ</label> <em class="item_price">{{number_format($item->price_sale)}} đ</em></p>
                                @else
                                <p ><em class="item_price">{{number_format($item->price)}} đ</em></p>
                                @endif
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
