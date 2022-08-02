<x-headerIn />
<div class="container-fluid">
    <div class="row">
        {{-- Side Bar In --}}
        <div id="sideBarMenu" class="side collapse bg-white d-md-block col-md-3 sidebar">
            <div class="flex-shrink-0">
                <ul class="list-unstyled">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#home-collapse" aria-expanded="true">
                            الفحوصات
                        </button>
                        <div class="collapse show" id="home-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                @if (Auth::user()->type == 'T')
                                    <li> <a class="link-dark rounded"
                                            href="{{ '/create-examination/' . $lab->LID }}">ادخال
                                            فحص</a></li>
                                @endif
                                <li><a class="link-dark rounded" href="{{ '/ShowAll-Examination/' . $lab->LID }}">بحث
                                        عن
                                        فحص</a></li>
                                <li><a class="link-dark rounded" href="{{ '/doctor-Examination/' . $lab->LID }}">
                                        اضافة طبيب
                                    </a></li>
                            </ul>
                        </div>
                    </li>
                    @if (Auth::user()->type == 'M')
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                                إدارة الفنيين
                            </button>
                            <div class="collapse" id="dashboard-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li> <a class="link-dark rounded"
                                            href="{{ '/create-tech/' . Auth::user()->manager->id . '/' . $lab->LID }}">انشاء
                                            فني</a></li>
                                    <li> <a class="link-dark rounded"
                                            href="{{ '/add-tech/' . Auth::user()->manager->id . '/' . $lab->LID }}">اضافة
                                            فني</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#orders-collapse" aria-expanded="false">
                            إدارة القوالب الطبية
                        </button>
                        <div class="collapse" id="orders-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li> <a class="link-dark rounded" href="{{ '/Template/' . $lab->LID }}">اضافة قالب</a>
                                </li>
                                <li><a class="link-dark rounded" href="{{ '/allTemplate/' . $lab->LID }}">تعديل
                                        قالب</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#account-collapse" aria-expanded="false">
                            إدارة المرضى
                        </button>
                        <div class="collapse" id="account-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li> <a class="link-dark rounded" href="{{ '/create-patient/' . $lab->LID }}">انشاء
                                        مريض</a></li>
                                <li> <a class="link-dark rounded" href="{{ '/show-patient/' . $lab->LID }}">بحث عن
                                        مريض</a></li>

                            </ul>
                        </div>
                    </li>
                    @if (Auth::user()->type == 'M')
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#report-collapse" aria-expanded="false">
                                التقارير
                            </button>
                            <div class="collapse" id="report-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                                    <li> <a class="link-dark rounded"
                                            href="{{ '/show-receipt/' . $lab->LID }}">السحوبات و الايداعات
                                        </a></li>
                                    <li><a class="link-dark rounded"
                                            href="{{ '/Receipt-receivable/' . $lab->LID }}">قائمة الذمم</a></li>

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
            <form action="{{ route('storeTemplate') }}" method="POST">
                @method('POST')
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-bs-dismiss="alert"
                            aria-label="Close">&times;</button>
                    </div>
                @endif
                @if (Session::has('required'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2 text-center" role="alert">
                        {{ Session::get('required') }}
                        <button type="button" class="close" data-bs-dismiss="alert"
                            aria-label="Close">&times;</button>
                    </div>
                @endif
                <table class="table table-bordered" id="dynamicAddRemove">
                    <tr>
                        <td collapse="2">
                            <input type="text" name="templateName" id="templateName" placeholder="أسم  القالب"
                                class="form-control text-right" value="{{ old('templateName') }}" required />
                            <input type="hidden" value="{{ $lab->LID }}" name="id" required>
                        </td>
                        <td class="text-right">
                            <h4>اسم القالب</h4>
                        </td>
                    </tr>
                    <tr class="text-right decoration-none">
                        <th>عنوان الحقل</th>
                        <th>
                            حذف
                        </th>
                    </tr>
                    <tr class="text-center">

                        {{-- <td>

              <input type="text" name="addMoreInputFields[0][subject]" placeholder="أسم الحقل" class="form-control text-right" />

            </td>
            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">اضف حقل أخر</button></td> --}}
                    </tr>
                </table>
                <div class="text-center row">
                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary col mx-2">اضف حقل
                        أخر</button>
                    <button type="submit" class="btn btn-success form-control col mx-2">انشأ</button>
                </div>
            </form>
        </div>

    </div>
    </main>
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('js/sidebars.js') }}"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function() {

        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][subject]" placeholder="أسم الحقل" class="form-control text-right" /></td><td class="text-center"><button type="button" class="btn btn-outline-danger remove-input-field">أحذف الحقل</button></td></tr>'
        );
        ++i;
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>
<script>
    document.querySelector('#templateName').focus()
</script>




</body>

</html>
