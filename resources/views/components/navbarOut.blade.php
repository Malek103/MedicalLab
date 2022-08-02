 <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul class="txt-r">
            @if(Route::currentRouteName() == 'main')
          <li><a class="nav-link scrollto" href="#contact">تواصل معنا</a></li>
          <li><a class="nav-link scrollto" href="#doctors">فريق العمل</a></li>
          <li><a class="nav-link scrollto" href="#departments">المستخدمين</a></li>

          <li><a class="nav-link scrollto" href="#services">خدماتنا</a></li>

          <li><a class="nav-link scrollto @if(Route::is('/')) active @endif" href="#hero">تعرف علينا</a></li>
          @endif
          @if (Route::has('login'))
            @guest
              <li class="nav-link scrolto "><a href="{{ route('login') }}" class="nav-link @if(Route::is('/login')) active @endif">تسجيل دخول</a></li>

            @endguest
            @auth
            <li class="nav-link scrolto ">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                                                                     document.getElementById('logout-form').submit();">
                    {{ __('تسجيل الخروج') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            @endauth
          @endif
          {{-- <li><a class="nav-link scrollto" href="#doctors">Doctors</a></li> --}}
          {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle mx-4"></i>
      </nav><!-- .navbar -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->


      @guest
          <a href="{{ route('register') }}" class="appointment-btn scrollto"><span class="d-md-inline"> انشأ حساب </span>الأن </a>
      @endguest
      <h1 class="logo ms-auto"><a href="/">برنامج المختبرات</a></h1>

    </div>
  </header><!-- End Header -->
