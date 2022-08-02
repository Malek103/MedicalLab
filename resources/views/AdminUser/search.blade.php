<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<form class="form-inline " action="{{ route('Search.Manager') }}" method="GET">
  <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Manager Name</th>
      <th scope="col">Manager Phone</th>
    </tr>
  </thead>
  @foreach ($ManagerLabs as $key => $ManagerLab)
    <tr>
      <th scope="row">{{ $key + 1 }}</th>
      <td>{{ $ManagerLab->MName }}</td>
      <td>{{ $ManagerLab->MPhone }}</td>
    </tr>
  @endforeach

  </tbody>
</table>
