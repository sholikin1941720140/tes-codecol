@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Absensi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Absensi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8">
          <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="text-warning mb-4">{{ $now }}</h4>
                    @if($hasSchedule)
                        <div class="card shadow-sm mb-4">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <h5 class="card-title">Jam Kerja Hari Ini</h5>
                                <h4 class="card-text">{{ $data->first()['time_in'] }} - {{ $data->first()['time_out'] }}</h4>
                            </div>
                        </div>
                        <input type="hidden" name="time_in" value="{{ $data->first()['time_in'] }}">
                        <input type="hidden" name="time_out" value="{{ $data->first()['time_out'] }}">
                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitAttendance">
                                <i class="bi bi-door-open"></i> Absen Masuk
                            </button>
                            &nbsp;
                            <button type="submit" class="btn btn-primary btn-lg" id="submitLeave">
                                <i class="bi bi-door-closed"></i> Absen Pulang
                            </button>
                        </div>
                    @else
                        <h4 class="text-danger mt-4">Hari ini tidak ada jadwal</h4>
                    @endif
                </div>
            </div>
            
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/check-submit-attendance',
                type: 'GET',
                success: function(data) {
                    // console.log(data);
                    if(data.status == 'success') {
                        $('#submitAttendance').removeClass('btn-primary').addClass('btn-success').attr('disabled', true);
                    }
                },
                error: function(xhr, status, err) {
                    var errorMessage = xhr.responseText;
                    alert('Terjadi kesalahan saat memproses permintaan: ' + errorMessage)
                }
            });
        });
        $(document).ready(function() {
            $.ajax({
                url: '/check-submit-leave',
                type: 'GET',
                success: function(data) {
                    // console.log(data);
                    if(data.status == 'success') {
                        $('#submitLeave').removeClass('btn-primary').addClass('btn-success').attr('disabled', true);
                    }
                },
                error: function(xhr, status, err) {
                    var errorMessage = xhr.responseText;
                    alert('Terjadi kesalahan saat memproses permintaan: ' + errorMessage)
                }
            });
        });

        $('#submitAttendance').on('click', function() {
            var time_in = $('input[name="time_in"]').val();
            var time_out = $('input[name="time_out"]').val();
            console.log(time_in, time_out);

            $.ajax({
                url: '/submit-attendance',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    time_in: time_in,
                    time_out: time_out
                },
                success: function(data) {
                    console.log(data);
                    if(data.status === 'present') {
                        $('#submitAttendance').removeClass('btn btn-primary').addClass('btn btn-success').attr('disabled', true);
                        var successMessage = data.message;
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: successMessage
                            });
                        }, 500);
                    } else if (data.status === 'late') {
                        $('#submitAttendance').removeClass('btn btn-primary').addClass('btn btn-success').attr('disabled', true);
                        var successMessage = data.message;
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: successMessage
                            });
                        }, 500);
                    }
                },
                error: function(xhr, status, err) {
                    if(xhr.status == 420 || xhr.status == 422) {
                        var errorMessage = xhr.responseJSON.message;
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage
                        });
                    }
                }
            });
        });

        $('#submitLeave').on('click', function() {
            var time_in = $('input[name="time_in"]').val();
            var time_out = $('input[name="time_out"]').val();
            console.log(time_in, time_out);

            $.ajax({
                url: '/submit-leave',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    time_in: time_in,
                    time_out: time_out
                },
                success: function(data) {
                    console.log(data);
                    if(data.status === 'success') {
                        $('#submitLeave').removeClass('btn btn-primary').addClass('btn btn-success').attr('disabled', true);
                        var successMessage = data.message;
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: successMessage
                            });
                        }, 500);
                    }
                },
                error: function(xhr, status, error) {
                    if(xhr.status == 420 || xhr.status == 422) {
                        var errorMessage = xhr.responseJSON.message;
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage
                        });
                    }
                }
            });
        });
    </script>
@endsection