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
            <div id="main" class="col-md-9">

                 <div class="">
                      <div class="">

                        @if (Session::has('message'))
                          <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                          </div>
                        @endif

                        <table class="table text-center">
                            <thead class="table-dark">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">الاسم</th>

                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctor as $key => $doctors)
                                <tr>
                                  <th scope="row">{{ $key + 1 }}</th>
                                  <td>{{ $doctors->name }}</td>
                                  {{-- <td><a class="btn btn-primary" id="button" tabindex="{{ $key + 1 }}" href="/templateEdit/{{ $template->id }}/{{ $lab->LID }}">تعديل</a> --}}
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                          <div class="text-center">
                            <a href="{{ '/create-doctor/' . $lid }}" class="btn btn-success form-control">انشأ</a>
                          </div>
                      </div>



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

