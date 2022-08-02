<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Medical Lab</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    .bold {
      font-weight: bold;
    }

    .col-6 {
      border: 1px solid gray;
      padding: 4px;
    }

    page[size="A4"] {
      background: white;
      width: 21cm;
      height: 29.7cm;
      display: block;
      margin: 0 auto;
      margin-top: 0.5cm;
      margin-bottom: 0.5cm;
      box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
      /* border: 1.25cm solid #000; */
      padding: 1.2rem;
    }

    @media print {

      body,
      page[size="A4"] {
        margin: 0;
        box-shadow: 0;
        width: 100%;
        height: auto;
      }

      * {

        font-size: 1.2rem;
      }
      .print-hide{
          display: none;
      }
    }

    .down {

      margin-top: 1rem;
      text-align: right;
    }

    #details {
      border-bottom: 1px solid #eee;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

  </style>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap');

    * {
      font-family: 'Almarai',
        sans-serif;
    }

  </style>

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<!--
<body>
    {{-- navBar In --}}
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="col-md-2 col-lg-1 me-0 px-3 text-center text-light h5" href="/">برنامج المختبر </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
                                        @if (Auth::user()->status == 1){
                                            <input class="form-control form-control-dark w-100 text-center" type="text" placeholder="بحث"
                                                aria-label="Search">

                                        @endif
        @endauth


    </header>

    <div class="container-fluid">
        <div class="row">
            {{-- Side Bar In --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column p-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/patient/dash">
                                <span data-feather="home"></span>
                                لوحة التحكم
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/patient/dash">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                عرض الفحوصات الطبية
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="navbar-nav d-flex text-center h5 px-0">
                                {{-- <a class="nav-link px-3" href="#">{{ Auth::user()->UserName }}</a> --}}
                                <a class="nav-link bg-dark text-light px-0" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                    {{ __('تسجيل الخروج') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                {{-- Top Bar IN --}}

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">شارك</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">صدر</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            هذا الاسبوع </button>
                    </div>
                </div>
                <div class="table-responsive">
                    {{-- Content --}}


                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    {{-- here is the content --}}
                                    <div class="container ">
                                        <div class="justify-content-md-center">
                                            <div class="container text-center">
                                                @if (Session::has('message'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ Session::get('message') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-12 row">
                                                    <div class="col-6">
                                                        <span class="float-left">اسم المريض:</span>
                                                        &nbsp;
                                                        {{ $patient->PName }}
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="float-left">الطبيب المعالج:</span>
                                                        &nbsp;
                                                        {{ $examinations->Doctor }}
                                                    </div>
                                                </div>
                                                <div class="col-12 row">
                                                    <div class="col-6">
                                                        <span class="float-left">اسم الفحص:</span>
                                                        &nbsp;
                                                        {{ $examinations->MEname }}
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="float-left">سعر الفحص:</span>
                                                        &nbsp;
                                                        {{ $examinations->Price }}
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="float-left">اسم الفني:</span>
                                                        &nbsp;
                                                        {{ $tech->TName }}
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="float-left">قسم المختبر:</span>
                                                        &nbsp;
                                                        {{ $examinations->Lab_Dep }}
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    @foreach ($name as $key => $item)

                                                        <div class="col-md-6 row mt-2 text-right">

                                                            <div class="col-md-4 text-right"> <label
                                                                    class="control-label text-right">{{ $name[$key] }}</label>
                                                            </div>

                                                            <div class="col-md-8">
                                                                <div class="col-md-4 text-right"> <label
                                                                        class="control-label text-left">{{ $res[$key] }}</label>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            <div class="mt-5 mr-5 py-3">
                                                <a href="/patient/dash"
                                                    class="btn btn-outline-dark w-25 mx-2">الرجوع</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
-->

<body>
  <page size="A4">
    <header>
      <div class="text-center">
        <img width="120" src="{{ asset('images/MedicalLab.png') }} ">
      </div>
      {{-- <div id="company">
      <div>455 Foggy Heights, AZ 85004, US</div>
      <div>(602) 519-0450</div>
      <div><a href="mailto:company@example.com">company@example.com</a></div>
    </div> --}}
      </div>
    </header>
    <main>
      <div id="details" class="text-right">
        <div class="row mx-5 mt-4 mb-2">
          <div class="col">
            <div id="client">
              <div class="h2">معلومات المريض</div>
              <div>
                <div class="float-right h6">
                  &nbsp;&nbsp;
                  :اسم المريض
                </div>
                <div class="h6">
                  {{ $patient->PName }}
                </div>
              </div>
              <div>
                <div class="float-right h6">
                  &nbsp;&nbsp;
                  :العنوان
                </div>
                <div class="h6">
                  {{ $patient->PAddress }}
                </div>
              </div>
              <div>
                <div class="float-right h6">
                  &nbsp;&nbsp;
                  :الهاتف
                </div>
                <div class="h6">
                  {{ $patient->PPhone }}
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div id="invoice">
              <h2>معلومات الفحص</h2>
              <div>
                <div class="float-right h6">
                  &nbsp;&nbsp;
                  :اسم الفحص
                </div>
                <div class="h6">
                  {{ $examinations->MEname }}
                </div>
              </div>
              <div>
                <div class="float-right h6">
                  &nbsp;&nbsp;
                  :وقت الفحص
                </div>
                <div class="h6">
                  {{ $examinations->Time }}
                </div>
              </div>
              <div>
                <div class="float-right h6">
                  &nbsp;&nbsp;
                  :تاريخ الفحص
                </div>
                <div class="h6">
                  {{ $examinations->Date }}
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <table border="0" class="table">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">الفحص</th>
            <th class="unit">النتيجة</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($name as $key => $item)
            <tr>
              <td class="bold">{{ $key }}</td>
              <td class="bold">
                <h6 class="bold">{{ $item }}</h6>
              </td>
              <td class="bold">{{ $res[$key] }}</td>
            </tr>
          @endforeach


          </tfoot>
      </table>
      <div class="down">
        <hr>
        <div id="notices">
          <div>
            <b>
              <ins>
                للتواصل
              </ins>
            </b>
          </div>
          <div class="h6 mt-2">
            <div class="float-right">
              &nbsp;&nbsp;

              :الهاتف

            </div>
            <div class="">
              {{-- <b> {{ $lab-> }}</b> --}}
              dfdf
            </div>
          </div>
          <div class="h6 mt-2">
            <div class="float-right">
              &nbsp;&nbsp;

              :العنوان

            </div>
            <div class="">
              <b> {{ $lab->LLocation }}</b>
            </div>
          </div>
          <div class="h4  text-center">
            <div class="">
              &nbsp;&nbsp;
              مع تحيات مختبر
            </div>
            <div class="">
              <b> {{ $lab->LName }}</b>
            </div>
          </div>
        </div>
      </div>
    </main>
  </page>
  <div class="text-center my-5 print-hide">
      <button class="btn btn-warning btn-lg" onclick="window.print()">طباعة</button>
      <a href="{{ url()->previous() }}"class="btn btn-outline-dark btn-lg" >رجوع</a>

  </div>

</body>

</html>
