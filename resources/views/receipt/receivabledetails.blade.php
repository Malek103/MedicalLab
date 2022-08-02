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
            <div class="alert alert-success" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
          <div class="form-group row my-2">
            <div class="col-md-4">


            </div>
            <div class="col-md-8">

              <form action="/print-receivable/{{ $lid }}/{{ $id }}" method="GET" class="my-3">
                @csrf
                <div>
                  <button type="submit" class="btn btn-warning w-25 mx-3" tabindex="3">طباعة
                  </button>
                  <label>
                    <input type="date" name="endDate" tabindex="2">
                    &nbsp;
                    الي تاريخ

                  </label>
                  <label>

                    <input type="date" id="startDate" name="startDate" tabindex="1">
                    &nbsp;
                    من تاريخ
                  </label>

                </div>


              </form>
            </div>

          </div>

          <table class="table">
            <thead class="table-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">اسم الفحص</th>
                <th scope="col">اسم الفني</th>
                <th scope="col">سعر الفحص</th>
                <th scope="col">المبلغ المدفوع </th>
              </tr>
            </thead>
            @foreach ($examination as $key => $examinations)
              <tr>
                <th scope="row">{{ $key + 1 }}</th>


                <td>{{ $examinations->MEname }}</td>
                <td>{{ DB::table('technician_labs')->where('id', $examinations->TID)->value('TName') }}
                </td>
                <td>{{ $examinations->Price }}</td>
                <td>{{ $examinations->amount }}</td>

            @endforeach


            </tbody>
          </table>
          <div class="mt-5 mr-5 py-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-dark w-25 mx-2" tabindex="4">الرجوع</a>
          </div>
          {{-- <div class="col-md-9 row  ml-5 text-right">

                                                    <div class="col-md-4 text-right"> <label
                                                            class="control-label text-right">{{ $Pull }}
                                                            :مجموع
                                                            السحوبات</label>
                                                    </div>


                                                    <div class="col-md-4 text-right"> <label
                                                            class="control-label text-left">
                                                            {{ $Deposit }}:مجموع
                                                            الايداعات</label>
                                                    </div>

                                                    <div class="col-md-4 text-right"> <label
                                                            class="control-label text-left">{{ $Deposit + $Pull }}
                                                            :صافي المبلغ</label>
                                                    </div>



                                                </div>
                                                <form action="/create-receipt/{{ $lid }}" method="GET"
                                                    class="my-3">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success w-75">ايداع او
                                                        سحب
                                                    </button>
                                                </form> --}}
        </div>
      </div>


    </div>
  </div>
</div>
</div>

</div>
</div>
<script>
  document.querySelector('#startDate').focus()
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('js/sidebars.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
