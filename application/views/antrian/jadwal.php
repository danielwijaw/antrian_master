<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Jadwal Dokter</h1>
            </div>
            <div class="row">
                <?php 
                    $hari = [
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                        'Minggu' => 'Minggu'
                    ];
                    $json = file_get_contents(base_url('/backend/datatables_data/jadwal_dokter?length=1000&start=0&draw=0'));
                    $obj = json_decode($json, true);
                    foreach($obj['data'] as $key => $value){
                        $data[$value[0]][] = $value[1].' ('.$value[2].')<br/>';
                    } 
                ?>
                <?php error_reporting(0); foreach($hari as $keyh => $valueh){ ?>
                <div class="col-lg-3">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <b><?php echo $valueh ?></b><br/>
                            <?php foreach($data[$keyh] as $keyd => $valued){ print_r($valued); } ?>
                        </div>
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

<script>
    function openInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }
</script>