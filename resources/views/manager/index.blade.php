<x-headerIn />

<style>
  .container {
    margin-top: 2rem;
  }

  #pointer {
    cursor: pointer;
  }

</style>

<div class="container text-center">
  @if (Session::has('message'))
    <div class="alert alert-success" role="alert">
      {{ Session::get('message') }}
    </div>
  @endif
  <div class="d-flex justify-content-center">
    <a class="btn btn-lg btn-success" href="/lab/create" tabindex="1">انشاء حساب مختبر </a>
  </div>
  <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">

    @if ($labs->count())
      @foreach ($labs as $lab)
        <div class="col">
          <div class="card mt-3">
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
              <hr>
              @if ($lab->status == 1)
                <a href="{{ 'dashboardHome/' . $lab->LID }}" class="btn btn-primary">الذهاب الى
                  المختبر</a>
              @elseif ($lab->status == 3)
                <div class="alert alert-danger show mt-2 text-center" role="alert">
                  <h4 class="d-inline"> تم رفض طلب إنشاء المختبر</h4>
                  <a data-bs-toggle="modal" id="pointer" class="d-inline text-secondary" data-bs-target="#model{{ $lab->LID }}">
                    سبب الرفض
                  </a>
                  <button type="button" class="btn btn-primary btn-block m-2" data-bs-toggle="modal" data-bs-target="#editModel{{ $lab->LID }}" data-bs-whatever="@mdo">تعديل\حذف</button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="model{{ $lab->LID }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">رسالة الرفض</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                        {{ $lab->message }}
                      </div>
                      <div class="modal-footer text-center">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">إغلاق</button>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Edit Model --}}

                <div class="modal fade" id="editModel{{ $lab->LID }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل الطلب</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('labUpdate',  $lab->LID) }}" class="form-group p-3  pt-1" enctype="multipart/form-data">
                          {{ method_field('post') }}
                          @csrf

                          <div class="form-group row my-2">
                            <div class="col">
                              <input type="text" class="form-control text-right mt-3 @error('address')
                    is-invalid
                    @enderror" value="{{ $lab->LLocation }}" id="address" name="address"
                                placeholder="عنوان المختبر" tabindex="2" required>
                              @error('address')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="col">
                              <input type="text" class="form-control text-right mt-3 @error('name')
                             is-invalid
                         @enderror" value="{{ $lab->LName }}" id="name" name="name"
                                placeholder="اسم المختبر" tabindex="1" focus="true" required>
                              @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>

                          </div>
                          <div class="row mt-3">
                            <div class="col">
                              <input type="text" class="form-control text-right @error('phone')
              is-invalid
              @enderror" value="{{ $lab->LPhone }}" id="phone" name="phone" placeholder="رقم الهاتف" tabindex="3">
                            </div>
                          </div>

                          <div class="row mt-3 mx1 text-right">
                            <label for="file" class="text-right">وثيقة الترخيص</label>
                            <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file" tabindex="4" value="{{ $lab->Ldocument }}">
                            @error('theFile')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <input type="hidden" value="L" id="type" name="type">
                          <div class="mt-5 py-3 text-right">
                            <button type="submit" class="btn btn-success form-control" tabindex="5">تعديل الطلب </button>
                        </form>


                        <form class="mt-2 text-right" action="{{ route('labDelete',  $lab->LID) }}" method="POST">
                            @csrf
                            @method("DELETE")
                        <button type="submit" class="btn btn-outline-danger form-control" tabindex="6">حذف</button>
                        </form>

                      </div>



                    </div>
                  </div>
                </div>
            </div>
          @else
            <h5 class="alert alert-warning">لم يتم تفعيل المختبر بعد</h5>
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
