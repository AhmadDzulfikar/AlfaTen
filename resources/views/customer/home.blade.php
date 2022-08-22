@extends('layouts.app')

@section('navbar')
    @php $page = "Home"; @endphp
    @include('layouts.nav.customer')
@endsection

@section('content')
    <div class="container">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

            <div class="row justify-content-center">
                @foreach ($categories as $key => $category)
                    <div class="col-md-12 mb-3" data-key="{{ $key }}">
                        <div class="card">
                            <div class="card-header">{{ $category->name }}</div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($category->products as $index => $product)
                                        <div class="col col-2" data-key="{{ $index }}">
                                            <div class="card">
                                                <img src="{{ $product->thumbnail }}" />
                                            </div>
                                            <div class="card-body">
                                                {{ $product->name }}
                                                <br>
                                                {!! $product->new_price !== $product->price ? "<s> $product->price <s>" : $product->price !!}
                                                <br>
                                                {{ $product->new_price !== $product->price ?  $product->new_price : "" }}

                                                <h5>{{ $product->name }}</h5>
                                                {!! $product->price !!}
                                                <div class="d-grid gap-2">
                                                    {{-- Button trigger modal --}}
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#detail-{{ $product->id }}">
                                                        Detail
                                                    </button>

                                                    {{-- modal --}}
                                                    <!-- Button trigger modal -->
                                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                        Launch demo modal
                                                    </button> --}}

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="detail-{{ $product->id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                        Product #{{ $product->id }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="{{ route('customer.addToCart') }}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        Nama Produk: {{ $product->name }}<br>
                                                                        Harga: {{ $product->price }}
                                                                        <br>
                                                                        Jumlah Beli: <input type="number"
                                                                            class="form-control" name="quantity">
                                                                        <input type="hidden" value="{{ $product->id }}"
                                                                            name="product_id">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Add
                                                                            To Cart</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                </div>
                @endforeach
            </div>
    </div>
    </div>
    </div>
    @endforeach
    </div>
    </div>
@endsection
