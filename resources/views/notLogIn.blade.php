<x-headerIn />
<x-navbarIn />

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .cover-container {
        margin-top: 12%;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    ol {
        list-style: none;
    }
</style>
<div class="cover-container d-flex  p-3 mx-auto flex-column text-center">


    <main class="px-3">
        <h1 class="text-danger">
            {{-- <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> --}}
           حسابك مغلق حاليا

        </h1>
        <p class="lead">
            تم اغلاق حسابك, لمعرفة السبب تواصل مع الشركة
        </p>
        <p class="lead">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                {{ __('الصفحة الرئيسية') }}
            </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </p>
    </main>

    <footer class="mt-auto text-dark-50">
        <p>
            للتواصل
        </p>
        <ol>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                &nbsp;
                رقم الهاتف:
                <span>+9972558564</span>

            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                <span>labmedical061@gmail.com</span>
                :البريد الالكتروني
            </li>
        </ol>
    </footer>
</div>



<x-endIn />
