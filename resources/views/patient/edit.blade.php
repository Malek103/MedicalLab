<x-headerIn />

<div class="container-fluid">
  <div class="row">
    {{-- Side Bar In --}}
    <div id="sideBarMenu" class="side collapse bg-white d-md-block col-md-3 sidebar">
      <div class="flex-shrink-0 ">
        <ul class="list-unstyled ">
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
              الفحوصات
            </button>
            <div class="collapse show" id="home-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                @if (Auth::user()->type == 'T')
                  <li> <a class="link-dark rounded" href="{{ '/create-examination/' . $lid }}">ادخال
                      فحص</a></li>
                @endif
                <li><a class="link-dark rounded" href="{{ '/ShowAll-Examination/' . $lid }}">بحث عن
                    فحص</a></li>
                    <li><a class="link-dark rounded" href="{{ '/doctor-Examination/' . $lid}}"> اضافة طبيب
                    </a></li>
              </ul>
            </div>
          </li>
          @if (Auth::user()->type == 'M')
            <li class="mb-1">
              <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                إدارة الفنيين
              </button>
              <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li> <a class="link-dark rounded" href="{{ '/create-tech/' . Auth::user()->manager->id . '/' . $lid }}">انشاء
                      فني</a></li>
                  <li> <a class="link-dark rounded" href="{{ '/add-tech/' . Auth::user()->manager->id . '/' . $lid }}">اضافة
                      فني</a></li>
                </ul>
              </div>
            </li>
          @endif
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
              إدارة القوالب الطبية
            </button>
            <div class="collapse" id="orders-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li> <a class="link-dark rounded" href="{{ '/Template/' . $lid }}">اضافة قالب</a></li>
                <li><a class="link-dark rounded" href="{{ '/allTemplate/' . $lid }}">تعديل قالب</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
              إدارة المرضى
            </button>
            <div class="collapse" id="account-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li> <a class="link-dark rounded" href="{{ '/create-patient/' . $lid }}">انشاء مريض</a></li>
                <li> <a class="link-dark rounded" href="{{ '/show-patient/' . $lid }}">بحث عن مريض</a></li>

              </ul>
            </div>
          </li>
          @if (Auth::user()->type == 'M')
            <li class="mb-1">
              <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#report-collapse" aria-expanded="false">
                التقارير
              </button>
              <div class="collapse" id="report-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                  <li> <a class="link-dark rounded" href="{{ '/show-receipt/' . $lid }}">السحوبات و الايداعات
                    </a></li>
                  <li><a class="link-dark rounded" href="{{ '/Receipt-receivable/' . $lid }}">قائمة الذمم</a></li>


                </ul>
              </div>
            </li>
          @endif
        </ul>
      </div>
      <div id="dash"></div>
    </div>
    {{-- here is the content --}}
    <div id="main" class="col-md-9">
      <div class="justify-content-md-center">
        <div class="container text-center">
          @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
              {{ Session::get('message') }}
              <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            </div>

          @endif

          <div class="table-responsive">
            {{-- Content --}}


            <div class="">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 bg-white border-b border-gray-200">

                    {{-- here is the content --}}
                    <div class="container">
                      <div class="justify-content-md-center">
                        <div class="container text-center">


                          <form method="POST" action="/Patient-update/{{ $patient->id }}" class="form-group p-3 mt-5 pt-1">
                            {{ method_field('POST') }}
                            @csrf
                            <div class="row mt-3">
                              <input type="text" class="form-control text-right col-8 @error('PName')
                                    is-invalid
                                    @enderror" value="{{ $patient->PName }}" id="PName"
                                name="PName" placeholder="اسم المريض" tabindex="1" required>
                              @error('UserName')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                              <label for="PName" class="text-right col-4">
                                اسم المريض
                              </label>
                            </div>
                            <div class="row mt-3">
                              <input type="text" class="form-control col-8 text-right @error('PID')
{{-- <div class="container me-5">
                                        <div class="justify-content-md-center">
                                            <div class="container text-center">
                                                @if (Session::has('message'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ Session::get('message') }}
                                                    </div>

                                                @endif
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                                        role="button" aria-haspopup="true" aria-expanded="false">
                                                        <span data-feather="users"></span>
                                                        إدارة القوالب الطبية</a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ '/Template/' . $lid }}">اضافة قالب</a>
                                                        <a class="dropdown-item"
                                                            href="{{ '/allTemplate/' . $lid }}">تعديل قالب</a>
                                                    </div>
                                                </li>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                                        role="button" aria-haspopup="true" aria-expanded="false">
                                                        <span data-feather="users"></span>
                                                        إدارة المرضى
                                                    </a>
                                                    <div class="dropdown-menu">


                                                        <a class="dropdown-item"
                                                            href="{{ '/create-patient/' . $lid }}">انشاء مريض</a>
                                                        <a class="dropdown-item"
                                                            href="{{ '/show-patient/' . $lid }}">بحث عن مريض</a>
                                                    </div>
                                                </li>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                                        role="button" aria-haspopup="true" aria-expanded="false">
                                                        <span data-feather="bar-chart-2"></span>
                                                        التقارير
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        @if (Auth::user()->type == 'M')
                                                            <a class="dropdown-item"
                                                                href="{{ '/show-receipt/' . $lid }}">القوائم
                                                                الحالية</a>
                                                            <a class="dropdown-item"
                                                                href="{{ '/Receipt-receivable/' . $lid }}">ايرادات
                                                                وديون</a>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <div class="navbar-nav d-flex text-center h5 px-0">

                                                        <a class="nav-link bg-dark text-light px-0"
                                                            href="{{ route('logout') }}" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
                                                            {{ __('تسجيل الخروج') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>
                                                </ul>
                                            </div>
                                            </nav>

                                            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">



                                                <div
                                                    class="
                                              d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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



                                            <div class="py-12">
                                              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                                  <div class="p-6 bg-white border-b border-gray-200">

                                                    <div class="container me-5">
                                                      <div class="justify-content-md-center">
                                                        <div class="container text-center">
                                                          @if (Session::has('message'))
                                                            <div class="alert alert-success" role="alert">
                                                              {{ Session::get('message') }}
                                                            </div>
                                                          @endif

                                                          <form method="POST" action="/Patient-update/{{ $patient->id }}" class="form-group p-3 mt-5 pt-1">
                                                            {{ method_field('POST') }}
                                                            @csrf
                                                            <div class="form-group row my-2">
                                                              <div class="col-md-6">
                                                                <input type="text" class="form-control text-right mt-3 @error('PID') --}}
                                             is-invalid
                                         @enderror"
                                value="{{ $patient->PID }}" id="PID" name="PID" placeholder="رقم هوية المريض" tabindex="2" required>
                              @error('PID')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror

                              <label for="PID" class="text-right col-4">
                                رقم الهوية
                              </label>

                            </div>


                            <div class="row mt-3">
                              <input type="text" class="form-control text-right col-8 @error('PAddress')
                                             is-invalid
                                         @enderror" value="{{ $patient->PAddress }}"
                                id="PAddress" name="PAddress" placeholder="العنوان" tabindex="3" required>
                              @error('address')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror

                              <label for="PID" class="text-right col-4">
                                عنوان المريض
                              </label>

                            </div>
                            <div class="row mt-3">
                              <input type="text" class="form-control text-right col-8 @error('PPhone')
                                    is-invalid
                                    @enderror" value="{{ $patient->PPhone }}" id="PPhone"
                                name="PPhone" placeholder="الهاتف" tabindex="4" required>
                              @error('phone')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                              <label for="PID" class="text-right col-4">
                                الهاتف
                              </label>

                            </div>

                            <div class="row mt-3">

                              <input type="date" id="PDofB" name="PDofB" value="{{ $patient->PDofB }}" class="form-control col-8 @error('PDofB')
                                    is-invalid
                                    @enderror"
                                tabindex="5" required>
                              @error('PDofB')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                              <label for="PID" class="text-right col-4">
                                تاريخ الميلاد
                              </label>

                            </div>

                            <div class="row mt-3">
                              <select name="PGender" id="PGender" value="{{ $patient->PGender }}" class="form-control custom-select col-8 text-right" tabindex="6">
                                <option value="male" @if ($patient->PGender == 'male')
                                  selected
                                  @endif>
                                  ذكر
                                </option>
                                <option value="female" @if ($patient->PGender == 'female')
                                  selected
                                  @endif>
                                  انثى</option>
                              </select>
                              <label for="PID" class="text-right col-4">
                                الجنس
                              </label>

                            </div>
                            <div class="mt-5 text-right">
                              <a href="{{ url()->previous() }}" class="btn btn-outline-dark w-25" tabindex="8">الرجوع</a>

                              <button type="submit" class="btn btn-success w-50" tabindex="7">
                                تعديل سجل مريض </button>
                            </div>

                          </form>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script>
            document.querySelector('#PName').focus()
          </script>
          <script src="{{ asset('js/app.js') }}"></script>
          <script src="{{ asset('js/dashboard.js') }}"></script>

          <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
          <script src="{{ asset('js/sidebars.js') }}"></script>
          </body>

          </html>
