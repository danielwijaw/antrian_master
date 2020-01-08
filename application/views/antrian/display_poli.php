<style>
.nomor-antrian-poli
{
	font-weight: bold;
	font-size: 185px;
    text-align: center;
    -webkit-animation-name: blink;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: cubic-bezier(1.0, 0, 0, 1.0);
    -webkit-animation-duration: 3s;
}
</style>
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Monitoring Antrian Poli</h1>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <img width="100%" src="<?php echo base_url('public/img/doctor.png') ?>" id="foto-dokter"/>
                            <br/>
                            <p>Nama Dokter</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <p class="nomor-antrian-poli">0</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <a class="small" href="<?php echo base_url() ?>">Kembali Ke Antrian</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>