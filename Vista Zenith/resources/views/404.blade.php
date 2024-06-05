@extends('layouts.base')

@section('content')
    <!-- 404 Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
            <div class="col-md-6 text-center p-4">
                <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                <h1 class="display-1 fw-bold">Oups !</h1>
                <h1 class="mb-4">
                    <div class="w-100 pt-2 px-5">
                        @if (session('success'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </h1>
                <p class="mb-4">We’re sorry, the page you have looked for does not exist in our website!
                    Maybe go to our home page or try to use a search?</p>
                {{-- <a class="btn btn-primary rounded-pill py-3 px-5" href=""></a> --}}
            </div>
        </div>
    </div>
    <!-- 404 End -->
@endsection
