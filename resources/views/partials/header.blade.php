<header class="navbar navbar-default">
    <!-- Left Header Navigation -->
    <ul class="nav navbar-nav-custom">
        <!-- Main Sidebar Toggle Button -->
        <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                <i class="fa fa-bars fa-fw"></i>
            </a>
        </li>
        <!-- END Main Sidebar Toggle Button -->

        <!-- Template Options -->
        <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
        
      <!--  <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <i class="gi gi-settings"></i>
            </a>
            <ul class="dropdown-menu dropdown-custom dropdown-options">
                <li class="dropdown-header text-center">Header Style</li>
                <li>
                    <div class="btn-group btn-group-justified btn-group-sm">
                        <a href="javascript:void(0)" class="btn btn-primary" id="options-header-default">Light</a>
                        <a href="javascript:void(0)" class="btn btn-primary" id="options-header-inverse">Dark</a>
                    </div>
                </li>
                <li class="dropdown-header text-center">Page Style</li>
                <li>
                    <div class="btn-group btn-group-justified btn-group-sm">
                        <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style">Default</a>
                        <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style-alt">Alternative</a>
                    </div>
                </li>
            </ul>
        </li> -->
        <!-- END Template Options -->

    </ul>
    <!-- END Left Header Navigation -->

    <!-- Right Header Navigation -->
    <ul class="nav navbar-nav-custom pull-right">
        <!-- Alternative Sidebar Toggle Button -->
        @if (! Request::is('/') )
        <li>
            <div id="clock" class="mt15 mr20">
                <span class="mr5 text-primary"><i class="fa fa-calendar"></i></span>
                <span class="clock-date"></span>
                <span class="mr5 ml5 text-primary"><i class="fa fa-clock-o"></i></span>
                <span class="clock-hours"></span> :
                <span class="clock-minutes"></span> :
                <span class="clock-seconds"></span> 
                <span class="clock-ampm"></span>
            </div>
        </li>
        @endif
    </ul>
    <!-- END Right Header Navigation -->
</header>