<header class="app-header">
    <div class="top-bar">
        <div class="top-bar-brand">
            <a href="{{ route("home") }}">
                Bulk SMS v 2.1
            </a>
        </div>
        <div class="top-bar-list">
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                <button class="hamburger hamburger-squeeze"
                        type="button"
                        data-toggle="aside"
                        aria-label="Menu"
                        aria-controls="navigation"
                >
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>

            <div class="top-bar-item top-bar-item-full"></div>

            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
                <ul class="header-nav nav">
                    <li class="nav-item dropdown header-nav-dropdown has-notified">
                        <a class="nav-link"
                           href="#"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false"
                        >
                            <span class="oi oi-envelope-open"></span>
                        </a>
                        <div class="dropdown-arrow"></div>
                        <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
                            <h6 class="dropdown-header stop-propagation">
                                <span>Messages</span>
                                <a href="#">Mark all as read</a>
                            </h6>
                            <div class="dropdown-scroll has-scrollable">
                                 @foreach(\App\Incoming::latest()->take(5)->get() as $sms)
                                <a href="#" class="dropdown-item unread">
                                    <div class="user-avatar">
                                        <img src="{{ asset("themes/looper/assets/images/avatars/team1.jpg") }}" alt="">
                                    </div>
                                    <div class="dropdown-item-body">
                                        <p class="subject">{{$sms->sender }} </p>
                                        <p class="text text-truncate"> {{$sms->text}} </p>
                                        <span class="date">{{ $sms->created_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                                @endforeach
                               
                               
                            </div>
                            <a href="{{url("incomings")}} " class="dropdown-footer">All messages
                                <i class="fa fa-fw fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown header-nav-dropdown">
                        <a class="nav-link"
                           href="#"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false"
                        >
                            <i class="fas fa-cog"></i>
                        </a>
                        <div class="dropdown-arrow"></div>
                        <div class="dropdown-menu">
                          

                            <div class="dropdown-divider"></div>

                            @can("view", \App\User::class)
                            <a href="{{ route("users.index") }}" class="dropdown-item ">
                                <i class="fas fa-users"></i> Users
                            </a>
                            @endcan

                            @can("view", \App\Role::class)
                            <a href="{{ route("roles.index") }}" class="dropdown-item ">
                                <i class="fas fa-user-lock"></i> Roles
                            </a>
                            @endcan
                        </div>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn-account d-none d-md-flex"
                            type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                    >
                        <span class="user-avatar">
                            <img src="{{ Avatar::create(auth()->user()->full_name)->toBase64() }}" />
                        </span>
                        <span class="account-summary pr-lg-4 d-none d-lg-block">
                            <span class="account-name">{{ auth()->user()->full_name }}</span>
                            <span class="account-description">
                                {{ auth()->user()->role() }}
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-arrow dropdown-arrow-left"></div>
                    <div class="dropdown-menu">
                        <h6 class="dropdown-header d-none d-md-block d-lg-none">
                            {{ auth()->user()->full_name }}
                        </h6>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user text-muted mr-2"></i> Profile
                        </a>


                        <a href="{{ route("changepassword.index") }}" class="dropdown-item ">
                                <i class="fas fa-lock-open text-muted mr-2"></i> Change Password
                            </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        >
                            <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                            {{ __('Logout') }}
                            <form id="logout-form"
                                  action="{{ route('logout') }}"
                                  method="POST"
                                  class="d-none"
                            >
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>