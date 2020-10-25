<div class="header">
    <div class="container-fluid ">
        <div class="logo">
            <div class="col-md-12">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                <h1 ><a href="">CHIẾN HƯƠNG<span>Cửa hàng điện thoại uy tín Nam Định</span></a></h1>
                </div>
                <div class="col-sm-3 card">
                    @if (isset(Auth::user()->name))
                    <div class="menu-user">
                        @if (Auth::user()->avatar)
                            <img src="{{url('public/'.Auth::user()->avatar)}}" alt="avatar" width="30px" >
                        @else
                            <img src="{{url('custom/images/icon/user.png')}}" alt="avatar" width="30px" >
                        @endif
                        {{Auth::user()->name}}
                        <div class="item-menu-user">
                            <ul>
                                <a href="{{url('purchase')}}"><li>Đơn hàng</li></a>
                                <a href="{{url('profile')}}"><li>Thông tin cá nhân</li></a>
                                <a href="{{url('logout')}}"><li>Đăng xuất</li></a>
                            </ul>
                        </div>
                    </div>
                        {{-- <div class="dropdown-user hover">
                            <a href="#"><img src="{{url('custom/images/icon/user.png')}}" alt="avatar" width="40px"></a>
                            <ul>
                              <li><a href="#">Item</a></li>
                              <li><a href="#">Product</a></li>
                              <li><a href="#">Text</a></li>
                              <li><a href="#">Page</a></li>
                              <li><a href="#">Thing</a></li>
                              <li><a href="#">Product</a></li>
                              <li><a href="#">Text</a></li>
                            </ul>
                        </div> --}}
                    @else
                    <li><a href="{{url('login')}}" ><i class="fa fa-user" aria-hidden="true"></i>Đăng nhập</a></li>
                    <li><a href="{{url('register')}}" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Đăng ký</a></li>
                    @endif
                </div>
            </div>
        </div>
      
        <div class="header-ri">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 col-md-6 p-t-20 p-b-20">
                <div class="search-form">
                    <form action="{{route('searchProduct')}}" method="get">
                        <input type="text" placeholder="Tên sản phẩm..." name="search" required>
                        <input type="submit" value=" ">
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cart">
                    <a href="{{url('carts')}}"><span class="fa fa-shopping-cart my-cart-icon" style="position: absolute; background-color: inherit;"><span class="badge badge-notify my-cart-badge">0</span></span></a>
                </div>
            </div>
        </div>
        <div class="nav-top">
            <nav class="navbar navbar-default">
                <div class="navbar-header nav_2">
                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav ">
                        <li class=" active active1" ><a href="{{url('/')}}" class="hyper "><span>Home</span></a></li>
                        @foreach ($category as $categoryGroup)
                            <li>
                                <a href="{{url('category/'.$categoryGroup->slug)}}" class="hyper" ><span>{{$categoryGroup->name}}</span></a>             
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
