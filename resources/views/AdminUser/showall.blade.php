<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<form class="form-inline " action="{{ route('Search.Manager') }}" method="GET">
  <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Manager Name</th>
        <th scope="col">Manager Phone</th>

      </tr>
    </thead>
    <tbody>
      @foreach ($mangerusers as $key => $mangeruser)
        <tr>
          <th scope="row">{{ $key + 1 }}</th>
          <td><a href="getaccount/{{ $mangeruser->MID }}">{{ $mangeruser->MName }}</a></td>
          <td>{{ $mangeruser->MPhone }}</td>

        </tr>
      @endforeach

    </tbody>
  </table>
</div>
