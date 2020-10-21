<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- //for-mobile-apps -->
    <link href="{{url('custom/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="{{url('custom/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{url('custom/css/util.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{url('custom/css/user.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{url('custom/css/font-awesome.css')}}" rel="stylesheet">
    <script src="{{url('custom/js/jquery-1.11.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    @section('content')

        @show
    <!--footer-->
    <div class="footer">
        <div class="container">
            <div class="clearfix"></div>
                <div class="footer-bottom">
                    <h2 ><a href="">CHIẾN HƯƠNG<span>Cửa hàng điện thoại uy tín Nam Định</span></a></h2>
                    
                    <div class=" address">
                        <div class="col-md-4 fo-grid1">
                                <p><i class="fa fa-home" aria-hidden="true"></i>12K Street , 45 Building Road Canada.</p>
                        </div>
                        <div class="col-md-4 fo-grid1">
                                <p><i class="fa fa-phone" aria-hidden="true"></i>+1234 758 839 , +1273 748 730</p>
                        </div>
                        <div class="col-md-4 fo-grid1">
                            <p><a href="mailto:info@example.com"><i class="fa fa-envelope-o" aria-hidden="true"></i>info@example1.com</a></p>
                        </div>
                        <div class="clearfix"></div>

                        </div>
                </div>
           
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-info">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
                </div>
                <div class="modal-body modal-spa">
                        <div class="col-md-5 span-2">
                            <div class="item p-image">
                                <img src="images/of12.png" class="img-responsive" alt="">
                            </div>
                        </div>
                        <div class="col-md-7 span-1 ">
                            <h3 class="p-name">Honey(500 g)</h3>
                            <div class="price_single">
                            <p class="in-para"> 
                                <span class="reducedfrom p-price"></span>
                            </p>
                             <div class="clearfix"></div>
                            </div>
                            <div class="p-js-classify">
                               
                            </div>
                            
                             <div class="add-to">
                                
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
<!-- //footer-->
//@if(Auth::check())
// content 
//@endif
</body>
<script src="{{url('custom/js/bootstrap.js')}}"></script>
<script src="{{url('custom/js/jquery.flexslider.js')}}"></script>
<script src="{{url('custom/js/user.js')}}"></script>

</html>
