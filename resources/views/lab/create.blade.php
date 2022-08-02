<x-headerIn />

<div class="container me-5">
    <div class="justify-content-md-center">

        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        <form method="POST" action="" class="form-group p-3 mt-5 pt-1" enctype="multipart/form-data">
            {{ method_field('POST') }}
            @csrf

            <div class="form-group row my-2">
                <div class="col">
                    <input type="text"
                        class="form-control text-right mt-3 @error('address')
                    is-invalid
                    @enderror"
                        value="{{ old('address') }}" id="address" name="address" placeholder="عنوان المختبر"
                        tabindex="2" required>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col">
                    <input type="text"
                        class="form-control text-right mt-3 @error('name')
                             is-invalid
                         @enderror"
                        value="{{ old('name') }}" id="name" name="name" placeholder="اسم المختبر" tabindex="1"
                        required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>
            <div class="row mt-3">
                <div class="col">
                    <input type="text"
                        class="form-control text-right @error('phone')
              is-invalid
              @enderror"
                        :value="old('phone')" id="phone" name="phone" placeholder="رقم الهاتف" tabindex="3">
                </div>
            </div>

                <div class="row mt-3 mx1 text-right">
                 <label for="file" class="text-right">وثيقة الترخيص</label>
                    <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file"
                    tabindex="4" required>
                  @error('theFile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
            <input type="hidden" value="L" id="type" name="type">
            <div class="mt-5 py-3 text-right">
                <a href="/dashboard" class="btn btn-outline-dark w-25 mx-2" tabindex="6">الرجوع</a>
                <button type="submit" class="btn btn-success w-25" tabindex="5">انشاء مختبر </button>

            </div>

        </form>
        <script>
            document.querySelector('#name').focus();
        </script>
        <x-endIn />
