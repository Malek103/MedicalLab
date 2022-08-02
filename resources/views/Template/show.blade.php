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
                  <li> <a class="link-dark rounded" href="{{ '/create-examination/' . $lab->LID }}">ادخال
                      فحص</a></li>
                @endif
                <li><a class="link-dark rounded" href="{{ '/ShowAll-Examination/' . $lab->LID }}">بحث عن
                    فحص</a></li>
                    <li><a class="link-dark rounded" href="{{ '/doctor-Examination/' . $lab->LID }}"> اضافة طبيب
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
                  <li> <a class="link-dark rounded" href="{{ '/create-tech/' . Auth::user()->manager->id . '/' . $lab->LID }}">انشاء
                      فني</a></li>
                  <li> <a class="link-dark rounded" href="{{ '/add-tech/' . Auth::user()->manager->id . '/' . $lab->LID }}">اضافة
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
                <li> <a class="link-dark rounded" href="{{ '/Template/' . $lab->LID }}">اضافة قالب</a></li>
                <li><a class="link-dark rounded" href="{{ '/allTemplate/' . $lab->LID }}">تعديل قالب</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
              إدارة المرضى
            </button>
            <div class="collapse" id="account-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li> <a class="link-dark rounded" href="{{ '/create-patient/' . $lab->LID }}">انشاء مريض</a></li>
                <li> <a class="link-dark rounded" href="{{ '/show-patient/' . $lab->LID }}">بحث عن مريض</a></li>

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

                  <li> <a class="link-dark rounded" href="{{ '/show-receipt/' . $lab->LID }}">السحوبات و الايداعات
                    </a></li>
                  <li><a class="link-dark rounded" href="{{ '/Receipt-receivable/' . $lab->LID }}">قائمة الذمم</a></li>


                </ul>
              </div>
            </li>
          @endif
        </ul>
      </div>
      <div id="dash"></div>
    </div>


    {{-- Content --}}


    <div id="main" class="col-md-9">
      <div class="justify-content-md-center">

        <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col"> اسم القالب</th>
              <th scope="col">تعديل</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($templates as $key => $template)
              <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $template->TName }}</td>
                <td><a class="btn btn-primary" id="button" tabindex="{{ $key + 1 }}" href="/templateEdit/{{ $template->id }}/{{ $lab->LID }}">تعديل</a>
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
<script>
  document.querySelector('#button').focus()
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('js/sidebars.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
  var i = 0;
  $("#dynamic-ar").click(function() {
    ++i;
    $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
      '][subject]" placeholder="أسم الحقل" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">أحذف الحقل</button></td></tr>'
    );
  });
  $(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
  });
</script>
</body>

</html>



{{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>___scripts_2______scripts_3___ --}}
