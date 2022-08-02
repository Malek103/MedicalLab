<x-headerIn />

<div class="container-fluid">
  <div class="row">
    {{-- Side Bar In --}}
    <div id="sideBarMenu" class="side collapse bg-white d-md-block col-md-3 sidebar">
      <div class="flex-shrink-0">
        <ul class="list-unstyled">
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
                    <li><a class="link-dark rounded" href="{{ '/doctor-Examination/' . $lid }}"> اضافة طبيب
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
      <div id="dash">

      </div>
    </div>


    {{-- Content --}}
    <div id="main" class="col-md-9">
      <div class="justify-content-md-center">
        <div class="container text-center">
            @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
              {{ Session::get('message') }}
              <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            </div>
          @endif

          <form method="POST" action="/CreatePatient/{{ $lid }}" class="form-group p-3 mt-5 pt-1">
            {{ method_field('POST') }}
            @csrf

            <div class="form-group row my-2">
              <div class="col">
                <input type="text" class="form-control text-right mt-3 @error('PID')
                                             is-invalid
                                         @enderror" value="{{ old('PID') }}" id="PID" name="PID"
                  placeholder="رقم هوية المريض" tabindex="2" required>
                @error('PID')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col">
                <input type="text" class="form-control text-right mt-3 @error('UserName')
                                    is-invalid
                                    @enderror" value="{{ old('UserName') }}" id="UserName" name="UserName"
                  placeholder="اسم المريض" tabindex="1" required>
                @error('UserName')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>


            </div>
            <div class="form-group row mt-3">
              <div class="col">
                <input type="text" class="form-control text-right @error('email')
                                    is-invalid
                                    @enderror" value="{{ old('email') }}" id="email" name="email"
                  placeholder="الايميل" tabindex="3" required autocomplete="email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                {{-- </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span data-feather="bar-chart-2"></span>
                                التقارير
                            </a>
                            <div class="dropdown-menu">
                                @if (Auth::user()->type == 'M')
                                    <a class="dropdown-item" href="{{ '/show-receipt/' . $lid }}">القوائم
                                        الحالية</a>
                                    <a class="dropdown-item" href="{{ '/Receipt-receivable/' . $lid }}">ايرادات
                                        وديون</a>
                                @endif
                                <a class="dropdown-item" href="#">طباعة نتيجة فحص</a> --}}
              </div>
            </div>

            <div class="form-group row mt-3">


              <div class="col">
                <input id="password-confirm" type="password" class="form-control text-right" name="password_confirmation" placeholder="تأكيد كلمة السر" required autocomplete="new-password" tabindex="5">
              </div>

              <div class="col">
                <input type="password" class="form-control text-right @error('password')

                                             is-invalid
                                         @enderror" value="{{ old('password') }}" id="password"
                  name="password" placeholder="كلمة السر" tabindex="4" required>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

            </div>

            <div class="form-group row mt-3">
              <div class="col">
                <input type="text" class="form-control text-right @error('address')
                                             is-invalid
                                         @enderror" value="{{ old('address') }}" id="address"
                  name="address" placeholder="العنوان" tabindex="7" required>
                @error('address')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col">
                <input type="text" class="form-control text-right @error('phone')
                                    is-invalid
                                    @enderror" value="{{ old('phone') }}" id="phone" name="phone" placeholder="الهاتف"
                  tabindex="6" required>
                @error('phone')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row mt-3">
              <div class="col-4">

                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" class="form-control @error('birth_date')
                                    is-invalid
                                    @enderror"
                  tabindex="9" required>
                @error('birth_date')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-2 txt-r text-right">
                <label for="birth_date" class="text-secondary">تاريخ
                  الميلاد</label>
              </div>

              <div class="col-6">
                <select name="gender" id="gender" class="form-control custom-select text-right" tabindex="8">
                  <option value="male" selected>ذكر</option>
                  <option value="female">انثى</option>
                </select>
              </div>
            </div>
            <input type="hidden" value="P" id="type" name="type">
            <div class="text-right">

              <a href="{{ url()->previous() }}" class="btn btn-outline-dark w-25 mx-2" tabindex="11">الرجوع</a>
              <button type="submit" class="btn btn-success w-50" tabindex="10">انشاء مريض
              </button>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>
<script>
  document.querySelector('#UserName').focus()
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('js/sidebars.js') }}"></script>

</body>

</html>
