<div class="header">
    <div class="container-fluid ">
        <div class="logo">
            <h1 ><a href="">CHIẾN HƯƠNG<span>Cửa hàng điện thoại uy tín Nam Định</span></a></h1>
        </div>
        <div class="head-t">
            <ul class="card">
                @if(Auth::check())
                <li><a href="" ><i class="fa fa-user" aria-hidden="true"></i>{{Auth::user()->name}}</a></li>
                <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-arrow-right" aria-hidden="true"></i>Đăng xuất</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <li><a href="login" ><i class="fa fa-user" aria-hidden="true"></i>Đăng nhập</a></li>
                <li><a href="register" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Đăng ký</a></li>
                @endif
            </ul>
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
            <div class="cart">
                <a href="{{url('carts')}}"><span class="fa fa-shopping-cart my-cart-icon" style="position: absolute; background-color: inherit;"><span class="badge badge-notify my-cart-badge">0</span></span></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
