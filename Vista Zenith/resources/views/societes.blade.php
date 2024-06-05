@extends('layouts.base')

@section('styles')
<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />

@endsection

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
                <h6 class="mb-0">Societies Overview</h6>
                <div>
                    <a type="button" class="btn btn-dark m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-plus me-2"></i>Add Society
                    </a>
                </div>
            </div>

            <!-- Modals -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Society</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-light text-start">
                            <form action="{{ route('societes.store') }}" method="post">
                                @csrf
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-light rounded h-100 p-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Name</span>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                                placeholder="Name" aria-label="Name" aria-describedby="basic-addon1"
                                                name="nom" value="{{ old('nom') }}">
                                            @error('nom')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2">Address</span>
                                            <input type="text"
                                                class="form-control @error('adresse') is-invalid @enderror"
                                                placeholder="Address" aria-label="Address" aria-describedby="basic-addon2"
                                                name="adresse" value="{{ old('adresse') }}">
                                            @error('adresse')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">Phone</span>
                                            <input type="text"
                                                class="form-control @error('telephone') is-invalid @enderror"
                                                placeholder="Phone" aria-label="Phone" aria-describedby="basic-addon3"
                                                name="telephone" value="{{ old('telephone') }}">
                                            @error('telephone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon4">Postal Code</span>
                                            <input type="text"
                                                class="form-control @error('code_postal') is-invalid @enderror"
                                                placeholder="Postal Code" aria-label="Postal Code"
                                                aria-describedby="basic-addon4" name="code_postal"
                                                value="{{ old('code_postal') }}">
                                            @error('code_postal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- <div class="input-group mb-3">
                                            <label class="input-group-text" for="pays">Country</label>
                                            <select class="form-select" id="pays" name="pays">
                                            </select>
                                        </div> --}}


                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon5">City</span>
                                            <input type="text" class="form-control @error('ville') is-invalid @enderror"
                                                placeholder="City" aria-label="City" aria-describedby="basic-addon5"
                                                name="ville" value="{{ old('ville') }}">
                                            @error('ville')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon6">Country</span>
                                            <input type="text" class="form-control @error('pays') is-invalid @enderror"
                                                placeholder="Country" aria-label="Country"
                                                aria-describedby="basic-addon6" name="pays" id="pays"
                                                value="{{ old('pays') }}">
                                            {{-- <select class="form-select @error('pays') is-invalid @enderror" id="pays"
                                                name="pays">
                                            </select> --}}
                                            @error('pays')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon7">Email</span>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" aria-label="Email" aria-describedby="basic-addon7"
                                                name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon8">WebSite</span>
                                            <input type="text"
                                                class="form-control @error('site_web') is-invalid @enderror"
                                                placeholder="WebSite" aria-label="WebSite"
                                                aria-describedby="basic-addon8" name="site_web"
                                                value="{{ old('site_web') }}">
                                            @error('site_web')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon9">Social Object</span>
                                            <input type="text"
                                                class="form-control @error('objet_social') is-invalid @enderror"
                                                placeholder="Social Object" aria-label="Social Object"
                                                aria-describedby="basic-addon9" name="objet_social"
                                                value="{{ old('objet_social') }}">
                                            @error('objet_social')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon10">Description</span>
                                            <input type="text"
                                                class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Description" aria-label="Description"
                                                aria-describedby="basic-addon10" name="description"
                                                value="{{ old('description') }}">
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
                                        data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Enregistrer la société</button>
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
                            <th scope="col">Name</th>
                            <th scope="col">Postal Code</th>
                            <th scope="col">Country</th>
                            {{-- <th scope="col">City</th> --}}
                            {{-- <th scope="col">Address</th> --}}
                            <th scope="col">Phone</th>
                            <th scope="col">Email&WebSite</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($societes as $index => $societe)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $societe->nom }}</td>
                                <td>PO Box {{ $societe->code_postal }} {{ $societe->ville }}</td>
                                <td>{{ $societe->pays }}</td>
                                {{-- <td>{{ $societe->ville }}</td> --}}
                                {{-- <td>{{ $societe->adresse }}</td> --}}
                                <td>{{ $societe->telephone }}</td>
                                <td>
                                    {{ $societe->email }}
                                    <br>{{ $societe->site_web }}
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary btn-fixed px-1" href="#">Detail</a>
                                    <a class="btn btn-sm btn-warning btn-fixed px-1" href="#">Edit</a>
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
@section('scripts')
<!-- Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialisez select2 sur le champ de sélection des pays
            $('#pays').select2({
                placeholder: 'Select a country',
                ajax: {
                    url: 'https://restcountries.eu/rest/v2/all',
                    dataType: 'json',
                    delay: 250, // Délai de recherche
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item
                                        .alpha2Code,
                                    text: item
                                        .name
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0
            });
        });
    </script>
@endsection
