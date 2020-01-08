    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Data Antrian Pasien</h1>
              </div>
              <form class="user" method="POST" action="<?php echo base_url('backend/data_antrian') ?>">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nomor_rm" placeholder="Nomor Rekam Medis / NIK" required>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Lihat Data</button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?php echo base_url() ?>">Kembali Ke Antrian</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>