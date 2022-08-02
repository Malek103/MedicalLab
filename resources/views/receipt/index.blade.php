<x-headerIn />

<div class="container-fluid">
    <div class="row">
        {{-- Side Bar In --}}
        <div id="sideBarMenu" class="side collapse bg-white d-md-block col-md-3 sidebar">
            <div class="flex-shrink-0 ">
                <ul class="list-unstyled ">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#home-collapse" aria-expanded="true">
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
                            <button class="btn btn-toggle align-items-center rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                                إدارة الفنيين
                            </button>
                            <div class="collapse" id="dashboard-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li> <a class="link-dark rounded"
                                            href="{{ '/create-tech/' . Auth::user()->manager->id . '/' . $lid }}">انشاء
                                            فني</a></li>
                                    <li> <a class="link-dark rounded"
                                            href="{{ '/add-tech/' . Auth::user()->manager->id . '/' . $lid }}">اضافة
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
                                <li> <a class="link-dark rounded" href="{{ '/Template/' . $lid }}">اضافة قالب</a></li>
                                <li><a class="link-dark rounded" href="{{ '/allTemplate/' . $lid }}">تعديل قالب</a>
                                </li>
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
                                <li> <a class="link-dark rounded" href="{{ '/create-patient/' . $lid }}">انشاء
                                        مريض</a></li>
                                <li> <a class="link-dark rounded" href="{{ '/show-patient/' . $lid }}">بحث عن مريض</a>
                                </li>

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
            <div id="dash">

            </div>
        </div>
        <div id="main" class="col-md-9">
            {{-- Content --}}

            <form class="d-flex" action="/Receipt-search/{{ $lid }}" method="get">
                @csrf

                {{ method_field('PUT') }}


                <select class="mx-2" id="valid" name="valid" value="{{ old('valid') }}" tabindex="3">

                    <option value="all">الكل</option>

                    <option value="pull">سحب</option>

                    <option value="deposit">ايداع</option>

                </select>
                <input class="form-control me-2 text-right" id="search" type="search" name="search" placeholder="ابحث"
                    aria-label="Search" tabindex="1">
                <button class="btn btn-primary" type="submit" tabindex="2">ابحث</button>
            </form>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{-- here is the content --}}
                            <div class="container">
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
                                                <form action="/print-receipt/{{ $lid }}" method="GET"
                                                    class="my-3">
                                                    @csrf
                                                    <div>
                                                        <button type="submit" class="btn btn-warning w-25 mx-3"
                                                            tabindex="6">طباعة
                                                        </button>
                                                        <label>
                                                            <input type="date" name="endDate" tabindex="5">
                                                            &nbsp;
                                                            الي تاريخ

                                                        </label>
                                                        <label>

                                                            <input type="date" name="startDate" tabindex="4">
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
                                                    <th scope="col">المبلغ</th>
                                                    <th scope="col">تاريخ الحركة</th>
                                                    <th scope="col">الملاحظات</th>
                                                </tr>
                                            </thead>
                                            @foreach ($receipts as $key => $receipt)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td
                                                        style="{{ $receipt->type == 'P' ? 'color:#FF4848' : 'color:#71EFA3' }}">
                                                        {{ $receipt->amount }}</td>
                                                    <td>{{ $receipt->created_at }}</td>
                                                    <td>{{ $receipt->note }}</td>
                                            @endforeach


                                            </tbody>
                                        </table>
                                        <div class="col-md-9 row  ml-5 text-right">

                                            <div class="col-md-4 text-right"> <label
                                                    class="control-label text-right">{{ $Pull }}
                                                    :مجموع
                                                    السحوبات</label>
                                            </div>


                                            <div class="col-md-4 text-right"> <label class="control-label text-left">
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
                                            <button type="submit" class="btn btn-success w-75" tabindex="7">ايداع او
                                                سحب
                                            </button>
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
            document.querySelector('#search').focus()
        </script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
        <script src="{{ asset('js/sidebars.js') }}"></script>
        </body>

        </html>
