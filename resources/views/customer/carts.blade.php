@extends('layouts.app')

@section('navbar')
    @php $page = "carts"; @endphp
    @include('layouts.nav.customer')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card mb-3">
                    @if ($carts->count() < 1)
                        <div class="row text-center">
                            <div class="col">
                                <p>NOT YET AN ORDER</p>
                            </div>
                        </div>
                    @else
                        @foreach ($carts as $d)
                            <div class="row g-0">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('/storage/products/' . $d->product->thumbnail) }}"
                                        class="img-fluid rounded-start " alt="..." height="100px" width="100px">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $d->product->name }}</h5>
                                        <p class="card-text">Rp.{{ $d->product->price }}</p>
                                        <p class="card-text">Qty : {{ $d->qty }}</p>
                                        <a href="" class="btn btn-primary">detail</a>
                                        <a href="" class="btn btn-warning">edit</a>
                                        <a href="{{ url('/customer/carts/delete/' . $d->product_id) }}"
                                            class="btn btn-danger">delete</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Transaction</h5>
                        @if ($carts->count() < 1)
                            <p class="text-center mt-4">NO YET TRANSACTION</p>
                        @else
                            <div class="row">
                                @foreach ($carts as $item)
                                    <div class="col-6">
                                        {{ $item->product->name }} x {{ $item->qty }}
                                    </div>
                                    <div class="col-6">
                                        Rp.{{ $item->qty * $item->product->price }}
                                    </div>
                                @endforeach
                            </div>
                            <hr class="divider">
                            <div class="row justify-content-between">
                                <div class="col float-start">
                                    <p class="card-text"><strong>Total</strong></p>
                                </div>
                                <div class="col float-end">{{ $total_harga }}</div>
                            </div>
                        @endif
                        {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                        <form action="">
                            <div class="row">
                                <button class="btn btn-success mt-3" type="submit"
                                    {{ $carts->count() < 1 ? 'disabled' : '' }}>Checkout!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
