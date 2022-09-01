@extends('layouts.app')

@section('navbar')
    @php $page = "carts"; @endphp
    @include('layouts.nav.customer')
@endsection

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                {{ $transactions[0]->update_at }}
            </div>
        </div>
    </div>
<div>
        <p id="countdown"></p>
    </div>
@endsection

@push('scripts')
    <script>
        let date = new Date();
        let jam = date.getHours();
        let menit = date.getMinutes();
        let detik = date.getSeconds();

        let waktu = jam + ":" + menit + ":" + detik;

        setInterval(() => {
            document.getElementById('countdown').innerText = waktu;
        }, interval);
    </script>
@endpush
