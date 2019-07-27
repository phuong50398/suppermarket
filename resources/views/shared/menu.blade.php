<div class="header">
    <div class="container-fluid ">
        <div class="logo">
            <h1 ><a href="index.html"><b>T<br>H<br>E</b>Big Store<span>The Best Supermarket</span></a></h1>
        </div>
        <div class="head-t">
            <ul class="card">
                <li><a href="wishlist" ><i class="fa fa-heart" aria-hidden="true"></i>Wishlist</a></li>
                <li><a href="login" ><i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
                <li><a href="register" ><i class="fa fa-arrow-right" aria-hidden="true"></i>Register</a></li>
                <li><a href="about" ><i class="fa fa-file-text-o" aria-hidden="true"></i>Order History</a></li>
                <li><a href="shipping" ><i class="fa fa-ship" aria-hidden="true"></i>Shipping</a></li>
            </ul>
        </div>
        <div class="header-ri">
            <ul class="social-top">
                <li><a href="#" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span></span></a></li>
                <li><a href="#" class="icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span></span></a></li>
                <li><a href="#" class="icon pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span></span></a></li>
                <li><a href="#" class="icon dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i><span></span></a></li>
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
                        @foreach ($listMenu as $categoryGroup)
                            <li  class="dropdown ">
                                {{-- <a href="\">a</a> --}}
                                <a href="{{url('category/'.$categoryGroup->slug)}}?item=item1" class="hyper" ><span>{{$categoryGroup->name}}<b class="caret"></b></span></a>
                                <ul class="dropdown-menu multi">
                                    <div class="col-md-12 p-l-0 p-r-0">
                                        @foreach ($categoryGroup->category as $category)
                                            <div class="col-sm-4">
                                                <p class="submenu"><a href="{{url('category/'.$category->slug)}}?item=item2">{{$category->name}}</a></p>
                                                <ul class="multi-column-dropdown">
                                                    @foreach ($category->categoryType as $categoryType)
                                                    <li><a href="{{url('category/'.$categoryType->slug)}}?item=item3"><i class="fa fa-angle-right" aria-hidden="true"></i>{{$categoryType->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                        <div class="clearfix"></div>
                                    </div>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <div class="cart">
                <span class="fa fa-shopping-cart my-cart-icon" style="position: absolute; background-color: inherit;"><span class="badge badge-notify my-cart-badge">1</span></span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
