<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a href="#" class='nav-link' id="detailKelas" data-id=""><i class="fas fa-book"></i></a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class='nav-link' id="detailPeserta" data-id=""><i class="fas fa-user"></i></a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class='nav-link' id="detailJadwal" data-id=""><i class="fas fa-clock"></i></a>
                    </li>
                </ul>
            </div>
            <div class="card-body cus-font">
              <ul class="list-group" id="dataKelas">
                <li class="list-group-item list-group-item-info">Data Akademik</li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Status
                    </div>
                    <div class="col-6" id="status"> 
                      
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Program
                    </div>
                    <div class="col-6" id="program"> 
                      
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Pengajar
                    </div>
                    <div class="col-6" id="kpq"> 
                      
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Tipe Pengajar
                    </div>
                    <div class="col-6" id="pengajar"> 
                      
                    </div>
                  </div>
                </li>
              </ul>

              <ul class="list-group" id="dataPeserta">
                <li class="list-group-item list-group-item-info">List Peserta <span class="badge badge-danger badge-pill" id="totalPeserta"></span></li>
                <div id="list-peserta"></div>
              </ul>
              
              <ul class="list-group" id="dataJadwal">
                <li class="list-group-item list-group-item-info">List Jadwal <span class="badge badge-danger badge-pill" id="totalJadwal"></span></li>
                <div id="list-jadwal"></div>
              </ul>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>