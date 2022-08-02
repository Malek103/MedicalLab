<x-headerIn />
<style>
  .container {
    margin-top: 2rem;
  }

</style>

<div class="container text-center">
  <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">

    @if ($labs->count())
      @foreach ($labs as $lab)
        <div class="col">
          <div class="card">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
              <h5 class="card-title">{{ $lab->LName }}</h5>
              <p class="card-text">{{ $lab->LLocation }}</p>
              @if ($lab->status == 1)
                <a href="{{ 'dashboardHome/' . $lab->LID }}" class="btn btn-primary">الذهاب الى المختبر</a>
              @else
                <p class="alert alert-danger">لم يتم تفعيل المختبر بعد</p>
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
