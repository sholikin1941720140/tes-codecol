@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('custom-js')
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $('.select2').select2({
      theme: 'bootstrap4'
    })
  });

  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function optionForm(id) {
    document.getElementById(id).submit();
    return false;
  }
</script>
@endsection

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            <h3 class="card-title">Informasi Akun</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Nama : </strong>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{ auth()->user()->name }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Tanggal Lahir : </strong>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{ \Carbon\Carbon::parse(auth()->user()->dob)->format('d F Y') }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Status Akun : </strong>
                                </div>
                                <div class="col-sm-4">
                                    @if(auth()->user()->status == 'active')
                                        <p>Aktif</p>
                                    @else
                                        <p>Tidak Aktif</p>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong>Email : </strong>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
</div>
@endsection
