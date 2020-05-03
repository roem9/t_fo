<div class="modal fade" id="modal_edit_status_tagihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-invoice">Edit Status Tagihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body cus-font">
        <form action="<?=base_url()?>transaksi/edit_status_tagihan" method="POST">
            <input type="hidden" name="id" id="id_edit_tagihan">
            <div class="form-group">
                <label for="status_tagihan">Status</label>
                <select name="status" id="status_tagihan" class="form-control form-control-sm">
                    <option value="">Pilih Status</option>
                    <option value="piutang">Piutang</option>
                    <option value="lunas">Lunas</option>
                </select>
            </div>
        </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success btn-sm" value="Edit">
            </div>
      </form>
    </div>
  </div>
</div>