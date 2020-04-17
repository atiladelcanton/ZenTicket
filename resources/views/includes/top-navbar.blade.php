
<nav class="navbar top-navbar">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <a href="index.html">
                    <img src="{{asset('img/logo.png')}}" alt="{{env('APP_NAME')}}" class="img-fluid logo" style="width:50px;">
                </a>
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                        <i class="icon-bell"></i>
                        <span class="notification-dot bg-azura">4</span>
                    </a>
                    <ul class="dropdown-menu feeds_widget vivify fadeIn">
                        <li class="header blue">Notificações</li>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="feeds-left bg-red"><i class="fa fa-check"></i></div>
                                <div class="feeds-body">
                                    <h4 class="title text-danger">Issue Fixed <small class="float-right text-muted">9:10 AM</small></h4>
                                    <small>WE have fix all Design bug with Responsive</small>
                                </div>
                            </a>
                        </li>
                    </ul>
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