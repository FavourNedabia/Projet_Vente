@extends('layouts.base')
@section('content')
    <style>
        .custom-select-multiple {
            height: 70px;
        }
    </style>
    <div class="w-100 pt-2 px-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Selling details</h6>
                {{-- <a type="button" class="btn btn-dark m-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="fa fa-plus me-2"></i>Add Product</a> --}}

            </div>
            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-8 text-start">
                        <form action="{{ route('ventes.next') }}" method="post">
                            @csrf
                            <div class="col-sm-12 col-xl-12">
                                <div class="bg-light rounded h-100 p-4">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">Products</span>
                                        <select class="form-select custom-select-multiple @error('products') is-invalid @enderror"
                                            aria-label="Products" name="products[]" multiple required>
                                            <option selected disabled>Select products</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ in_array($product->id, old('products', [])) ? 'selected' : '' }}>
                                                    {{ $product->libelle }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('products')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">Client</span>
                                        <select class="form-select @error('client') is-invalid @enderror"
                                            aria-label="Client" name="client" required>
                                            <option selected value="0">Select a client if it already exists</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}"
                                                    {{ old('client') == $client->id ? 'selected' : '' }}>
                                                    {{ $client->prenoms }} {{ $client->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <a type="button" href="#" class="btn btn-primary input-group-text"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">Or New</a>
            
                                        @error('client')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer mb-4">
                                <button type="button" class="btn btn-warning" onclick="history.back()">Go Back</button>
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
            
                            <!-- Modals -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New client</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-light text-start">
                                            <form action="{{ route('produits.store') }}" method="post">
                                                @csrf
                                                <div class="col-sm-12 col-xl-12">
                                                    <div class="bg-light rounded h-100 p-4">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">First
                                                                Name</span>
                                                            <input type="text"
                                                                class="form-control @error('firstname') is-invalid @enderror"
                                                                placeholder="First Name" aria-label="First Name"
                                                                aria-describedby="basic-addon1" name="firstname"
                                                                value="{{ old('firstname') }}">
                                                            @error('firstname')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon2">Last
                                                                Name</span>
                                                            <input type="text"
                                                                class="form-control @error('lastname') is-invalid @enderror"
                                                                placeholder="Last Name" aria-label="Last Name"
                                                                aria-describedby="basic-addon2" name="lastname"
                                                                value="{{ old('lastname') }}">
                                                            @error('lastname')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon3">Phone</span>
                                                            <input type="text"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                id="basic-url" aria-describedby="basic-addon3"
                                                                value="{{ old('phone') }}" name="phone">
                                                            @error('phone')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">Address</span>
                                                            <input type="text"
                                                                class="form-control @error('address') is-invalid @enderror"
                                                                aria-label="Address" value="{{ old('address') }}"
                                                                name="address">
                                                            @error('address')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-bs-dismiss="modal"  class="btn btn-primary">Save the
                                                        client</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modals End -->
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Blank End -->

        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
