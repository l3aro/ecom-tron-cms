<aside>
<div id="sidebar" class="nav-collapse">
    <!-- sidebar menu start-->
    <div class="leftside-navigation">
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="{{route('admin.dashboard')}}" id="menu-dashboard">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="sub-menu">
                <a href="javascript:;" id="menu-article">
                    <i class="fa fa-rss"></i>
                    <span>Article</span>
                </a>
                <ul class="sub">
                    <li><a href="{{route('admin.article.index')}}">Article Management</a></li>
                    <li><a href="{{route('admin.article-cat.index')}}">Article Category Management</a></li>
                </ul>
            </li>

            {{-- <li class="sub-menu">
                <a href="javascript:;" id="menu-image">
                    <i class="fa fa-camera-retro"></i>
                    <span>Image</span>
                </a>
                <ul class="sub">
                    <li><a href="typography.html">Image Management</a></li>
                    <li><a href="glyphicon.html">Image Category Management</a></li>
                </ul>
            </li>    --}}
            
            <li class="sub-menu">
                <a href="javascript:;" id="menu-product">
                    <i class="fa fa-gift"></i>
                    <span>Product</span>
                </a>
                <ul class="sub">
                    <li><a href="{{route('admin.product.index')}}">Product Management</a></li>
                    <li><a href="{{route('admin.product-cat.index')}}">Product Category Management</a></li>
                </ul>
            </li>    

            <li class="sub-menu">
                <a href="javascript:;" id="menu-order">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Order</span>
                </a>
                <ul class="sub">
                    <li><a href="{{route('admin.order.index')}}?status=unhandle">Unhandle Order</a></li>
                    <li><a href="{{route('admin.order.index')}}?status=proceed">Proceeding Order</a></li>
                    <li><a href="{{route('admin.order.index')}}?status=success">Successful Order</a></li>
                    <li><a href="{{route('admin.order.index')}}?status=error">Error Order</a></li>
                </ul>
            </li>
            <!-- <li class="sub-menu">
                <a href="javascript:;" id="menu-mail">
                    <i class="fa fa-envelope"></i>
                    <span>Mail </span>
                </a>
                <ul class="sub">
                    <li><a href="mail.html">Inbox</a></li>
                    <li><a href="mail_compose.html">Compose Mail</a></li>
                </ul>
            </li> -->
            <li class="sub-menu">
                <a href="javascript:;" id="menu-user">
                    <i class="fa fa-user"></i>
                    <span>User </span>
                </a>
                <ul class="sub">
                    <li><a href="{{route('admin.user.list-admin')}}">Admin Management</a></li>
                    <li><a href="{{route('admin.user.list-customer')}}">Customer Management</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{route('admin.menu-cat.index')}}" id="menu-menu">
                    <i class=" fa fa-th-list"></i>
                    <span>Menu</span>
                </a>
            </li>
            <li>
                <a href="/" target="_blank">
                    <i class="fa fa-eye"></i>
                    <span>Main Site</span>
                </a>
            </li>
        </ul>            
    </div>
    <!-- sidebar menu end-->
</div>
</aside>