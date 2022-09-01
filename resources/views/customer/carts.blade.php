@extends('layouts.app')

@section('navbar')
    @php $page = "carts"; @endphp
    @include('layouts.nav.customer')
@endsection

@section('content')
    <div class="ms-3 me-3">

        <div class="row">

            <div class="col-12 col-md-9">

                <div class="row">

                    @foreach ($carts as $cart)
                        <div class="col-12 col-md-3">

                            <div class="card mb-4">
                                <div class="card-header text-center">
                                    <img src="/storage/products/{{ $cart->product->thumbnail }}" class="card-img w-100"
                                        height="150px">
                                </div>
                                <div class="card-body">
                                    {{ $cart->product->name }}

                                    {{ $cart->product->new_price !== $cart->product->price ? $cart->product->new_price : '' }}

                                    <br>
                                    {{-- Button trigger modal --}}
                                    <button type="button" class="btn shadow btn-outline-warning btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#editQty-{{ $cart->id }}">
                                        Edit
                                    </button>

                                    <button type="button" class="btn shadow btn-outline-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#delete{{ $cart->id }}">
                                        Delete
                                    </button>


                                    {{-- modal edit --}}
                                    <div class="modal fade" id="editQty-{{ $cart->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('customer.editCart') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <img src="{{ asset('/storage/products/' . $cart->product->thumbnail) }}"
                                                                alt="{{ $cart->product->thumbnail }}" class="card-img"
                                                                height="100%" width="100%">
                                                        </div>
                                                        <h4><strong>{{ $cart->product->name }}</strong></h4>
                                                        <div class="mt-3 mb-3">
                                                            {{ $cart->product->desc }}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6 col-md-6">
                                                                <div>
                                                                    <span>Rp.
                                                                        {{ $cart->product->new_price !== $cart->product->price ? $cart->product->new_price : '' }}</span>
                                                                    <span>{!! $cart->product->new_price !== $cart->product->price ? " {$cart->product->price}" : $cart->product->price !!}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-md-6">
                                                                <div class="d-flex justify-content-end mt-1">

                                                                    <h6 class="mt-1" style="font-size:18px;">Jumlah: </h6>
                                                                    <input min="1" type="number"
                                                                        class="form-control ms-3 w-50   h-25 text-center input-sm"
                                                                        name="quantity" value="{{ $cart->quantity }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $cart->product->id }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit To
                                                            Chart</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- tutup modal edit --}}

                                    {{-- DELETE --}}
                                    <div class="modal fade" id="delete{{ $cart->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action={{ route('customer.carts.delete', $cart->id) }} method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <center class="mt-3">
                                                            <h5>
                                                                apakah anda yakin ingin menghapus data ini?
                                                            </h5>
                                                        </center>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger">Hapus!</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- DELETE --}}

                                    <!-- Modal -->


                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>
            <div class="col-3 col-md-3">
                <div class="card">

                    <div class="card-header">
                        <h6>Total Harga</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-5 col-md-5">
                                <div class="text-start">
                                    <span>Name</span>
                                </div>
                            </div>
                            <div class="col-2 col-md-2">
                                <div class="text-start">
                                    <span>Qty</span>
                                </div>
                            </div>
                            <div class="col-5 col-md-5">
                                <div class="text-start">
                                    <span>Price</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @foreach ($carts as $cart)
                            <div class="row">

                                <div class="col-5 col-md-5">
                                    <div class="text-start">
                                        <span style="font-size:14px">{{ $cart->product->name }}</span>
                                    </div>
                                </div>
                                <div class="col-2 col-md-2">
                                    <div class="text-start">
                                        <span style="font-size:14px">x {{ $cart->quantity }}</span>
                                    </div>
                                </div>
                                <div class="col-5 col-md-5">
                                    <div class="text-start">
                                        <span style="font-size:14px">Rp. {{ $cart->product->price }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-end">
                                    Total Harga
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <span style="font-size:14px">Rp. {{ $total_harga }}</span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
