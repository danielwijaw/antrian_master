<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Dokter Cuti</h1>
            </div>
            <div class="row">
                <?php 
                    $json = file_get_contents(base_url('/backend/datatables_data/libur_dokter?length=1000&start=0&draw=0'));
                    $obj = json_decode($json, true);
                    foreach($obj['data'] as $key => $value){
                ?>
                <div class="col-lg-3">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                        <?php echo $value[0] ?> <br/> <b><?php echo $value[1].'<br/>'.$value[2] ?></b>
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