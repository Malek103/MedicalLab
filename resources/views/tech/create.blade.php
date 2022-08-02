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

        </div>

        <form method="POST" action="/createtech/{{ $lid }}" class="form-group p-3 mt-5 pt-1">
          {{ method_field('POST') }}
          @csrf
          @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
              {{ Session::get('message') }}
              <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> &times;</button>
            </div>
          @endif

          <input type="text" class="form-control text-right @error('UserName') is-invalid
                         @enderror" value="{{ old('UserName') }}" id="UserName" name="UserName" placeholder="اسم فني المختبر" required tabindex="1">
          @error('UserName')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <input tabindex="2" type="text" class="form-control text-right mt-3 @error('email')
                    is-invalid
                    @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="الايميل" required>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror

          <input tabindex="3" id="password" type="password" name="password" class="form-control text-right mt-3 @error('password') is-invalid @enderror" name="password" placeholder="كلمة السر">

          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <input tabindex="4" id="password-confirm" type="password" class="form-control text-right mt-2" name="password_confirmation" placeholder="تأكيد كلمة السر" required autocomplete="new-password" tabindex="4">

          <input tabindex="5" type="text" class="form-control mt-3 text-right @error('phone') is-invalid
                                                 @enderror" value="{{ old('phone') }}" id="phone" name="phone" placeholder="الهاتف ">
          @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <input tabindex="6" type="text" class="form-control mt-3 text-right @error('address') is-invalid
                    @enderror" value="{{ old('address') }}" id="address" name="address" placeholder="العنوان">
          @error('address')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror

          <input type="hidden" value="T" id="type" name="type">
          <input type="hidden" value="{{ $id }}" id="lab" name="lab">
          <div class="mt-5 mr-5 py-3 text-right">
            <a tabindex="8" href="{{ url()->previous() }}" class="btn btn-outline-dark w-25 mx-2">الرجوع</a>

            <button tabindex="7" type="submit" class="btn btn-success w-25">انشاء فني
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
