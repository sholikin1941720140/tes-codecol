@extends('layouts.app')

@section('custom-css')
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
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Tambah Data Jadwal</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Data Jadwal Mengajar</h3>
                            </div>
                            <form action="{{ url('/schedule/update/'.$data['id']) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="id" value="{{$data['id']}}">
                                    <input type="hidden" name="user_id" value="{{$data['user_id']}}">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="user">User<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{$data['name']}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="checkin">Jam Masuk<span class="text-danger">*</span></label>
                                                <input type="time" class="form-control" name="checkin" value="{{$data['time_in']}}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="checkout">Jam Keluar<span class="text-danger">*</span></label>
                                                <input type="time" class="form-control" name="checkout" value="{{$data['time_out']}}" required>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="form-group">
                                        <label>Jadwal Hari<span class="text-danger">*</span></label>
                                        <div id="schedule-container">
                                            @foreach($data['day'] as $key => $value)
                                            <div class="row mb-2" id="schedule-{{$key+1}}">
                                                <div class="col-4">
                                                    <select class="form-control" name="day[]" required>
                                                        <option selected disabled>Pilih Hari</option>
                                                        <option value="Senin" {{ $value == 'Senin' ? 'selected' : '' }}>Senin</option>
                                                        <option value="Selasa" {{ $value == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                                        <option value="Rabu" {{ $value == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                                        <option value="Kamis" {{ $value == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                                        <option value="Jumat" {{ $value == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    @if($key > 0)
                                                    <button type="button" class="btn btn-danger" onclick="removeSchedule({{ $key+1 }})">
                                                        <i class="fas fa-minus"></i> Hapus
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-success mt-2" id="addSchedule">
                                            <i class="fas fa-plus"></i> Tambah Hari
                                        </button>
                                    </div>                                    
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{ url('/schedule') }}" class="btn btn-warning">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>                                                       
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('custom-js')
    <script>
        let scheduleCount = {{ count($data['day']) }};

        function addSchedule() {
            scheduleCount++;
            const scheduleContainer = document.getElementById('schedule-container');
            const newSchedule = `
                <div class="row mb-2" id="schedule-${scheduleCount}">
                    <div class="col-4">
                        <select class="form-control" name="day[]" required>
                            <option selected disabled>Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-danger" onclick="removeSchedule(${scheduleCount})">
                            <i class="fas fa-minus"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
            scheduleContainer.insertAdjacentHTML('beforeend', newSchedule);
        }

        function removeSchedule(id) {
            const scheduleElement = document.getElementById(`schedule-${id}`);
            if (scheduleElement) {
                scheduleElement.remove();
            }
        }

        document.getElementById('addSchedule').addEventListener('click', addSchedule);
    </script>
@endsection