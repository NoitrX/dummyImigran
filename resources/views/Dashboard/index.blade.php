@extends('Layouts.main')
@section('title', 'DASHBOARD | AMS')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                 
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">PMI MEDICAL</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target={{$medicalUsers}}>0</span> <span style="font-size: 14px">Orang</span>
                        </h4>
                    </div>

                    <div class="col-6">
                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <form action="{{ route('dashboard.viewFilter', [ 'type' => 'medical', 'status' => 'status'])}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm rounded-0">LIHAT DATA</button>
                    </form>
                    
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">PMI BLKLN</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target={{$blkln}}>0</span> <span style="font-size: 14px">Orang</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <form action="{{ route('dashboard.viewFilter', [ 'type' => 'blkln', 'status' => 'status'])}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm rounded-0">LIHAT DATA</button>
                    </form>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col-->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span>PMI REKOMPASSPORT</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target={{$rekompassport}}>0</span> <span style="font-size: 14px">Orang</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <form action="{{ route('dashboard.viewFilter', [ 'type' => 'rekompassport' , 'status' => 'status'])}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm rounded-0">LIHAT DATA</button>
                    </form>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div>

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span>PMI SUDAH TERBANG</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target={{$sudahTerbang}}>0</span> <span style="font-size: 14px">Orang</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <form action="{{ route('dashboard.viewFilter', [ 'type' => 'terbang', 'status' => 'status_penerbangan'])}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm rounded-0">LIHAT DATA</button>
                    </form>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div>
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">PMI BELUM TERBANG</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target={{$belumTerbang}}>0</span> <span style="font-size: 14px">Orang</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <form action="{{ route('dashboard.viewFilter', [ 'type' => 'belum_terbang', 'status' => 'status_penerbangan'])}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm rounded-0">LIHAT DATA</button>
                    </form>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div>

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span>PMI FIT</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target={{$pmiFit}}>0</span> <span style="font-size: 14px">Orang</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <form action="{{ route('dashboard.viewFilter', [ 'type' => 'fit', 'status' => 'status_medical'])}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm rounded-0">LIHAT DATA</button>
                    </form>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div>

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span>PMI NON FIT</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target={{$nonFit}}>0</span> <span style="font-size: 14px">Orang</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <form action="{{ route('dashboard.viewFilter', [ 'type' => 'non_fit', 'status' => 'status_medical'])}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm rounded-0">LIHAT DATA</button>
                    </form>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div>

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span>PMI NON APPROVED</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target={{$nonApproved}}>0</span> <span style="font-size: 14px">Orang</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <form action="{{ route('dashboard.viewFilter', [ 'type' => 'non_approved', 'status' => 'status_akun'])}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm rounded-0">LIHAT DATA</button>
                    </form>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div>
</div><!-- end row-->


<!-- end row-->
    </div>
    <!-- end col -->
            </div><!-- end card header -->
@endsection