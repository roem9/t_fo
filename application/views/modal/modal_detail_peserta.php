<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?=base_url()?>peserta/edit" method="post">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#" class='nav-link' id="btn-form-1" data-id=""><i class="fas fa-book"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class='nav-link' id="btn-form-2" data-id=""><i class="fas fa-user"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id_peserta" id="id_peserta">
                    <div class="form-detail" id="form-1">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="wl">WL</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select name="program" id="program" class="form-control form-control-sm">
                                <option value="">Pilih Program</option>
                                <option value="Pra Tahsin 1">Pra Tahsin 1</option>
                                <option value="Pra Tahsin 2">Pra Tahsin 2</option>
                                <option value="Pra Tahsin 3">Pra Tahsin 3</option>
                                <option value="Tahsin 1">Tahsin 1</option>
                                <option value="Tahsin 2">Tahsin 2</option>
                                <option value="Tahsin 3">Tahsin 3</option>
                                <option value="Tahsin 4">Tahsin 4</option>
                                <option value="Tahsin Lanjutan">Tahsin Lanjutan</option>
                                <option value="Tahfidz Anak">Tahfidz Anak</option>
                                <option value="Tahfidz Dewasa">Tahfidz Dewasa</option>
                                <option value="Bahasa Arab 1">Bahasa Arab 1</option>
                                <option value="Bahasa Arab 2">Bahasa Arab 2</option>
                                <option value="Bahasa Arab 3">Bahasa Arab 3</option>
                                <option value="Bahasa Arab 4">Bahasa Arab 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select name="hari" id="hari" class="form-control form-control-sm">
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Ahad">Ahad</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jam">Jam</label>
                            <select name="jam" id="jam" class="form-control form-control-sm">
                                <option value="">Pilih Jam</option>
                                <option value="05.00-06.30">05.00-06.30</option>
                                <option value="05.30-07.00">05.30-07.00</option>
                                <option value="06.00-07.30">06.00-07.30</option>
                                <option value="06.30-08.00">06.30-08.00</option>
                                <option value="07.00-08.30">07.00-08.30</option>
                                <option value="07.30-09.00">07.30-09.00</option>
                                <option value="08.00-09.30">08.00-09.30</option>
                                <option value="08.30-10.00">08.30-10.00</option>
                                <option value="09.00-10.30">09.00-10.30</option>
                                <option value="09.30-11.00">09.30-11.00</option>
                                <option value="10.00-11.30">10.00-11.30</option>
                                <option value="10.30-12.00">10.30-12.00</option>
                                <option value="11.00-12.30">11.00-12.30</option>
                                <option value="11.30-13.00">11.30-13.00</option>
                                <option value="12.00-13.30">12.00-13.30</option>
                                <option value="12.30-14.00">12.30-14.00</option>
                                <option value="13.00-14.30">13.00-14.30</option>
                                <option value="13.30-15.00">13.30-15.00</option>
                                <option value="14.00-15.30">14.00-15.30</option>
                                <option value="14.30-16.00">14.30-16.00</option>
                                <option value="15.00-16.30">15.00-16.30</option>
                                <option value="15.30-17.00">15.30-17.00</option>
                                <option value="16.00-17.30">16.00-17.30</option>
                                <option value="16.30-18.00">16.30-18.00</option>
                                <option value="17.00-18.30">17.00-18.30</option>
                                <option value="17.30-19.00">17.30-19.00</option>
                                <option value="18.00-19.30">18.00-19.30</option>
                                <option value="18.30-20.00">18.30-20.00</option>
                                <option value="19.00-20.30">19.00-20.30</option>
                                <option value="19.30-21.00">19.30-21.00</option>
                                <option value="20.00-21.30">20.00-21.30</option>
                                <option value="20.30-22.00">20.30-22.00</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat Belajar</label>
                            <textarea name="tempat" id="tempat" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tgl_masuk">Tgl Masuk</label>
                            <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="form-detail" id="form-2">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input class='form-control form-control-sm' type="text" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label></td>
                            <input class='form-control form-control-sm' type="text" name="no_hp" id="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="jk">Gender</label>
                            <select name="jk" id="jk" class='form-control form-control-sm'>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat_peserta">Alamat</label>
                            <textarea class='form-control form-control-sm' name="alamat_peserta" id="alamat_peserta" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-sm btn-primary btn-block" value="Update" id="editPeserta">
            </div>
        </form>
    </div>
  </div>
</div>