{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="UserName" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm
                                Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<x-headerOut />
<style>
    .bodycenter {
        margin-bottom: 130px;
        margin-top: 200px;
    }

    body {}

    @media (min-width: 768px) {
        .bodycenter {
            margin-bottom: 210px;
        }

    }

</style>
<x-topBarOut />
<x-navbarOut />
<div class="container bodycenter">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header txt-r">{{ __('انشاء حساب جديد') }}</div>

                <div class="card-body">
                    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control  txt-r" id="name" placeholder="اسمك"
                                    data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control  txt-r" name="email" id="email"
                                    placeholder="برديك الاكتروني" data-rule="email"
                                    data-msg="Please enter a valid email">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="tel" class="form-control  txt-r" name="phone" id="phone"
                                    placeholder="هاتفك" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="datetime" name="date" class="form-control  txt-r datepicker" id="date"
                                    placeholder="اسم المختبر" data-rule="minlen:4"
                                    data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>

                        </div> --}}
                        <div class="form-group row my-2">

                            <div class="col  align-self-start">
                                <input id="email" type="email"
                                    class="form-control txt-r @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="الأيميل" required autocomplete="email"
                                    tabindex="2">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col align-self-end">
                                <input id="name" type="text"
                                    class="form-control txt-r @error('name') is-invalid @enderror" name="UserName"
                                    value="{{ old('name') }}" required placeholder="الإسم" autocomplete="name"
                                    tabindex="1">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <input id="password-confirm" type="password" class="form-control txt-r mt-2"
                                    name="password_confirmation" placeholder="تأكيد كلمة السر" required
                                    autocomplete="new-password" tabindex="4">
                            </div>
                            <div class="col">
                                <input id="password" type="password"
                                    class="form-control txt-r mt-2 @error('password') is-invalid @enderror"
                                    name="password" placeholder="كلمة السر" required autocomplete="new-password"
                                    tabindex="3">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <input id="phone" type="text"
                                    class="form-control txt-r @error('phone') is-invalid @enderror" name="phone"
                                    placeholder="رقم الهاتف" required tabindex="5">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="col-md-6 text-right">
                                <input class="form-control txt-r @error('address') is-invalid @enderror" type="text"
                                    name="address" placeholder="العنوان" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> --}}
                        </div>
                        {{-- <div class="row mt-3">
                            <input class="form-control @error('file') is-invalid @enderror" type="file" name="theFile" required>
                            @error('theFile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}
                        <div class="row">
                            {{-- <div class="col-md-4 form-group mt-3">
                                <select name="department" id="department" class="form-select">
                                    <option value="">Select Department</option>
                                    <option value="Department 1">Department 1</option>
                                    <option value="Department 2">Department 2</option>
                                    <option value="Department 3">Department 3</option>
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-4 form-group mt-3">
                                <select name="doctor" id="doctor" class="form-select">
                                    <option value="">Select Doctor</option>
                                    <option value="Doctor 1">Doctor 1</option>
                                    <option value="Doctor 2">Doctor 2</option>
                                    <option value="Doctor 3">Doctor 3</option>
                                </select>
                                <div class="validate"></div>
                            </div> --}}
                        </div>
                        {{-- <div class="form-group mt-3">
                            <textarea class="form-control txt-r" name="message" rows="5"
                                placeholder="هل لديك أي ملاحظات (اختياري)"></textarea>
                        </div> --}}
                        {{-- <input type="hidden" value="M" id="type" name="type"> --}}

                        <div class="form-group row mb-0 text-center m-3">
                            <div class="col">
                                <button type="submit" class="btn btn-lg btn-success" tabindex="6">
                                    {{ __('اشترك الأن') }}
                                </button>
                            </div>

                        </div>
                        {{-- <div class="text-center"><button type="submit">ارسال الطلب</button></div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    <x-footerOut />
</div>
<script>
    document.querySelector('#name').focus();
</script>
<x-endOut />
