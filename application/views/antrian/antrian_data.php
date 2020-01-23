<div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Data Antrian Pasien</h1>
              </div>
              <div class="row">
              <?php 
                $cookies = get_cookie('cookiedataantrian');
                $cookies = JSON_DECODE($cookies, true);
                foreach($cookies as $key => $value){
              ?>
                <div class="col-lg-3">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <?php echo $value['dokter_text'] ?> || <?php echo $value['poli_text'] ?> 
                            <br/> <b style="font-size:36pt"><?php echo $value['nomor_urut'] ?></b> 
                            <br/> <?php echo $value['hari_tanggal']."<br/>".$value['jam_praktik'] ?>
                        </div>
                        <?php if($value['nomor_urut']!='0'){ ?>
                        <a onclick="return confirm('Anda Yakin Cancel Antrian Nomor Urut <?php echo $value['nomor_urut'] ?> <?php echo $value['dokter_text'] ?> <?php echo $value['poli_text'] ?> Tanggal <?php echo $value['hari_tanggal'] ?> ?')" href="<?php echo base_url('backend/cancel_antrian/'.$value['id']) ?>"><center style="font-size: 10pt">Cancel Antrian</center></a>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                </div>
              <hr>
              <div class="text-center">
                <a class="small" href="<?php echo base_url() ?>">Kembali Ke Pendaftaran</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>