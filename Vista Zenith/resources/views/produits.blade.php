@extends('layouts.base')
@section('content')
    <!-- Recent Sales Start -->
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
    <div class="container-fluid px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Products</h6>
                <div>
                    <a type="button" class="btn btn-dark m-2" data-bs-toggle="modal" data-bs-target="#categoryModal"><i
                            class="fa fa-folder me-2"></i>Categories</a>
                    <a type="button" class="btn btn-dark m-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="fa fa-plus me-2"></i>New Product</a>
                </div>
            </div>

            <!-- Modals -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-light text-start">
                            <form action="{{ route('produits.store') }}" method="post">
                                @csrf
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-light rounded h-100 p-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Category</span>
                                            <select class="form-select @error('category') is-invalid @enderror"
                                                aria-label="Category" name="category">
                                                <option selected disabled>Select a category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->libelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"># Ref</span>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                placeholder="Code" aria-label="Code" aria-describedby="basic-addon1"
                                                name="code" value="{{ old('code') }}">
                                            @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2">Label</span>
                                            <input type="text" class="form-control @error('label') is-invalid @enderror"
                                                placeholder="Label" aria-label="Label" aria-describedby="basic-addon2"
                                                name="label" value="{{ old('label') }}">
                                            @error('label')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">Stock</span>
                                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                                id="basic-url" aria-describedby="basic-addon3" min="1" 
                                                value="{{ old('stock', 1) }}" name="stock">
                                            @error('stock')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Cost Price</span>
                                            <input type="number" step="0.01"
                                                class="form-control @error('cost_price') is-invalid @enderror"
                                                aria-label="Cost Price" value="{{ old('cost_price', 1) }}" min="0" 
                                                name="cost_price">
                                            <span class="input-group-text">.00 FCFA</span>
                                            @error('cost_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Selling Price</span>
                                            <input type="number" step="0.01"
                                                class="form-control @error('selling_price') is-invalid @enderror"
                                                aria-label="Selling Price" value="{{ old('selling_price', 1) }}" min="0" 
                                                name="selling_price">
                                            <span class="input-group-text">.00 FCFA</span>
                                            @error('selling_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Description</span>
                                            <textarea class="form-control @error('description') is-invalid @enderror" aria-label="Description"
                                                name="description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save the product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="categoryModalLabel">Categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-light text-start">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">Label</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->libelle }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning btn-fixed px-1"
                                                        href="">Edit</a>
                                                    <a class="btn btn-sm btn-danger btn-fixed px-1"
                                                        href="">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modals End -->


            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Code</th>
                            <th scope="col">Label</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Cost Price</th>
                            <th scope="col">Selling Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td># {{ $product->code }}</td>
                                <td>{{ $product->libelle }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->prix_achat }} FCFA</td>
                                <td>{{ $product->prix_vente }} FCFA</td>
                                <td>{{ $product->categorie->libelle }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary btn-fixed px-1" href="">Detail</a>
                                    <a class="btn btn-sm btn-warning btn-fixed px-1" href="">Edit</a>
                                    <a class="btn btn-sm btn-danger btn-fixed px-1" href="">Delete</a>
                                </td>
                            </tr>
                            <tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
