@extends('layouts.base')
@section('content')
    <style>
        .btn-fixed {
            width: 55px;
        }

        .card-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 45px;
            border-radius: 50%;
            background-color: white;
            margin: auto;
        }

        .icon {
            font-size: 30px;
            color: #333;
        }
    </style>
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Sale</p>
                        <h6 class="mb-0">{{ $totalSalesToday }} FCFA</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Payement</p>
                        <h6 class="mb-0">{{ $totalPaymentsToday }} FCFA</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Remaining</p>
                        <h6 class="mb-0">{{ $totalRemainingToday }} FCFA</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Remaining</p>
                        <h6 class="mb-0">{{ $totalRemaining }} FCFA</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->


    <!-- Sales Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Salse & Revenue</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="salse-revenue"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Worldwide Sales</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="worldwide-sales"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Chart End -->


    <div class="container-fluid pt-4 px-4">

        <!-- Recent Sales Start -->
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Salse</h6>
                <a href=" {{ route('ventes') }} ">Show All</a>
            </div>
            <div class="table-responsive">
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
                                    <td> {{ $vente->created_at->diffForHumans() }} </td>
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


        <!-- Widgets Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0">Last week's Best Sellers</h6>
                            <a href="">Show All</a>
                        </div>
                        @foreach ($topSellers as $seller)
                            <div class="d-flex align-items-center pt-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                                    style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">{{ $seller->personnel->prenoms }} {{ $seller->personnel->nom }}
                                        </h6>
                                        <small>{{ $seller->personnel->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th scope="col">Sales</th>
                                                    <th scope="col">Net</th>
                                                    <th scope="col">Remaining</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> {{ number_format($seller->total_sales, 0, ',', ' ') }}</td>
                                                    <td> {{ number_format($seller->net_sales, 0, ',', ' ') }}</td>
                                                    <td> {{ number_format($seller->total_remaining, 0, ',', ' ') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0">Best Selling Items</h6>
                            <a href="">Show All</a>
                        </div>
                        @foreach ($topProducts as $product)
                            <div class="d-flex align-items-center border-bottom py-3">

                                <div class="card-circle">
                                    <i class="fa fa-beer icon"></i>
                                </div>
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">{{ $product->article->libelle }}</h6>
                                        <small>{{ $product->total_quantity }} sales</small>
                                    </div>
                                    <span>{{ number_format($product->total_sales, 0, ',', ' ') }} FCFA</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Anomaly</h6>
                            <a href="">Show All</a>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">

                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span><del>Short task goes here...</del></span>
                                    <button class="btn btn-sm text-primary"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">

                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center pt-2">

                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widgets End -->
    @endsection
