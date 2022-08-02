<x-app-layout>
    @section('sectionTitle')
    @endsection
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- @if (Auth::user()->type === 'A')
                    @if(session()->has('message'))
                    <div class="alert alert-success text-center" role="alert">

                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <x-tableNotAuthM />
                    @else
                    @foreach (DB::table('users')->where('status', 1)->get()
                    as $User)



                    @endforeach
                    @endif --}}

                    {{-- @if (Auth::user()->type === 'M' && Auth::user()->status === '1') --}}


                    {{-- @elseif(Auth::user()->type === 'M' && Auth::user()->status === '0')
                    <div class="h1 text-danger text-center">
                        <h1>الرجاء انتظار موافقة المسؤول</h1>

                    </div>
                    @else
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
