<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Medical Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .bold {
            font-weight: bold;
        }

        .col-6 {
            border: 1px solid gray;
            padding: 4px;
        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            /* border: 1.25cm solid #000; */
            padding: 1.2rem;
        }

        @media print {

            body,
            page[size="A4"] {
                margin: 0;
                box-shadow: 0;
                width: 100%;
                height: auto;
            }

            * {

                font-size: 1.2rem;
            }

            .print-hide {
                display: none;
            }
        }

        .down {

            margin-top: 1rem;
            text-align: right;
        }

        #details {
            border-bottom: 1px solid #eee;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap');

        * {
            font-family: 'Almarai',
                sans-serif;
        }

    </style>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<!--
<body>
    {{-- navBar In --}}
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="col-md-2 col-lg-1 me-0 px-3 text-center text-light h5" href="/">برنامج المختبر </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @if (Auth::user()->status == 1){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <input class="form-control form-control-dark w-100 text-center" type="text" placeholder="بحث"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-label="Search">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @endif
        @endauth




    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
-->

<body>
    <page size="A4">
        <header>
            <div class="text-center">
                <img width="120" src="{{ asset('images/MedicalLab.png') }} ">
            </div>
            {{-- <div id="company">
      <div>455 Foggy Heights, AZ 85004, US</div>
      <div>(602) 519-0450</div>
      <div><a href="mailto:company@example.com">company@example.com</a></div>
    </div> --}}
            </div>
        </header>
        <main>
            <div id="details" class="text-right">
                <div class="row mx-5 mt-4 mb-2">
                    <div class="col">
                        <div id="client">
                            <div class="h2">معلومات الذمة</div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :اسم الذمة
                                </div>
                                <div class="h6">
                                    {{ $patient->PName }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :العنوان
                                </div>
                                <div class="h6">
                                    {{ $patient->PAddress }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :الهاتف
                                </div>
                                <div class="h6">
                                    {{ $patient->PPhone }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :تاريخ الميلاد
                                </div>
                                <div class="h6">
                                    {{ $patient->PDofB }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div id="invoice">
                            <h2>معلومات المختبر </h2>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :اسم المختبر
                                </div>
                                <div class="h6">
                                    {{ $lab->LName }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :العنوان
                                </div>
                                <div class="h6">
                                    {{ $lab->LLocation }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :الهاتف
                                </div>
                                <div class="h6">
                                    {{ $lab->LPhone }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :مدير المختبر
                                </div>
                                <div class="h6">
                                    {{ $manager->MName }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <table border="0" class="table">
                <thead>
                    <tr>
                        <th class="no">#</th>
                        <th class="desc">اسم الفحص</th>
                        <th class="unit">تاريخ الفحص</th>
                        <th class="unit">سعر الفحص</th>
                        <th class="unit">المبلغ المدفوع</th>
                        <th class="unit">صافي المبلغ </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($examinations as $key => $examination)
                        <tr>
                            <td class="bold">{{ $key + 1 }}</td>
                            <td class="bold">
                                <h6 class="bold">{{ $examination->MEname }}</h6>
                            </td>

                            <td class="bold">
                                <h6 class="bold">{{ $examination->Date }}</h6>
                            </td>
                            <td class="bold">
                                <h6 class="bold">{{ $examination->Price }}</h6>
                            </td>
                            <td class="bold">
                                <h6 class="bold">{{ $examination->amount }}</h6>
                            </td>
                            @if ($examination->Price >= $examination->amount)

                                <td class="bold">{{ $examination->Price - $examination->amount }}</td>



                            @elseif($examination->amount > $examination->Price)
                                <td class="bold">{{ $examination->amount - $examination->Price }}</td>
                            @endif
                        </tr>
                    @endforeach


                    </tfoot>
            </table>
            <div class="down">
                <hr>
                <div id="notices">
                    <div>
                        <b>

                            اجمالي الحركات

                        </b>
                    </div>
                    <div class="h6 mt-2">
                        <div class="float-right">
                            &nbsp;&nbsp;

                            : مجموع سعر الفحوصات

                        </div>
                        <div class="">
                            {{ $price }}
                        </div>
                    </div>
                    <div class="h6 mt-2">
                        <div class="float-right">
                            &nbsp;&nbsp;

                            :مجموع المبلغ المدفوع

                        </div>
                        <div class="">
                            {{ $amount }}
                        </div>
                    </div>
                    <div class="h6 mt-2">
                        <div class="float-right">
                            &nbsp;&nbsp;

                            : صافي المبلغ

                        </div>
                        <div class="">
                            @if ($price > $amount)
                                {{ $price - $amount }}
                            @elseif ($amount>$price)

                                {{ $amount - $price }}
                            @endif
                        </div>
                    </div>
                    <div class="h5  text-center">
                        <div class="">
                            &nbsp;&nbsp;
                            الدفعات
                        </div>

                    </div>
                    <table border="0" class="table text-center">
                        <thead>
                            <tr>
                                <th class="no">#</th>
                                <th class="desc">المبلغ</th>
                                <th class="unit">تاريخ الدفع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment as $key => $payments)
                                <tr>
                                    <td class="bold">{{ $key + 1 }}</td>
                                    <td class="bold">
                                        <h6 class="bold">{{ $payments->amount }}</h6>
                                    </td>

                                    <td class="bold">
                                        <h6 class="bold">{{ $payments->created_at }}</h6>
                                    </td>
                                </tr>
                            @endforeach


                            </tfoot>
                    </table>
                    <div>
                        <b>

                            اجمالي الدفعات

                        </b>
                    </div>
                    <div class="h6 mt-2">
                        <div class="float-right">
                            &nbsp;&nbsp;

                            : مجموع الدفعات

                        </div>
                        <div class="">
                            {{ $pay }}
                        </div>
                    </div>
                    <div class="h6 mt-2">
                        <div class="float-right">
                            &nbsp;&nbsp;

                            :رصيد الذمة

                        </div>
                        <div class="">
                            {{ $amount - $price + $pay }}
                        </div>
                    </div>
                </div>
        </main>
    </page>
    <div class="text-center my-5 print-hide">
        <button class="btn btn-warning btn-lg" onclick="window.print()">طباعة</button>
        <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-lg">رجوع</a>

    </div>

</body>

</html>
