<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url({{asset('org/assets/')}}/images/background/user-info.jpg) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"><img src="{{asset('org/assets/')}}/images/users/profile.png" alt="user"/></div>
            <!-- User profile text-->
            <div class="profile-text"><a href="#" class=" u-dropdown">{{auth('admin')->user()->username}}</a>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav active">
            <ul id="sidebarnav" class="in">
                @if(auth('admin')->user()->hasAnyPermission(['Admin-category', 'Admin-good']))
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">商城系统 </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        {{--登录用户有 Admin-category 权限或者是 category 角色都可以访问--}}
                        @if(auth('admin')->user()->hasPermissionTo('Admin-category') || auth('admin')->user()->hasRole('category'))
                            <li><a href="{{route('admin.category.index')}}">栏目管理</a></li>
                        @endif
                        @if(auth('admin')->user()->hasPermissionTo('Admin-good') || auth('admin')->user()->hasRole('good'))
                            <li><a href="{{route('admin.good.index')}}">商品管理</a></li>
                        @endif
                        <li><a href="{{route('admin.order.index')}}">订单管理</a></li>
                    </ul>
                </li>
                @endif
                @if(auth('admin')->user()->hasAnyPermission(['Admin-config-website', 'Admin-config-upload','Admin-config-email','Admin-config-search']))
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-settings"></i>
                        <span class="hide-menu">配置管理</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        @if(auth('admin')->user()->hasPermissionTo('Admin-config-website'))
                            <li><a href="{{route('admin.config.edit',['type'=>'website'])}}">站点配置</a></li>
                        @endif
                        @if(auth('admin')->user()->hasPermissionTo('Admin-config-upload'))
                            <li><a href="{{route('admin.config.edit',['type'=>'upload'])}}">上传配置</a></li>
                        @endif
                        @if(auth('admin')->user()->hasPermissionTo('Admin-config-email'))
                            <li><a href="{{route('admin.config.edit',['type'=>'email'])}}">邮件配置</a></li>
                        @endif
                        @if(auth('admin')->user()->hasPermissionTo('Admin-config-search'))
                            <li><a href="{{route('admin.config.edit',['type'=>'search'])}}">搜索配置</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(auth('admin')->user()->hasAnyPermission(['Admin-admin', 'Admin-role','Admin-permission']))
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-user-o"></i>
                        <span class="hide-menu">权限管理</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        @if(auth('admin')->user()->hasPermissionTo('Admin-admin'))
                            <li><a href="{{route('admin.admin.index')}}">管理员管理</a></li>
                        @endif
                        @if(auth('admin')->user()->hasPermissionTo('Admin-role'))
                            <li><a href="{{route('admin.role.index')}}">角色管理</a></li>
                        @endif
                        @if(auth('admin')->user()->hasPermissionTo('Admin-permission'))
                            <li><a href="{{route('admin.permission')}}">权限管理</a></li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <!-- End Bottom points-->
</aside>
