
<nav class="navbar top-navbar">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <a href="index.html">
                    <img src="{{asset('img/small.png')}}" alt="{{env('APP_NAME')}}" class="img-fluid logo" style="width:50px;">
                </a>
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                        <span class="badge badge-success ml-0 mr-0">Versão 1.0</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-right">
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-power"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="progress-container"><div class="progress-bar" id="myBar"></div></div>
</nav>
