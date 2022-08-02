@props(['notifications'])
<style>
    body {
        font-family: "Roboto", sans-serif;
        background: white;
        min-height: 100vh;
        position: relative;
    }

    .notification-ui a:after {
        display: none;
    }

    .notification-ui_icon {
        position: relative;
    }

    .notification-ui_icon .unread-notification {
        display: inline-block;
        height: 7px;
        width: 7px;
        border-radius: 7px;
        background-color: #66BB6A;
        position: absolute;
        top: 7px;
        left: 12px;
    }

    @media (min-width: 900px) {
        .notification-ui_icon .unread-notification {
            left: 20px;
        }
    }

    .notification-ui_dd {
        padding: 0;
        border-radius: 10px;
        -webkit-box-shadow: 0 5px 20px -3px rgba(0, 0, 0, 0.16);
        box-shadow: 0 5px 20px -3px rgba(0, 0, 0, 0.16);
        border: 0;
        max-width: 400px;
    }

    @media (min-width: 900px) {
        .notification-ui_dd {
            min-width: 400px;
            position: absolute;
            left: -192px;
            top: 70px;
        }
    }

    .notification-ui_dd:after {
        content: "";
        position: absolute;
        top: -30px;
        left: calc(50% - 7px);
        border-top: 15px solid transparent;
        border-right: 15px solid transparent;
        border-bottom: 15px solid #fff;
        border-left: 15px solid transparent;
    }

    .notification-ui_dd .notification-ui_dd-header {
        border-bottom: 1px solid #ddd;
        padding: 15px;
    }

    .notification-ui_dd .notification-ui_dd-header h3 {
        margin-bottom: 0;
    }

    .notification-ui_dd .notification-ui_dd-content {
        max-height: 500px;
        overflow: auto;


    }

    .notification-list {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 20px 30px;
        margin: 0 0;
        border-bottom: 1px solid #ddd;
    }

    .notification-list--unread {
        position: relative;
    }

    .notification-list--unread:before {
        content: "";
        position: absolute;
        top: 0;
        left: -25px;
        height: calc(100% + 1px);
        border-left: 2px solid #29B6F6;
    }

    .notification-list .notification-list_img img {
        height: 48px;
        width: 48px;
        border-radius: 50px;
        margin-right: 20px;
    }

    .notification-list .notification-list_detail p {
        margin-bottom: 5px;
        line-height: 1.2;
    }

    .notification-list .notification-list_feature-img img {
        height: 48px;
        width: 48px;
        border-radius: 5px;
        margin-left: 20px;
    }

    .read {
        color: black;
        background: #e6e9ed3f;
    }

    .notRead {
        background: rgb(225, 255, 225);
    }

</style>
<header class="navbar navbar-light sticky-top d-flex bg-light flex-md-nowrap shadow p-2">
    <a class="col-md-2 col-lg-1 me-0 px-3 mx-4 text-center text-light h5" href="/adminPanel"><img
            src="{{ asset('images/MedicalLab.png') }}" alt="Medical Lab" width="60"> </a>

    <button class="navbar-toggler position-absolute d-md-none collapsed m-3" data-bs-toggle="collapse"
        href="#sideBarMenu" role="button" aria-expanded="false" aria-controls="collapseExample">
        <span class="navbar-toggler-icon"></span>
    </button>

    {{-- <li class="nav-item h4">
            <a href="/adminPanel" class="nav-link text-white">كل البيانات</a>
        </li> --}}
    <form class="d-flex" action="/adminPanel" method="get">
        @csrf

        {{ method_field('PUT') }}
        <select class="mx-2" id="valid" name="valid" value="{{ old('valid') }}">

            <option value="all">الكل</option>

            <option value="valid">فعال</option>

            <option value="unvalid">غير فعال</option>

        </select>
        <input class="form-control text-right border mx-2" type="search" name="search" placeholder="ابحث"
            aria-label="Search">
        <button class="btn btn-primary" type="submit">ابحث</button>
    </form>
    <div class="ml-auto nav-item dropdown notification-ui">
        <a class="nav-link dropdown-toggle notification-ui_icon" href="#" id="navbarDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell"><svg xmlns="http://www.w3.org/2000/svg" width="30" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg></i>
            @if (auth()->user()->unreadNotifications->count() > 0)

                <span class="badge badge-danger"> {{ auth()->user()->unreadNotifications->count() }} </span>
            @endif
            {{-- <spa class="unread-notification"></spa
        n> --}}
        </a>
        <div class="dropdown-menu notification-ui_dd" aria-labelledby="navbarDropdown">
            <div class="notification-ui_dd-header">
                <h3 class="text-center">الطلبات الجديدة</h3>
            </div>
            <div class="notification-ui_dd-content">
                @foreach ($notifications as $notification)
                    {{-- <div class=""> --}}
                    <a href="/labAccept/{{ $notification->data['id'] }}/{{ $notification->id }}"
                        class="notification-list notification-list--unread @if ($notification->read_at != null) read @else notRead @endif">
                        <div class="notification-list_detail">
                            <p><b>{{ $notification->data['id'] }}</b> {{ $notification->data['name'] }}</p>
                            <p><small>{{ $notification->created_at->diffForHumans() }}</small></p>
                        </div>
                        <div class="notification-list_feature-img">
                            <img src="{{ url('/doc/' . $notification->data['document']) }}"
                                alt="{{ $notification->data['document'] }}">
                        </div>
                    </a>
                    {{-- </div> --}}
                @endforeach

            </div>
            {{-- <div class="notification-ui_dd-footer">
        <a href="#!" class="btn btn-success btn-block">View All</a>
      </div> --}}
        </div>
    </div>
    <div class="dropdown d-none d-md-block mx-5">

        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-expanded="false">
            {{ Auth::user()->email }}
        </button>
        <div class="dropdown-menu sidebarMenu" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-item">
                <a class="nav-link" href="{{ route('change') }}">
                    {{ __('تغيير كلمة السر') }}
                </a>


            </div>
            <div class="dropdown-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
                    {{ __('تسجيل الخروج') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>
    </div>


</header>

{{-- <nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand">لوحة التحكم الرئيسية</a>
        <li class="nav-item h4">
            <a href="/adminPanel" class="nav-link text-white">كل البيانات</a>
        </li>
        <form class="d-flex" action="/adminPanel" method="get">
            @csrf

            {{ method_field('PUT') }}
            <select class="mx-2" id="valid" name="valid" value="{{ old('valid') }}">

                <option value="all">الكل</option>

                <option value="valid">فعال</option>

                <option value="unvalid">غير فعال</option>

            </select>
            <input class="form-control me-2 text-right" type="search" name="search" placeholder="ابحث"
                aria-label="Search">
            <button class="btn btn-primary" type="submit">ابحث</button>
        </form>
        <div class="navbar-nav">
            <a class="dropdown-item bg-dark text-white" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                                                                             document.getElementById('logout-form').submit();">
                {{ __('تسجيل الخروج') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav> --}}
