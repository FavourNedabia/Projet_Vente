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
                <h6 class="mb-0">Selling details</h6>
            </div>
            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-8 text-start">
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-light rounded h-100 p-4">
                                <form action="{{ route('ventes.overview') }}" method="post">
                                    @csrf
                                    <h6 class="">Define quantities</h6>
                                    <div class="col-sm-12 col-xl-8 mb-4">
                                        <div class="bg-light rounded px-2">
                                            @foreach ($validatedData['products'] as $productId)
                                                <div class="input-group mt-1">
                                                    <span class="input-group-text">
                                                        {{ $products->where('id', $productId)->first()->libelle }}
                                                    </span>
                                                    <input class="form-control form-control-sm" type="number"
                                                        name="quantities[{{ $productId }}]" value="1" required min="1">
                                                    <span class="input-group-text">
                                                        {{ $products->where('id', $productId)->first()->prix_vente }}
                                                    </span>
                                                    @error('client')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" name="client" value="{{ $client->id }}">
                                    @if ($client->id == 0)
                                        <input type="hidden" name="firstname" value="{{ $client->firstname }}">
                                        <input type="hidden" name="lastname" value="{{ $client->lastname }}">
                                        <input type="hidden" name="phone" value="{{ $client->phone }}">
                                        <input type="hidden" name="address" value="{{ $client->address }}">
                                    @endif
                                    <div class="modal-footer mb-4">
                                        <button type="button" class="btn btn-warning" onclick="history.back()">Go
                                            Back</button>
                                        <button type="submit" class="btn btn-primary">Overview</button>
                                    </div>
                                </form>
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
