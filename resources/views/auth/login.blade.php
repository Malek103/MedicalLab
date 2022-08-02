<x-headerOut/>
<style>
.bodycenter{
    margin-bottom: 180px;
    margin-top: 200px;
}
@media (min-width: 768px) {
    .bodycenter{
    margin-bottom: 260px;
}
}
</style>
<x-topBarOut/>
 <x-navbarOut/>
<div class="container bodycenter" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header txt-r">{{ __('تسجيل الدخول') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row my-2">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('ا') }}</label> --}}

                            <div class="col">
                                <input id="email" type="email" class="form-control txt-r @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="الأيميل" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col">
                                <input id="password" type="password" class="form-control txt-r @error('password') is-invalid @enderror" name="password" placeholder="كلمة السر" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('تذكرني') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 my-2">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('تسجيل دخول') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('نسيت كلمة السر ؟') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<x-footerOut/>
<x-endOut />


