<x-headerIn />

<div class="container mt-5 ">

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        &times;</button>
                </div>
            @endif
            <div class="card">
                <div class="card-header text-center">نموذج اعادة تعين كلمة السر</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf

                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password"
                                    autocomplete="current-password">
                            </div>
                            <label for="password" class="col-md-4 col-form-label text-md-right">كلمة السر
                                الحالية</label>


                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password"
                                    autocomplete="current-password">
                            </div>
                            <label for="password" class="col-md-4 col-form-label text-md-right">كلمة السر
                                الجديدة</label>


                        </div>

                        <div class="form-group row">


                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control"
                                    name="new_confirm_password" autocomplete="current-password">
                            </div>
                            <label for="password" class="col-md-4 col-form-label text-md-right">تأكيد كلمة السر</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    تعديل كلمة السر
                                </button>
                                @if (Auth::user()->type == 'P')
                                    <a tabindex="8" href='/patient/dash'
                                        class="btn btn-outline-dark w-25 mx-2">الرجوع</a>
                                @elseif (Auth::user()->type == 'M')
                                    <a tabindex="8" href='/dashboard' class="btn btn-outline-dark w-25 mx-2">الرجوع</a>
                                @elseif(Auth::user()->type == 'A')
                                    <a tabindex="8" href='/adminPanel' class="btn btn-outline-dark w-25 mx-2">الرجوع</a>
                                @elseif(Auth::user()->type == 'T')
                                    <a tabindex="8" href='/tech/dash' class="btn btn-outline-dark w-25 mx-2">الرجوع</a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
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

</body>

</html>
