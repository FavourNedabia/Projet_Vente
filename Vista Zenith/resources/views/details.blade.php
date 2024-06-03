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
                                    <h4>Company</h4>
                                    <p><strong>Company Name:</strong> Example Company</p>
                                    <p><strong>Address:</strong> 123 Main Street, City, Country</p>
                                    <p><strong>Phone:</strong> (123) 456-7890</p>
                                    <p><strong>Email:</strong> contact@example.com</p>
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
                                        <span class="badge badge-status @if($sale->status == 'Paid') bg-success @elseif($sale->status == 'Credit') bg-warning @elseif($sale->status == 'Paid partially') bg-info @endif">
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
                                <button type="button" class="btn btn-warning" onclick="history.back()">Go Back</button>
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
