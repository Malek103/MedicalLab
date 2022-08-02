<x-app-layout>

    @section('sectionTitle')

    @endsection
    @section('content')


    <div class="container me-5">
        <div class="justify-content-md-center">

            <form method="POST" action="{{ route('CreateTech') }}" class="form-group p-3 mt-5 pt-1">
                {{ method_field('POST') }}
                @csrf

                <input type="text" class="form-control text-right @error('UserName')
        is-invalid
        @enderror" value="{{ old('UserName') }}" id="UserName" name="UserName" placeholder="اسم فني المختبر" required>
                @error('UserName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="text" class="form-control text-right mt-3 @error('email')
                    is-invalid
                    @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="الايميل" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input id="password" type="password" name="password"
                    class="form-control text-right mt-3 @error('password') is-invalid @enderror" name="password"
                    placeholder="كلمة السر">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror



                <input type="text" class="form-control mt-3 text-right @error('phone')
    is-invalid
    @enderror" value="{{ old('phone') }}" id="phone" name="phone" placeholder="الهاتف ">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <input type="text" class="form-control mt-3 text-right @error('address')
    is-invalid
    @enderror" value="{{ old('address') }}" id="address" name="address" placeholder="العنوان">
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>

                </span>
                @enderror
                <input type="hidden" value="T" id="type" name="type">
                <div class="mt-5 mr-5 py-3">
                    <button type="submit" class="btn btn-primary w-25">انشاء فني </button>
                    <a href="#" class="btn btn-outline-dark w-25 mx-2">الرجوع</a>
                </div>

            </form>

        </div>
    </div>
    @endsection
</x-app-layout>
