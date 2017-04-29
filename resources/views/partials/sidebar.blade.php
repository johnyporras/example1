<!-- Alternative Sidebar -->
<div id="sidebar-alt">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-alt-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Sidebar Section -->
            <a href="index.html" class="sidebar-title">
                <i class="gi gi-cogwheel pull-right"></i> <strong>Header</strong>
            </a>
            <div class="sidebar-section">Section content..</div>
            <!-- END Sidebar Section -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Alternative Sidebar -->

<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="index.html" class="sidebar-brand1">
                <img src="{{ url('images/logo.png') }}" class="img-responsive center" width="100" alt="Logo">
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                    <a href="index.html">
                        <img src="{{ url('img/placeholders/avatars/avatar.jpg') }}" alt="avatar">
                    </a>
                </div>
                <div class="sidebar-user-name">John Doe</div>
                <div class="sidebar-user-links">
                    <!--   
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a> -->
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Settings"><i class="gi gi-cogwheel"></i></a>
                    <a href="{{ url('/logout') }}" data-toggle="tooltip" data-placement="bottom" title="Salir"><i class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- END User Info -->

            @if (Auth::check())
               <p>menu mostrar</p>
            @endif

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="#" class="btn-icon active">
                        <span class="sp-icon fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <span class="text-primary"><i class="fa fa-lock fa-stack-1x"></i></span>
                        </span>
                        <span class="sp-text">Funerario signo</span>
                    </a>
                </li>
                              
                <li>
                    <a href="#" class="sidebar-nav-menu btn-icon">
                       <span class="sp-icon fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <span class="text-primary"><i class="fa fa-lock fa-stack-1x"></i></span>
                        </span>
                        <span class="sp-text">Funerario</span>
                        <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">Link #1</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Link #2</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END Sidebar Navigation -->

        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->