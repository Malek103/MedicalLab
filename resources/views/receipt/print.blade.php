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
        <a class="col-md-2 col-lg-1 me-0 px-3 text-center text-light h5" href="/">???????????? ?????????????? </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
                                                                                                                                                                                                        @if (Auth::user()->status == 1){
                                                                                                                                                                                                            <input class="form-control form-control-dark w-100 text-center" type="text" placeholder="??????"
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
                            <div class="h2">?????????????? ??????????????</div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :?????? ??????????????
                                </div>
                                <div class="h6">
                                    {{ $lab->LName }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :??????????????
                                </div>
                                <div class="h6">
                                    {{ $lab->LLocation }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :????????????
                                </div>
                                <div class="h6">
                                    {{ $lab->LPhone }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div id="invoice">
                            <h2>?????????????? ???????????? </h2>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :?????? ????????????
                                </div>
                                <div class="h6">
                                    {{ $manager->MName }}
                                </div>
                            </div>
                            <div>
                                <div class="float-right h6">
                                    &nbsp;&nbsp;
                                    :?????? ????????????
                                </div>
                                <div class="h6">
                                    {{ $manager->MPhone }}
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
                        <th class="desc">????????????</th>
                        <th class="unit">?????? ????????????</th>
                        <th class="unit">?????????? ????????????</th>
                        <th class="unit">??????????????????</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $key => $receipt)
                        <tr>
                            <td class="bold">{{ $key + 1 }}</td>
                            <td class="bold">
                                <h6 class="bold">{{ $receipt->amount }}</h6>
                            </td>
                            <td class="bold">
                                @if ($receipt->type == 'P')
                                    <P>?????? ???? ??????????????</P>
                                @elseif($receipt->type == 'D')
                                    <p>?????????? ?????? ??????????????</p>
                                @endif
                            </td>
                            <td class="bold">
                                <h6 class="bold">{{ $receipt->created_at }}</h6>
                            </td>
                            <td class="bold">{{ $receipt->note }}</td>
                        </tr>
                    @endforeach


                    </tfoot>
            </table>
            <div class="down">
                <hr>
                <div id="notices">
                    <div>
                        <b>

                            ???????????? ??????????????

                        </b>
                    </div>
                    <div class="h6 mt-2">
                        <div class="float-right">
                            &nbsp;&nbsp;

                            : ?????????? ??????????????????

                        </div>
                        <div class="">
                            {{-- <b> {{ $lab-> }}</b> --}}
                            {{ $Deposit }}
                        </div>
                    </div>
                    <div class="h6 mt-2">
                        <div class="float-right">
                            &nbsp;&nbsp;

                            :?????????? ????????????????

                        </div>
                        <div class="">
                            {{ $Pull }}
                        </div>
                    </div>
                    <div class="h6 mt-2">
                        <div class="float-right">
                            &nbsp;&nbsp;

                            : ???????? ????????????

                        </div>
                        <div class="">

                            {{ $Deposit + $Pull }}
                        </div>
                    </div>
                    <div class="h4  text-center">
                        <div class="">
                            &nbsp;&nbsp;
                            ???? ?????????? ??????????
                        </div>
                        <div class="">
                            {{ $lab->LName }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </page>
    <div class="text-center my-5 print-hide">
        <button class="btn btn-warning btn-lg" onclick="window.print()">??????????</button>
        <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-lg">????????</a>

    </div>

</body>

</html>
