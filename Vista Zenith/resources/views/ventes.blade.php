@extends('layouts.base')
@section('content')
    </style>
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Sales</h6>
                <a type="button" href="{{ route('ventes.init') }}" class="btn btn-dark m-2"><i
                        class="fa fa-plus me-2"></i>Sell</a>

            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col"><input class="form-check-input" type="checkbox"></th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Remaining</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventes as $index => $vente)
                            <tr>
                                <td> {{ $index + 1 }} </td>
                                <td> {{ $vente->created_at->format('d M Y \a\t h:i A') }} </td>
                                <td> {{ $vente->client->prenoms }} {{ $vente->client->nom }} </td>
                                <td> {{ $vente->total }} </td>
                                <td> {{ $vente->status }} </td>
                                <td> {{ $vente->reste }} </td>
                                <td>
                                    <a class="btn btn-sm btn-primary btn-fixed px-1" href="">Detail</a>
                                    <a class="btn btn-sm btn-warning btn-fixed px-1" href="">Edit</a>
                                    <a class="btn btn-sm btn-danger btn-fixed px-1" href="">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
