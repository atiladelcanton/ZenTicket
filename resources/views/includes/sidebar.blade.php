<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{url('/')}}" class="logo"><img src="{{asset('img/sigais_logo_azul.png')}}" alt="{{env('APP_NAME')}}" style="width: 89px;"></a>
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
                    <li><a href="page-profile.html"><i class="icon-user"></i>Perfil</a></li>
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
                    @shield($module->slug.'.index')
                    <li class="{{explode('/',url()->current())[3] == $module->slug ? 'active' : '' }}"><a href="{{ route($module->slug) }}"><i class="{{$module->icon}}"></i><span>{{$module->name}}</span></a></li>
                    @endshield
                @endforeach
            </ul>
        </nav>
    </div>
</div>