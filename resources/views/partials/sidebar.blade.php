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
            <a href="{{ url('/') }}" class="sidebar-brand1">
                <img src="{{ url('images/logo.png') }}" class="img-responsive center" width="100" alt="Logo">
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                    <a href="{{ url('/') }}">
                        <img src="{{ url('images/avatar.jpg') }}" alt="avatar">
                    </a>
                </div>
                <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                <div class="sidebar-user-links">
                    <!--
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a> -->
                    <a href="{{ route('perfil.index') }}" data-toggle="tooltip" data-placement="bottom" title="Perfil"><i class="gi gi-user"></i></a>
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Settings"><i class="gi gi-cogwheel"></i></a>
                    <a href="{{ url('/logout') }}" data-toggle="tooltip" data-placement="bottom" title="Salir"><i class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- END User Info -->

            <?php
                $cont = 0;
                $id_module = 0;
                $user = Auth::user();
                $opciones_perfil = DB::table('types_profile')
                    ->where('id_type', '=', $user->type)
                    ->join('submodules', 'types_profile.id_module', '=', 'submodules.id')
                    ->join('modules', 'modules.id', '=', 'submodules.modules_id')
                    ->select('modules.description as mdescription','icon','modules.id','submodules.description as sdescription','submodules.url as surl')
                    ->orderBy('modules.order','asc')
                    ->orderBy('submodules.order','asc')
                    ->get();
                    //dd($opciones_perfil);
            ?>

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav" id="side-menu">
                <li>
                    <a href="{{ url('/') }}" class="btn-icon {{ Request::is('/') ? 'active' : ''  }}">
                        <span class="sp-icon fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <span class="text-primary"><i class="glyphicon glyphicon-home fa-stack-1x"></i></span>
                        </span>
                        <span class="sp-text top30">Inicio</span>
                    </a>
                </li>
                @foreach ($opciones_perfil as $opcion_perfil)

                    @if ($opcion_perfil->id != $id_module)
                        <?php $id_module = $opcion_perfil->id; ?>
                        @if ($cont > 0)
                            </ul><!-- /.nav-second-level -->
                            </li>
                        @endif
                        <?php $cont++; ?>
                        <li>
                        <a href="#" class="sidebar-nav-menu btn-icon">
                           <span class="sp-icon fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <span class="text-primary">
                                    <i class="{{ $opcion_perfil->icon }} fa-stack-1x"></i>
                                </span>
                            </span>
                            <span class="sp-text {{ strlen(strip_tags($opcion_perfil->mdescription)) > 26 ? "top15" : "top30" }}" >{{ $opcion_perfil->mdescription }}</span>
                            <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        </a>
                        <!-- .nav-second-level -->
                        <ul>
                            <li>
                                <a href="{{ url($opcion_perfil->surl) }}">
                                    {{ $opcion_perfil->sdescription}}
                                </a>
                            </li>
                    @else
                        <li>
                            <a href="{{ url($opcion_perfil->surl) }}">
                                {{ $opcion_perfil->sdescription }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <!-- END Sidebar Navigation -->

        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->