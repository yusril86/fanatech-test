@extends('layouts.backend.index')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total Customer</h5>
                    <div class="d-flex align-items-center">
                        <div class="ps-3">
                            {{-- <h6>{{$customer}}</h6> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi</h5>
                    <div class="d-flex align-items-center">
                        <div class="ps-3">
                            {{-- <h6>{{$transaksi}}</h6> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total belum diantar</h5>
                    <div class="d-flex align-items-center">
                        <div class="ps-3">
                            {{-- <h6>{{$ekspedisi}}</h6> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total belum lunas</h5>
                    <div class="d-flex align-items-center">
                        <div class="ps-3">
                            {{-- <h6>{{$orderBelumLunas}}</h6> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total HPP sisa stok</h5>
                    <div class="d-flex align-items-center">
                        <div class="ps-3">
                            {{-- <h6>Rp{{number_format($totalHpp,0,'','.')}}</h6> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection