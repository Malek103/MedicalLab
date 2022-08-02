<x-headerIn />
<style>
  .col-6 {
    border: 1px solid gray;
    padding: 8px;
  }

</style>
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
                  <div id="main" class="container col-md-9">
                      <div class="container text-center">
                        @if (Session::has('message'))
                          <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                          </div>
                        @endif
                      </div>

                      <div class="row mx-2">
                        <div class="col-12 row">

                          <div class="col-6 text-right">
                            <span class="float-right">&nbsp;&nbsp;&nbsp;:الفحص</span>
                            &nbsp;
                            <b>{{ $template }}</b>
                          </div>
                          <div class="col-6 text-right">
                            <span class="float-right">&nbsp;&nbsp;&nbsp;:المريض</span>
                            &nbsp;
                            <b> {{ $patientName }}</b>
                          </div>
                        </div>
                        <div class="col-12 row text-right">

                          <div class="col-6">
                            <span class="float-right">&nbsp;&nbsp;&nbsp;:القسم</span>
                            &nbsp;
                            <b>{{ $header['Lab_Dep'] }}</b>
                          </div>
                          <div class="col-6">
                            <span class="float-right"> &nbsp;&nbsp;&nbsp;:الطبيب</span>

                            {{-- <b>{{ $header['Doctor'] }}</b> --}}
                            <b>{{ $doctorName }}</b>
                          </div>
                        </div>
                        <div class="col-12 row text-right">
                          <div class="col-6">
                            <span class="float-right">&nbsp;&nbsp;&nbsp;:وقت أخذ العينة</span>
                            &nbsp;
                            <b>{{ $header['time'] }}</b>

                          </div>
                          <div class="col-6">
                            <span class="float-right">&nbsp;&nbsp;&nbsp;:تاريخ أخذ العينة</span>
                            &nbsp;
                            <b>{{ $header['date'] }}</b>
                          </div>
                        </div>

                      </div>

                      <form method="POST" action="/create-examination-two/{{ $lid }}" class="form-group p-3 mt-2 pt-1">
                        {{ method_field('POST') }}
                        @csrf
                        {{-- <div class="form-group row">

                          <div class="form-group row"> --}}

        <input type="hidden" name="patient" value="{{ $header['patient'] }}">
        <input type="hidden" name="template" value="{{ $header['template'] }}">
        <input type="hidden" name="Doctor" value="{{ $header['Doctor'] }}">
        <input type="hidden" name="Lab_Dep" value="{{ $header['Lab_Dep'] }}">
        <input type="hidden" name="time" value="{{ $header['time'] }}">
        <input type="hidden" name="created_by" value="{{ $lid }}">
        <input type="hidden" name="date" value="{{ $header['date'] }}">
        <input type="hidden" name="Price" value="{{ $header['Price'] }}">

        <div class="row my-2">
          @foreach ($templateItems as $key => $item)
            {{-- <label for="{{ $item->TTID }}">{{ $item->Name }}</label>
                                  <input type="{{ $item->type }}" name="{{ $item->TTID }}"> --}}

            <div class="col-md-6 row mt-2 text-right">

              <div class="col-md-8">

                @if ($key == 0)
                  <input type="text" class="form-control text-right @error('Lab_Dep')
                                    is-invalid
                                    @enderror" value="{{ old('Lab_Dep') }}" id="{{ $item->id }}"
                    name="test[{{ $item->id }}]" required autocomplete="Lab_Dep" focus>
                  @error('Lab_Dep')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                @else
                  <input type="text" class="form-control text-right @error('Lab_Dep')
                                    is-invalid
                                    @enderror" value="{{ old('Lab_Dep') }}" id="{{ $item->id }}"
                    name="test[{{ $item->id }}]" required autocomplete="Lab_Dep">
                  @error('Lab_Dep')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                @endif

              </div>
              <div class="col-md-4 text-right"> <label class="control-label text-right" for="{{ $item->id }}">{{ $item->Name }}</label>
              </div>

            </div>
          @endforeach
        </div>
        <br>

        <div class="mt-5">
          <div class="row text-right">
            <div class="col-5"></div>
            <div class=" col col-4">
              <input type="number" step="0.01" max="{{ $header['Price'] }} " class="form-control text-right" id="amount" name="amount" placeholder="المبلغ للدفع" required>
            </div>
            <div class="col col-3 h5">
              <ins> {{ $price }} $ </ins>
              &nbsp;
              <ins> :تكلفة الفحص </ins>
            </div>
          </div>
          <br>
          <div class="text-right mt-3">

            <a href="{{ url()->previous() }}" class="btn btn-outline-dark w-25">الرجوع</a>
            <button type="submit" class="btn btn-success w-50">انشاء فحص </button>
          </div>

        </div>

      </form>


    </div>

  </div>
</div>
</div>
</div>
</div>
</main>
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
