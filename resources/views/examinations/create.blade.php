<x-headerIn />
<div class="container-fluid">
  <div class="row">
    {{-- Side Bar In --}}
    <div id="sideBarMenu" class="side collapse bg-white d-md-block col-md-3 sidebar">
      <div class="flex-shrink-0">
        <ul class="list-unstyled ps-0">
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




                  {{-- here is the content --}}
                  <div id="main" class="col-md-9 w-100">

                    <div class="">
                      <div class="">

                        @if (Session::has('message'))
                          <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                          </div>
                        @endif
                      </div>

                      <form method="POST" action="/create-examination/{{ $lid }}" class="p-3 mt-5 pt-1">
                        {{ method_field('POST') }}
                        @csrf
                        <div class="row">
                          <div class="col-12 row mt-3">
                            <div class="col-4">

                              <select class="form-control text-right" name="template" tabindex="2">
                                @foreach (DB::table('templates')->where('LID', $lid)->get() as $template)
                                  <option value="{{ $template->id }}">
                                    {{ $template->TName }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-2 txt-r text-right">
                              <label for="birth_date" class="text-secondary">اسم
                                الفحص</label>
                            </div>
                            <div class="col-4">
                              <input type="hidden" name="lid" value="{{ $lid }}">
                              <select class="form-control text-right" name="patient" id="patient" tabindex="1">
                                @foreach (DB::table('patients')->get() as $patient)
                                  <option value="{{ $patient->id }}">
                                    {{ $patient->PName }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-2 txt-r text-right">
                              <label for="birth_date" class="text-secondary">اسم
                                المريض</label>
                            </div>
                          </div>

                          <div class="col-12 row mt-3">
                            <div class="col-6">
                              <input type="text" class="form-control text-right @error('Lab_Dep')
                                    is-invalid
                                    @enderror" value="{{ old('Lab_Dep') }}" id="Lab_Dep"
                                name="Lab_Dep" placeholder="قسم المختبر" required autocomplete="Lab_Dep" tabindex="4">
                              @error('Lab_Dep')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="col-4">
                                <input type="hidden" name="lid" value="{{ $lid }}">
                                <select class="form-control text-right" name="Doctor" id="Doctor" tabindex="3">
                                  @foreach (DB::table('doctors')->get() as $doctor)
                                    <option value="{{ $doctor->id }}">
                                      {{ $doctor->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-2 txt-r text-right">
                                <label for="birth_date" class="text-secondary">اسم
                                  الطبيب</label>
                              </div>
                            </div>
                          </div>

                          <div class="col-12 row mt-3">
                            <div class="col-md-4">

                              <input type="time" id="inputMDEx1" class="form-control" name="time" tabindex="6">
                            </div>
                            <div class="col-md-2 txt-r text-right">
                              <label for="birth_date" class="text-secondary">وقت اخذ
                                العينه</label>
                            </div>

                            <div class="col-md-4">

                              <input type="date" id="inputMDEx1" class="form-control" name="date" tabindex="5">
                            </div>
                            <div class="col-md-2 txt-r text-right">
                              <label for="birth_date" class="text-secondary">تاريخ اخذ
                                العينه</label>
                            </div>
                          </div>
                          <div class="col-12 row mt-3">
                            <div class="col">
                              <input type="number" step="0.1" min="0" class="form-control text-right  @error('Price')
                                             is-invalid
                                         @enderror"
                                value="{{ old('Price') }}" id="Price" name="Price" placeholder="سعر الفحص" tabindex="7" required>
                              @error('Price')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                          </div>

                          <div class="col-12 mt-5 text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-dark w-25 mx-2" tabindex="9">الرجوع</a>
                            <button type="submit" class="btn btn-success w-50" tabindex="8">التالي</button>

                          </div>
                        </div>
                      </form>

                    </div>
                  </div>


    </div>
  </div>


</div>
</div>
  <script>
    document.querySelector('#patient').focus()
  </script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('js/sidebars.js') }}"></script>
<script>
  document.querySelector('#UserName').focus()
</script>
</body>

</html>

