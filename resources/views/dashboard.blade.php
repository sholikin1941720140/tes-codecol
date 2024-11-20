@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard Umum</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard Umum</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @if(auth()->user()->role_id == '1')
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $userAct }}</h3>
                                <p>Total Karyawan Aktif</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-pink">
                            <div class="inner">
                                <h3>{{ $userInact }}</h3>
                                <p>Total Karyawan Tidak Aktif</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    @elseif (auth()->user()->role_id == '2')
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                @if(auth()->user()->status == 'active')
                                        <h3>Aktif</h3>
                                    @else
                                        <h3>Tidak Aktif</h3>
                                    @endif
                                <p>Status Akun</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-pink">
                            <div class="inner">
                                <h3>{{ auth()->user()->name }}</h3>
                                <p>"Tetap Semangat! Sukses Dimulai dari Langkah Hari Ini."</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-happy-outline"></i>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- /.row (main row) -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')

@endsection
