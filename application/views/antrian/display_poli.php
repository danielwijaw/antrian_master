<style>
.nomor-antrian-poli
{
	font-weight: bold;
	font-size: 192.5px;
    text-align: center;
    -webkit-animation-name: blink;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: cubic-bezier(1.0, 0, 0, 1.0);
    -webkit-animation-duration: 3s;
}
</style>
<?php 
    $data = current_url();
    $pecah = explode("/", $data);
    $json = file_get_contents(base_url('backend/get_doctor/'.$pecah[5]));
    $obj = json_decode($json, true);
?>
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h1 class="text-gray-900 mb-4" style="font-weight: bold">Antrian <?php echo $obj['data']['poli_name'] ?></h1>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <img width="100%" src="<?php echo base_url('public/img/doctor.png') ?>" id="foto-dokter"/>
                            <br/>
                            <p class="text-gray-900" style="font-size: 22pt; font-weight: bold;"><?php echo $obj['data']['doctor_name'] = str_replace(" ", "<br/>",$obj['data']['doctor_name']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <p class="nomor-antrian-poli" style="color: #476CD9; -webkit-text-stroke: 2px #373F41;">13</p>
                            <p class="text-gray-900" style="font-size: 18pt;">Antrian Nomor <b>Tiga Belas</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <a class="small" href="<?php echo base_url("display") ?>">Kembali Ke Antrian</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>