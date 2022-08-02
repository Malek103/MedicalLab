<x-app-layout>
    @section('sectionTitle')

    @endsection
    @section('content')

<div class="container me-5">
    <div class="justify-content-md-center">
        <div class="container text-center">
            @if(Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
            @endif

        <form method="POST" action="{{ route('CreatePatient') }}" class="form-group p-3 mt-5 pt-1">
            {{ method_field('POST') }}
            @csrf
            <div class="form-group row my-2">
                <div class="col-md-6">
                    <input type="text" class="form-control text-right mt-3 @error('PID')
                             is-invalid
                         @enderror" value="{{ old('PID') }}" id="PID" name="PID" placeholder="رقم هوية المريض"
                        required>
                    @error('PID')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control text-right mt-3 @error('UserName')
                    is-invalid
                    @enderror" value="{{ old('UserName') }}" id="UserName" name="UserName" placeholder="اسم المريض"
                        required>
                    @error('UserName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row my-2">
                <div class="col-md-6">
                    <input type="password" class="form-control text-right mt-3 @error('password')
                             is-invalid
                         @enderror" value="{{ old('password') }}" id="password" name="password" placeholder="كلمة السر"
                        required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control text-right mt-3 @error('email')
                    is-invalid
                    @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="الايميل" required
                        autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row my-2">
                <div class="col-md-6">
                    <input type="text" class="form-control text-right mt-3 @error('address')
                             is-invalid
                         @enderror" value="{{ old('address') }}" id="address" name="address" placeholder="العنوان"
                        required>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control text-right mt-3 @error('phone')
                    is-invalid
                    @enderror" value="{{ old('phone') }}" id="phone" name="phone" placeholder="الهاتف" required>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row my-4">
                <div class="col-md-4">

                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" class="form-control @error('birth_date')
                    is-invalid
                    @enderror" required>
                    @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-2 txt-r text-right">
                    <label for="birth_date" class="text-secondary">تاريخ الميلاد</label>
                </div>

                <div class="col-md-6">
                    <select name="gender" id="gender" class="form-control custom-select text-right">
                        <option value="male" selected>ذكر</option>
                        <option value="female">انثى</option>
                    </select>
                </div>
            </div>
            <input type="hidden" value="P" id="type" name="type">
            <div class="mt-5 mr-5 py-3">
                <button type="submit" class="btn btn-primary w-25">انشاء مريض </button>
                <a href="/" class="btn btn-outline-dark w-25 mx-2">الرجوع</a>
            </div>

        </form>

    </div>
</div>

@endsection
</x-app-layout>
