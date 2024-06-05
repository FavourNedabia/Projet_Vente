@extends('layouts.base')
@section('content')
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
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Clients Overview</h6>
                <div>
                    <a type="button" class="btn btn-dark m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-plus me-2"></i>New Client
                    </a>
                </div>
            </div>

            <!-- Modals -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-light text-start">
                            <form action="{{ route('clients.store') }}" method="post">
                                @csrf
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-light rounded h-100 p-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">First Name</span>
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
                                            <span class="input-group-text" id="basic-addon2">Last Name</span>
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
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Phone" aria-label="Phone" aria-describedby="basic-addon3"
                                                name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon4">Address</span>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Address" aria-label="Address" aria-describedby="basic-addon4"
                                                name="address" value="{{ old('address') }}">
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Client</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-dark datatable">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Number of Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $index => $client)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $client->prenoms }}</td>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->telephone }}</td>
                                <td>{{ $client->adresse }}</td>
                                <td><a href="{{ route('clients.achats', ['id' => $client->id]) }}">
                                        {{ $client->ventes_count }} sale(s)</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
