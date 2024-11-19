<div class="modal fade" id="modal-edit-{{$item->id}}">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/user/update/'.$item->id)}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="role" class="col-sm-4 col-form-label">Role<span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="role" name="role" required>
                                        <option selected disabled>-- Pilih Role --</option>
                                        <option value="1" {{$item->role_id == 1 ? 'selected' : ''}}>Admin</option>
                                        <option value="2" {{$item->role_id == 2 ? 'selected' : ''}}>Employee</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Nama<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" value="{{$item->name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{$item->email}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-4 col-form-label">Status<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <select class="form-control" id="status" name="status" required>
                                        <option selected disabled>-- Pilih Status --</option>
                                        <option value="active" {{$item->status == 'active' ? 'selected' : ''}}>Aktif</option>
                                        <option value="inactive" {{$item->status == 'inactive' ? 'selected' : ''}}>Tidak Aktif</option>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="dob" class="col-sm-4 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{$item->lahir}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="city" class="col-sm-4 col-form-label">Kota<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="city" name="city" value="{{$item->kota}}" placeholder="Masukkan Kota" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->