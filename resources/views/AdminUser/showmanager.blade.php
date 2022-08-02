<x-headerIn />
{{-- <x-adminNav /> --}}
<div class="container">
     <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">

                    <div class="text-center mt-3">


                        <h5 class="d-block bg-secondary mt-2 p-1 px-2 rounded text-white text-center">
                            <div class="float-right">
                                :الرقم التسلسلي
                            </div>
                            {{ $users->id}}
                        </h5>
                               <h4 class="mt-2 mb-0 text-center">
                                    <div class="float-right">
                                        :الأسم
                                    </div>
                                {{ $managers->MName }}
                        </h4>
                        <h4 class="mt-2 text-center">
                            <div class="float-right">
                                :رقم الهاتف
                            </div>

                            {{ $users->manager->MPhone }}</h4>
                        <h4 class="mt-2">
                            <div class="float-right">
                                :البريد الإلكتروني
                            </div>
                            {{ $users->manager->MAddress }}
                        </h4>
                        <span>{{ $users->email }}</span>
                        <div class="px-4 mt-1">
                            <p class="fonts">{{ $users->manager->message }} </p>
                        </div>

                        <div class="buttons mt-5">
                            <a href="{{ route('adminPanel') }}" class="btn btn-outline-dark px-4">عودة</a>

                            @if($users->status == 0)
                            <td><a href="/user/{{ $users->manager->id }}/update"
                                    class="btn btn-success px-4 ms-3">تفعيل</a></td>
                            @else
                            <td><a href="/user/{{ $users->manager->id }}/updateunactive"
                                    class="btn btn-danger px-4 ms-3">الغاء </a></td>
                            @endif

                            <a href="/LabShow/{{ $users->manager->id }}" class="btn btn-info ml-4">المختبرات</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-endIn />
