@extends('layouts.app')
@section('content')

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">{{ config('app.name') }}</h5>
    </div>


    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4">
        <div class="col-md-6 text-center mx-auto ">
            <h1 class="display-4">Search for a Place</h1>
            <p class="lead">Just write in which region you want to search.</p>
            <input class="form-control form-control-lg" id="district" type="text" placeholder="Kadıköy">

        </div>
    </div>

    <div class="container"  style="min-height: 180px;">
        <div class="row" id="result"></div>
        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md text-center">
                    <small class="d-block mb-3 text-muted">&copy; {{ date('Y') }} | Onur Taşcı</small>
                </div>
            </div>
        </footer>
    </div>


    <div class="modal fade" id="placeDetailsModal" tabindex="-1" role="dialog" aria-labelledby="placeDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="placeDetailsModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

@endsection