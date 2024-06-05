@extends('layouts.base')

@section('content')
    <style>
        .custom-select-multiple {
            height: 70px;
        }
        .badge-status {
            font-size: 1em;
        }
    </style>
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
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Selling Details</h6>
            </div>
            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-12 text-start">
                        <div class="bg-light rounded p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Seller</h4>
                                    <p><strong>First Name:</strong> {{ $sale->personnel->nom }}</p>
                                    <p><strong>Last Name:</strong> {{ $sale->personnel->prenoms }}</p>
                                    <p><strong>Phone:</strong> {{ $sale->personnel->telephone }}</p>
                                    <p><strong>Address:</strong> {{ $sale->personnel->adresse }}</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <h4>Customer</h4>
                                    <p><strong>First Name:</strong> {{ $sale->client->nom }}</p>
                                    <p><strong>Last Name:</strong> {{ $sale->client->prenoms }}</p>
                                    <p><strong>Phone:</strong> {{ $sale->client->telephone }}</p>
                                    <p><strong>Address:</strong> {{ $sale->client->adresse }}</p>
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
                                    @foreach ($sale->ligneVente as $index => $ligneVente)
                                        @php
                                            $product = $ligneVente->article;
                                            $totalPrice += $ligneVente->montant;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $product->libelle }}</td>
                                            <td>{{ $product->prix_vente }} FCFA</td>
                                            <td>{{ $ligneVente->quantite }}</td>
                                            <td>{{ $ligneVente->montant }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row" colspan="4">Total:</th>
                                        <td>{{ $totalPrice }} FCFA</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <p><strong>Payment Status:</strong>
                                        <span class="badge badge-status @if($sale->status == 'Paid') bg-success @elseif($sale->status == 'Credit') bg-danger @elseif($sale->status == 'Paid partially') bg-warning @endif">
                                            {{ $sale->status }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <p><strong>Remaining Amount:</strong>
                                        <span class="badge badge-status bg-danger">
                                            {{ $sale->reste }} FCFA
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer mb-4">
                                <a type="button" class="btn btn-warning" href="{{ route('ventes') }}">Go Back</a>
                                <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blank End -->
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
