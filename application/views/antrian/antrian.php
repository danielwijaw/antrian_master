<link href="<?php echo base_url() ?>public/css/select2.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>public/js/select2.full.min.js"></script>
<div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Antrian Poli Klinik</h1>
              </div>
              <?php 
                if(config_item('status_antrian')=='0'){
                  echo "Aplikasi Antrian Sedang Non Aktif";
                  die();
                }
              ?>
              <form class="user" method="POST" action="<?php echo base_url('antrian_post') ?>">
                <div class="form-group">
                    <select class="form-control type_patient_select2"  name="type_patient" required>
                        <option disabled selected="true">Jenis Pasien Baru / Lama</option>
                        <option value="baru">Pasien Baru</option>
                        <option value="lama">Pasien Lama</option>
                    </select>
                </div>
                <div class="form-group">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <input type="hidden" name="child_id" id="child_id">
                    <select class="form-control jenis_penjamin_select2" name="penjamin" required>
                        <option disabled selected="true">Jenis Penjamin</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control poliklinik_select2"  name="poliklinik" required>
                        <option disabled selected="true">Poliklinik</option>
                    </select>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <select class="form-control dokter_select2" name="dokter" required>
                        <option disabled selected="true">Dokter</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control hari_tanggal_select2" name="hari_tanggal" required>
                        <option disabled selected="true">Hari & Tanggal</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <select class="form-control jam_select2" name="jam_praktik" required>
                        <option disabled selected="true">Jam Praktik</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control nomor_urut_select2" name="nomor_urut" required>
                        <option disabled selected="true">Nomor Urut</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nomor_rm" placeholder="Nomor Rekam Medis / NIK" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nama_pasien" placeholder="Nama Pasien" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat Pasien" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="no_telp" placeholder="Nomor Telephon / Handphone" required>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
                <input type="hidden" name="dokter_history" id="dokter_history">
                <input type="hidden" name="hari_tanggal_history" id="hari_tanggal_history">
                <input type="hidden" name="jam_history" id="jam_history">
              </form>
              <hr>
              <div class="text-center" style="display:none">
                <a class="small" href="<?php echo base_url() ?>pasien">Sudah Memiliki Nomor Antrian?</a>
              </div>
              <div class="text-center">
                <a class="small" onclick="ajax('<?php echo base_url() ?>frontend/dokumentasi','#dokumentasishow')" href="javascript:void(0)" data-toggle="modal" data-target="#modaldokumentasi">Aturan Pendaftaran Online</a>
              </div>
              <div class="text-center" style="display:none">
                <a class="small" href="<?php echo base_url() ?>frontend/dokter_cuti">Jadwal Libur Dokter</a>
              </div>
              <div class="text-center" style="display:none">
                <a class="small" href="<?php echo base_url() ?>frontend/jadwal_dokter">Jadwal Dokter</a>
              </div>
              <div class="text-center" style="display:none">
                <a class="small" href="<?php echo base_url() ?>login">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Modal -->
<div id="modaldokumentasi" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="dokumentasishow"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  $('.jenis_penjamin_select2').select2({
      ajax: {
      url: '<?php echo base_url('backend/jenis_penjamin') ?>',
      dataType: 'json',
      placeholder: "Jenis Penjamin"
    }
  });
  $('.poliklinik_select2').select2({
      ajax: {
      url: '<?php echo base_url('backend/poliklinik') ?>',
      dataType: 'json',
      placeholder: "Poliklinik"
    }
  });
  $('.dokter_select2').select2();
  $('.poliklinik_select2').on('select2:select', function (e) {
    $(".dokter_select2").val('').trigger('change');
    $('.dokter_select2').select2({
      ajax: {
        url: '<?php echo base_url('backend/dokter_poli?id_poli=') ?>'+e.params.data.id,
        dataType: 'json',
        placeholder: "Dokter"
      }
    });
  });
  $('.dokter_select2').on('select2:select', function (e) {
    $("#dokter_history").val(Object.entries(e.params.data));
    $(".hari_tanggal_select2").val('').trigger('change');
    $('.hari_tanggal_select2').select2({
      ajax: {
        url: '<?php echo base_url('backend/hari_tanggal?id_dokter=') ?>'+e.params.data.id,
        dataType: 'json',
        placeholder: "Hari & Tanggal"
      }
    });
  });
  $('.hari_tanggal_select2').on('select2:select', function (e) {
    $("#hari_tanggal_history").val(Object.entries(e.params.data));
    $("#child_id").val(e.params.data.child_id);
    $(".jam_select2").val('').trigger('change');
    $('.jam_select2').select2({
      ajax: {
        url: '<?php echo base_url('backend/jam_praktik?id_child=') ?>'+e.params.data.child_id,
        dataType: 'json',
        placeholder: "Hari & Tanggal"
      }
    });
  });
  $('.jam_select2').on('select2:select', function (e) {
    $("#jam_history").val(Object.entries(e.params.data));
    $(".nomor_urut_select2").val('').trigger('change');
    $('.nomor_urut_select2').select2({
      ajax: {
        url: '<?php echo base_url('backend/nomor_urut?id_child=') ?>'+e.params.data.child_id+'&jam_praktik='+e.params.data.id,
        dataType: 'json',
        placeholder: "Hari & Tanggal"
      }
    });
  });
  $('.jam_select2').select2();
  $('.hari_tanggal_select2').select2();
  $('.nomor_urut_select2').select2();
  $('.jk_select2').select2();
  $('.type_patient_select2').select2();
</script>