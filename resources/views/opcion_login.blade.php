@extends('master')
@section('content')

{{View::make('Templates.header')}}

<div class="container d-flex justify-content-center" style="margin-top: 10rem;margin-bottom: 10rem;">
    <div class="row">
        <div class="col-6 me-5 d-flex justify-content-center align-items-center" style="width: 20rem;height: 20rem;">
            <a href="/login" id="btn-grande" style="padding: 5rem 4rem;" class="btn btn-outline-success">
                <h1>Comprador</h1>
                <i class="bi bi-person d-block" style="font-size: 5rem;"></i>
            </a>
        </div>
        <div class="col-6 ms-5 d-flex justify-content-center align-items-center" style="width: 20rem;height: 20rem;">
            <a href="login_proveedor" id="btn-grande" class="btn btn-outline-success">
                <h1>Vendedor</h1>
                <i class="bi bi-building" style="font-size: 5rem;"></i>
            </a>
        </div>
    </div>
</div>



{{View::make('Templates.footer')}}

@endsection