@extends('layouts/master')

@section('content')
@include('shared.menu')
@include('shared.carousel')
<link href="{{url('custom/flat/orange.css')}}" rel="stylesheet">
<div class="check-out p-t-20">
    <div class="container">
        <div class="spec ">
            <h3>Giỏ hàng</h3>
            <div class="ser-t">
                <b></b>
                <span><i></i></span>
                <b class="line"></b>
            </div>
        </div>
        {{-- <script>
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
        </script> --}}
        <form action="{{route('buynow.store')}}" method="post">
            @csrf
            <table class="table table-cart">                
            </table>
            <div class="col-md-12 hidden-fee">
                <div class="col-md-8">
                    <h4 class="diachi">
                        {{--  Địa chỉ: {{Auth::user()->diachi}} <br> {{$town ? $town->name_town : ''}} - {{$district ? $district->name_district : ''}} - {{$city ? $city->name_city : ''}} <br>  --}}
                        Số điện thoại: {{Auth::user()->phone}}
                    </h4>
                </div>
                <div class="col-md-4">
                    @if (!empty(json_decode(Auth::user()->address)->diachi) && !empty(json_decode(Auth::user()->address)->tinh))
                        @if (json_decode(Auth::user()->address)->tinh=='1')
                            <h4 class="phivanchuyen" data-fee="20000">Phí vận chuyển: 20,000 đ</h4>
                        @else
                            <h4 class="phivanchuyen" data-fee="30000">Phí vận chuyển: 30,000 đ</h4>
                        @endif
                    @else
                        <h4 class="phivanchuyen hidden" data-fee="0">Phí vận chuyển: 0 đ</h4>
                    @endif
                    <h4 class="phivanchuyen tong" style="font-size: font-size: 20px;">
                        {{-- Giảm giá:  --}}
                    </h4>
                    <h5 class="phivanchuyen giamgia" style="font-size: font-size: 15px;">
                        {{-- Giảm giá:  --}}
                    </h5>
                    <h3 class="tongtien">
                    </h3>
                </div>
            </div>
            <div class="col-md-12 text-center m-t-20  hidden-fee">
                @if (!empty(json_decode(Auth::user()->address)->diachi) && !empty(json_decode(Auth::user()->address)->tinh) && !empty(Auth::user()->phone))
                    <button type="submit" class="btn btn-danger btn-lg" style="border-radius: 0;">Đặt hàng ngay</button>
                @else
                    <h4 class="text-danger">Vui lòng cập nhật thông tin để Đặt hàng 
                        <a href="{{url('profile')}}"><button type="button" class="btn btn-warning" style="border-radius: 0;">Cập nhật thông tin <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button></a>
                    </h4>
                @endif
            </div>
        </form>
    </div>
</div>
<script src="{{url('custom/icheck.js')}}"></script>
<script src="{{url('custom/js/cart.js')}}"></script>
<style>
    .hidden-fee{
        display: none;
    }
</style>
@endsection
