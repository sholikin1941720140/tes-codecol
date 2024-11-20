<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/user/store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data User</h4>
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
                                        <option value="1">Admin</option>
                                        <option value="2">Employee</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Nama<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-4 col-form-label">Status<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <select class="form-control" id="status" name="status" required>
                                        <option selected disabled>-- Pilih Status --</option>
                                        <option value="active">Aktif</option>
                                        <option value="inactive">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="dob" class="col-sm-4 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="city" class="col-sm-4 col-form-label">Kota<span class="text-danger">*</span></label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Masukkan Kota" required>
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