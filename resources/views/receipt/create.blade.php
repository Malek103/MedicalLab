<x-headerIn />

<div class="container-fluid">

<div class="row">
    {{-- Side Bar In --}}
    <div id="sideBarMenu" class="side collapse bg-white d-md-block col-md-3 sidebar">
      <div class="flex-shrink-0">
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
                <li><a class="link-dark rounded" href="{{ '/allTemplate/' . $lid }}">تعديل قالب</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
              إدارة المرضى
            </button>
            <div class="collapse" id="account-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li> <a class="link-dark rounded" href="{{ '/create-patient/' . $lid }}">انشاء
                    مريض</a></li>
                <li> <a class="link-dark rounded" href="{{ '/show-patient/' . $lid }}">بحث عن مريض</a>
                </li>

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

                  <li> <a class="link-dark rounded" href="{{ '/show-receipt/' . $lid }}">السحوبات و
                      الايداعات
                    </a></li>
                  <li><a class="link-dark rounded" href="{{ '/Receipt-receivable/' . $lid }}">قائمة
                      الذمم</a></li>


                </ul>
              </div>
            </li>
          @endif

        </ul>
      </div>
         <div id="dash"></div>
    </div>

  </div>

  {{-- here is the content --}}
  <div id="main" class="col-md-9">
    <div class="justify-content-md-center">
      <div class="container text-center">
        @if (Session::has('message'))
          <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              &times;</button>
          </div>
        @endif
        @if (Session::has('maxAmount'))
          <div class="alert alert-warning alert-dismissible fade show mt-2 text-center" role="alert">
            {{ Session::get('maxAmount') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              &times;</button>
          </div>
        @endif
        <div class="row h4">
          <div class="col">
            <ins>
              {{ DB::table('receipts')->where('created_by', $lid)->sum('amount') }}
            </ins>
          </div>
          <div class="col">:المبلغ في الخزينة</div>
        </div>
        <form method="POST" action="/store-receipt/{{ $lid }}" class="form-group p-3 ">
          {{ method_field('POST') }}
          {{-- @method_field('POST') --}}
          @csrf

          <div class="row my-2">

            <div class="col-lg-9">
              <select name="type" id="type" tabindex="1" class="form-control">
                <option value="P" @if ('P' === old('type'))
                  selected
                  @endif>سحب</option>
                <option value="D" @if ('D' === old('type'))
                  selected
                  @endif>ايداع</option>

              </select>

            </div>
            <div class="col-lg-3 my-auto label ">
              <label for="created_for">نوع العملية</label>
            </div>
          </div>

          <div class="row my-2">

            <div class="col-lg-9">
              <input type="number" step="0.01" tabindex="2" class="form-control my-2 @error('amount')
                                                    is-invalid
                                                    @enderror"
                value="{{ old('amount') }}" id="amount" name="amount" placeholder="0" min="0" requiured>
              @error('amount')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="col-lg-3 my-auto label">
              <label for="created_for">المبلغ</label>
            </div>
          </div>
          <textarea name="note" id="note" class="form-control my-2 text-right @error('note')
                                                        is-invalid
                                                    @enderror" rows="4"
            placeholder="الملاحظات!" tabindex="3">{{ old('note') }}</textarea>
          @error('note')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <div class="mt-3 py-3 text-right">
            <a href="{{ '/show-receipt/' . $lid }}" class="btn btn-outline-dark w-25" tabindex="5">رجوع</a>

            <button type="submit" class="btn btn-success w-50" tabindex="4">حفظ
            </button>
          </div>

        </form>

      </div>
    </div>

  </div>
</div>

<script>
  document.querySelector('#type').focus()
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
{{-- <script src="{{ asset('js/sidebars.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script> --}}
</body>

</html>
