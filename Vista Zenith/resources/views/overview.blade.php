@extends('layouts.base')

@section('content')
    <style>
        .custom-select-multiple {
            height: 70px;
        }
    </style>
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Selling Overview</h6>
            </div>
            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-12 text-start">
                        <form action=" {{ route('ventes.confirm') }} " method="POST">
                            @csrf
                            <div class="bg-light rounded p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Company</h4>
                                        <p><strong>Company Name:</strong> Example Company</p>
                                        <p><strong>Address:</strong> 123 Main Street, City, Country</p>
                                        <p><strong>Phone:</strong> (123) 456-7890</p>
                                        <p><strong>Email:</strong> contact@example.com</p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <h4>Client</h4>
                                        <p><strong>First Name:</strong> {{ $client->prenoms }}</p>
                                        <p><strong>Last Name:</strong> {{ $client->nom }}</p>
                                        <p><strong>Phone:</strong> {{ $client->telephone }}</p>
                                        <p><strong>Address:</strong> {{ $client->adresse }}</p>

                                        <!-- Hidden Client Inputs -->
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                        @if ($client->id == 0)
                                        <input type="hidden" name="client_firstname" value="{{ $client->prenoms }}">
                                        <input type="hidden" name="client_lastname" value="{{ $client->nom }}">
                                        <input type="hidden" name="client_phone" value="{{ $client->telephone }}">
                                        <input type="hidden" name="client_address" value="{{ $client->adresse }}">
                                        @endif
                                    </div>
                                </div>
                                <table class="table table-dark mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">Article</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Number</th>
                                            <th scope="col">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPrice = 0;
                                        @endphp
                                        @foreach ($objects as $index => $object)
                                            @php
                                                $product = $products->where('id', $object->id)->first();
                                                $totalPrice += $object->montant;
                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $product->libelle }}</td>
                                                <td>{{ $product->prix_vente }} FCFA</td>
                                                <td>{{ $object->quantite }}</td>
                                                <td>{{ $object->montant }} FCFA</td>

                                                <!-- Hidden Product Inputs -->
                                                <input type="hidden" name="products[{{ $object->id }}]"
                                                    value="{{ $object->quantite }}">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row" colspan="4">Total:</th>
                                            <td>{{ $totalPrice }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row justify-content-end">
                                    <div class="col-auto">
                                        <div class="input-group mb-4 text-end">
                                            <span class="input-group-text">Payment Status</span>
                                            <select
                                                class="form-select form-select-sm @error('payment') is-invalid @enderror"
                                                aria-label="payment" name="payment" required>
                                                <option value="Paid">Paid</option>
                                                <option value="Credit">Credit</option>
                                                <option value="Paid partially">Paid partially</option>
                                            </select>
                                            @error('payment')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group mb-4 text-end">
                                            <span class="input-group-text">Remaining Amount:</span>
                                            <input type="number" class="form-control form-control-sm" min="0"
                                                value="0" max="{{ $totalPrice }}" name="remain">
                                            @error('remain')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer mb-4">
                                    <button type="button" class="btn btn-warning" onclick="history.back()">Go Back</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Blank End -->
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
