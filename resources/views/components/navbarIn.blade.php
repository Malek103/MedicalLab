<header class="navbar navbar-light sticky-top d-flex bg-light flex-md-nowrap shadow p-2">
    <a class="col-md-2 col-lg-1 me-0 px-3 mx-4 text-center text-light h5" href="/"><img
            src="{{ asset('images/MedicalLab.png') }}" alt="Medical Lab" width="60"> </a>

    <button class="navbar-toggler position-absolute d-md-none collapsed m-3" data-bs-toggle="collapse"
        href="#sideBarMenu" role="button" aria-expanded="false" aria-controls="collapseExample">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="dropdown d-none d-md-block mx-5">
        @auth
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-expanded="false">
            {{ Auth::user()->email }}
        </button>
        @endauth
        <div class="dropdown-menu sidebarMenu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
                {{ __('تسجيل الخروج') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>


</header>
