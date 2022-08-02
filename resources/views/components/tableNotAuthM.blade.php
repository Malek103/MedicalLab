
<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">اسم المختبر</th>
            <th scope="col">الأيميل</th>
            <th scope="col">الحالة </th>
            <th scope="col">تفعيل </th>
        </tr>
    </thead>
    <tbody>
        {{-- searth --}}
        @if(isset($_POST['search']))
        {{-- valid --}}
        @if(isset($_POST['valid']))
        {{-- if valid = unvalid --}}
        @if($_POST['valid'] == 'unvalid')
        @foreach (DB::select('select * from users where (UserName like "%' + $search + '%" or email like "%' + $search +
        '%") and status = 0') as $User)
        {{-- if valid = valid --}}
        @elseif($_POST['valid'] == 'valid')
        @foreach (DB::select('select * from users where (UserName like "%' + $search + '%" or email like "%' + $search +
        '%") and status = 1') as $User)
        {{-- if all --}}
        @else
        @foreach (DB::select('select * from users where UserName like "%' + $search + '%" or email like "%' + $search +

        '%"') as $User)

        {{-- end all --}}
        @endif
        {{-- end of valid --}}
        @endif

        <tr>
            <td scope="row">{{ $User->id }}</td>
            <td>{{ $User->UserName }}</td>
            <td>{{ $User->email }}</td>
            <td>
                @if($User->status == 0)
                <span class="text-danger">غير مفعل</span>
                @else
                <span class="text-primary">فعال</span>
                @endif

            </td>
            @if($User->status == 0)
            <td><a href=" user/{{ $User->id }}/update" class="btn btn-success">فعل</a></td>
            @else
            <td><a href=" user/{{ $User->id }}/update" class="btn btn-danger">الغاء التفعيل</a></td>
        </tr>


        @endforeach


        @else

        @if ($_POST['valid'] == 'unvalid')
        @foreach (DB::select('select * from users where status = 0') as $User)
        @elseif($_POST['valid'] == 'valid')

        @foreach (DB::select('select * from users where status = 1') as $User)
        @else
        @foreach (DB::select('select * from users') as $User)
        @endif

        <tr>
            <td scope="row">{{ $User->id }}</td>
            <td>{{ $User->UserName }}</td>
            <td>{{ $User->email }}</td>
            <td>
                @if($User->status == 0)
                <span class="text-danger">غير مفعل</span>
                @else
                <span class="text-primary">فعال</span>
                @endif

            </td>
            <td><a href=" user/{{ $User->id }}/update" class="btn btn-success">فعل</a></td>
        </tr>


        @endforeach

        @endif
    </tbody>
</table>
