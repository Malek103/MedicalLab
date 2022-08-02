<x-headerIn />

<style>
  .container {
    margin-top: 2rem;
  }

  body {
    overflow: auto !important;
  }

</style>

<div class="container text-center">
  @if (Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
      {{ Session::get('message') }}
      <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
    </div>
  @endif


  <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">

    @if ($labs->count())
      @foreach ($labs as $key => $lab)
        <div class="col">
          <div class="card mt-3">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
              <h5 class="card-title">
                <div class="float-right">
                  :اسم المختبر
                </div>
                {{ $lab->LName }}

              </h5>
              <p class="card-text">
              <div class="float-right">
                :عنوان المختبر
              </div>
              {{ $lab->LLocation }}
              </p>
              <p class="card-text">
              <div class="float-right">
                :رقم الهاتف
              </div>
              {{ $lab->LPhone }}
              </p>
              <div class="text-center mt-2">
                <hr>
                <div class="text-center border bottom-1">الوثيقة المرفقة</div>
                <a href="{{ '/downloadDoc/' . $lab->Ldocument }}">
                  <img src="{{ asset('doc/' . $lab->Ldocument) }}" width="100">
                </a>


              </div>
              @if ($lab->status == 0)
                <a href="/labs/{{ $lab->LID }}/ActiveStatus" class="btn btn-success px-4 mt-3">تفعيل</a>
                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">رفض الطلب</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="model{{ $key }}" aria-hidden="true">

                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="model{{ $key }}">نموذج الرفض</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="/labRefused/{{ $lab->LID }}">
                          @csrf
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">رسالة الرفض:</label>
                            <textarea class="form-control" id="messagetext" name="messagetext"></textarea>
                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">أغلق</button>
                        <button type="submit" class="btn btn-success">ارسل سبب الرفض</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              @elseif ($lab->status == 3)
                <div class="alert alert-danger show mt-2 text-center" role="alert">
                  تم رفض هذا الطلب
                </div>

              @else

                <a href="/labs/{{ $lab->LID }}/unActiveStatus" class="btn btn-danger px-4 mt-3">الغاء </a>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    @endif


  </div>
</div>
<x-footerOut />
<x-endIn />
