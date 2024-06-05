@extends('layouts.base')

@section('content')
    <style>
        .custom-select-multiple {
            height: 70px;
        }

        .badge-status {
            font-size: 1em;
        }

        .badge-client {
            font-size: 1em;
            padding: 10px;/
            border-radius: 5px;
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
            <div class="container-fluid pt-4 ">
                <div class="row bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-12 text-start">
                        <div class="bg-light rounded">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <span class="badge badge-client  bg-secondary ">
                                        <i class="fa fa-address-card me-2"></i>
                                        {{ $client->prenoms }} {{ $client->nom }} {{ $client->telephone }}
                                    </span>
                                </div>
                            </div>
                            <table class="table table-dark mt-4">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Article & Price</th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Remaining</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach ($ventes as $vente)
                                        @php
                                            $totalPrice += $vente->reste;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $vente->created_at->format('d M Y \a\t h:i A') }}</th>
                                            <td>
                                                @foreach ($vente->ligneVente as $ligne)
                                                    {{ $ligne->quantite }} x {{ $ligne->article->libelle }}
                                                    ({{ $ligne->montant }} FCFA)
                                                    <br>
                                                @endforeach
                                            </td>
                                            <td>{{ $vente->personnel->prenoms }} {{ $vente->personnel->nom }}</td>
                                            <td>{{ $vente->total }} FCFA</td>
                                            <td>
                                                <span
                                                    class="badge badge-status 
                                                    @if ($vente->status == 'Paid') bg-success 
                                                    @elseif ($vente->status == 'Credit') bg-danger 
                                                    @elseif ($vente->status == 'Paid partially') bg-warning @endif">
                                                    {{ $vente->status }}
                                                </span>
                                            </td>
                                            <td>{{ $vente->reste }} FCFA</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary btn-fixed px-1" href="{{ route('ventes.details', ['id' => $vente->id]) }}">Detail</a>
                                                <a class="btn btn-sm btn-warning btn-fixed px-1" href="">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row" colspan="5">Total:</th>
                                        <td scope="row" colspan="2">{{ $totalPrice }} FCFA</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="modal-footer mb-4">
                                <button type="button" class="btn btn-warning" onclick="history.back()">Go
                                    Back</button>
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
