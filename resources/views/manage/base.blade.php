<!-- BEGIN BASE-->
<div id="base">

    <!-- BEGIN OFFCANVAS LEFT -->
    <div class="offcanvas">
    </div><!--end .offcanvas-->
    <!-- END OFFCANVAS LEFT -->

    <!-- BEGIN CONTENT-->
    <div id="content">

        {{--{% if messages %}--}}
        {{--{% for message in messages %}--}}
        {{--<div {% if message.tags %} class="alert {{ message.tags }} text-center"{% endif %}>--}}
            {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
            {{--{{ message }}--}}
        {{--</div>--}}
        {{--{% endfor %}--}}
        {{--{% endif %}--}}

        @yield('content')


    </div><!--end #content-->
    <!-- END CONTENT -->

    <!-- BEGIN MENUBAR-->
    <div id="menubar" class="menubar-inverse ">
        <div class="menubar-fixed-panel">
            <div>
                <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="expanded">
                <a href="#">
                {{--<a href="{% url 'home' %}">--}}
                    <span class="text-lg text-bold text-primary ">MATERIAL&nbsp;ADMIN</span>
                </a>
            </div>
        </div>
        <div class="menubar-scroll-panel">

            <!-- BEGIN MAIN MENU -->
            <ul id="main-menu" class="gui-controls">

                <!-- BEGIN DASHBOARD -->
                <li>
                    <a href="{{ route('manage.index') }}" class="active">
                        {{--<a href="{% url 'home' %}" class="active">--}}
                        <div class="gui-icon"><i class="fa fa-home"></i></div>
                        <span class="title">儀表板</span>
                    </a>
                </li><!--end /menu-li -->
                <!-- END DASHBOARD -->

                <!-- BEGIN ORDER -->
                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-shopping-cart"></i></div>
                        <span class="title">訂單</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a href="{{ route('manage.index') }}" ><span class="title">所有訂單</span></a></li>
                        <li><a href="#" ><span class="title">新增訂單</span></a></li>
                    </ul><!--end /submenu -->
                </li><!--end /menu-li -->
                <!-- END ORDER -->

                <!-- BEGIN PRODUCT -->
                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-cubes"></i></div>
                        <span class="title">商品</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a href="{{ route('manage.products') }}" ><span class="title">所有商品</span></a></li>
                        <li><a href="{{ route('manage.addProduct') }}" ><span class="title">新增商品</span></a></li>
                    </ul><!--end /submenu -->
                </li><!--end /menu-li -->
                <!-- END PRODUCT -->

                <!-- BEGIN SPOT -->
                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-cubes"></i></div>
                        <span class="title">取貨地點</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a href="{{ route('manage.spots') }}" ><span class="title">所有地點</span></a></li>
                        <li><a href="{{ route('manage.addSpot') }}" ><span class="title">新增地點</span></a></li>
                    </ul><!--end /submenu -->
                </li><!--end /menu-li -->
                <!-- END SPOT -->

                <!-- BEGIN HOLIDAY -->
                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-user"></i></div>
                        <span class="title">休息日</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        <li><a href="{{ route('manage.holidays') }}" ><span class="title">日期管理</span></a></li>
                    </ul><!--end /submenu -->
                </li><!--end /menu-li -->
                <!-- END HOLIDAY -->

                <!-- BEGIN PROFILE -->
                <li class="gui-folder">
                    <a>
                        <div class="gui-icon"><i class="fa fa-user"></i></div>
                        <span class="title">管理中心</span>
                    </a>
                    <!--start submenu -->
                    <ul>
                        {{--<li><a href="{% url 'change_password' %}" ><span class="title">Change Password</span></a></li>--}}
                        {{--<li><a href="{% url 'logout' %}" ><span class="title">Logout</span></a></li>--}}
                        <li><a href="{{ route('manage.bulletin') }}"><span class="title">公告設定</span></a></li>
                        <li><a href="{{ route('user.logout') }}" ><span class="title">登出</span></a></li>
                    </ul><!--end /submenu -->
                </li><!--end /menu-li -->
                <!-- END PROFILE -->

            </ul><!--end .main-menu -->
            <!-- END MAIN MENU -->

            <div class="menubar-foot-panel">
                <small class="no-linebreak hidden-folded">
                    <span class="opacity-75">版權所有 &copy; </span> <strong>Chun-Kai Kao （高俊凱）</strong>
                    <br>
                    <span class="opacity-75">聯絡方式： </span> <strong>cg.workst@gmail.com</strong>
                </small>
            </div>
        </div><!--end .menubar-scroll-panel-->
    </div><!--end #menubar-->
    <!-- END MENUBAR -->

</div><!--end #base-->
<!-- END BASE -->