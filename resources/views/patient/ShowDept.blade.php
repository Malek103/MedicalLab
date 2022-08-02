<x-headerIn />

<div class="container-fluid">
  <div class="row">
    {{-- Side Bar In --}}
    <div id="sideBarMenu" class="side collapse bg-white d-md-block col-md-3 sidebar">
      <div class="flex-shrink-0 p-3">
        <ul class="list-unstyled ps-0">
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
              الفحوصات
            </button>
            <div class="collapse show" id="home-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

                <li> <a class="link-dark rounded" href="{{ '/patient/dash' }}">عرض الفحوصات
                  </a></li>
              </ul>
            </div>

          </li>

        </ul>

      </div>
      <div class="flex-shrink-0 p-3">
       <ul class="list-unstyled ps-0">
         <li class="mb-1">
           <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
            ادارة الديون
           </button>
           <div class="collapse show" id="home-collapse">
             <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

               <li> <a class="link-dark rounded" href="{{ '/patient/Debt' }}">عرض الديون
                 </a></li>
             </ul>
           </div>

         </li>

       </ul>

     </div>

    </div>

    <div id="main" class="col-md-9">
      <div class="justify-content-md-center">

        <div class="container text-center">
          @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('message') }}
            </div>
          @endif
          <div class="card text-center m-3">
              <div class="col-6 text-right">
                <h4 class="float-right">&nbsp;&nbsp;&nbsp;:اجمالي سعر الفحوصات</h4>
                &nbsp;
                <b>{{ $EXprice }}</b>
              </div>
              <div class="col-6 text-right">
                <h4 class="float-right">&nbsp;&nbsp;&nbsp;:اجمالي السعر المدفوع لفحوصات</h4>
                &nbsp;
                <b> {{ $EXamount }}</b>
              </div>
              <div class="col-6 text-right">
                <h4 class="float-right">&nbsp;&nbsp;&nbsp;:اجمالي المدفوعات</h4>
                &nbsp;
                <b>{{ $payment }}</b>
              </div>
              <div class="col-6 text-right">
                <h4 class="float-right">&nbsp;&nbsp;&nbsp;:صافي المبلغ</h4>
                &nbsp;
                <b>{{ $EXamount +$payment -$EXprice}}</b>
              </div>
              <div class=" text-center">
                <a href="{{ url()->previous() }}" class="btn btn-outline-dark w-25" tabindex="5">رجوع</a>
              </div>

          </div>

        </div>

      </div>

    </div>


  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('js/sidebars.js') }}"></script>
</body>

</html>
