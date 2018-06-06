<aside>
<div id="sidebar" class="nav-collapse">
    <!-- sidebar menu start-->
    <div class="leftside-navigation">
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a class="active" href="{{route('admin.dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-rss"></i>
                    <span>Article</span>
                </a>
                <ul class="sub">
                    <li><a href="{{route('admin.article.index')}}">Article Management</a></li>
                    <li><a href="{{route('admin.article-cat.index')}}">Article Category Management</a></li>
                </ul>
            </li>

            {{-- <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-camera-retro"></i>
                    <span>Image</span>
                </a>
                <ul class="sub">
                    <li><a href="typography.html">Image Management</a></li>
                    <li><a href="glyphicon.html">Image Category Management</a></li>
                </ul>
            </li>    --}}
            
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-gift"></i>
                    <span>Product</span>
                </a>
                <ul class="sub">
                    <li><a href="{{route('admin.product.index')}}">Product Management</a></li>
                    <li><a href="{{route('admin.product-cat.index')}}">Product Category Management</a></li>
                </ul>
            </li>    

            <li>
                <a href="fontawesome.html">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Order</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span>Mail </span>
                </a>
                <ul class="sub">
                    <li><a href="mail.html">Inbox</a></li>
                    <li><a href="mail_compose.html">Compose Mail</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-user"></i>
                    <span>User </span>
                </a>
                <ul class="sub">
                    <li><a href="{{route('admin.user.list-admin')}}">Admin Management</a></li>
                    <li><a href="{{route('admin.user.list-customer')}}">Customer Management</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class=" fa fa-th-list"></i>
                    <span>Menu</span>
                </a>
            </li>
        </ul>            
    </div>
    <!-- sidebar menu end-->
</div>
</aside>