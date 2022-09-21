<div id="left-sidebar" class="sidebar mini_sidebar_on">
    <div class="navbar-brand">
        <a href="{{url('/')}}" class="logo"><img src="https://via.placeholder.com/150

C/O https://placeholder.com/" alt="{{env('APP_NAME')}}" style="width: 40px;">
        <span style="font-weight: bold; font-size: 21px;"><span style="color:#008ED0; font-size: 21px;">Zen</span>Ticket</span>
        </a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div" style="width: 40px;">

            </div>
            <div class="dropdown">
                <span>Olá,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{auth()->user()->name}}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="{{route('usuarios.profile')}}"><i class="icon-user"></i>Perfil</a></li>
                    <li class="divider"></li>
                    <li>
                        <a  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-power"></i>Sair</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">

                <li class=" {{explode('/',url()->current())[3] == 'home' ? 'active' : '' }}"><a href="{{url('/')}}"><i class="icon-speedometer"></i><span>Principal</span></a></li>
                @foreach($modules  as $module)

                    @if(count($module->parents) > 0)
                        @if($module->slug === 'configuracoes')
                            @is('Administrador')
                                <li class=" {{explode('/',url()->current())[3] == $module->slug ? 'active' : '' }}">
                                    <a href="{{ $module->slug === 'configuracoes' ? '#':route($module->slug) }}" class="has-arrow">
                                        <i class="{{$module->icon}}"></i><span>{{$module->name}}</span>
                                    </a>

                                    <ul>

                                        @foreach($module->parents as $parent)
                                            @shield($parent->slug.'.index')
                                                <li class="{{explode('/',url()->current())[3] == $parent->slug ? 'active' : '' }}">
                                                    <a href="{{ route($parent->slug) }}"><span>{{$parent->name}}</span></a>
                                                </li>
                                            @endshield
                                        @endforeach
                                    </ul>
                                </li>
                            @endis
                        @endif
                    @else
                        @shield($module->slug.'.index')
                            <li class="{{explode('/',url()->current())[3] == $module->slug ? 'active' : '' }}"><a href="{{ route($module->slug) }}"><i class="{{$module->icon}}"></i><span>{{$module->name}}</span></a></li>
                        @endshield
                    @endif
                @endforeach
            </ul>
        </nav>

    </div>
</div>
