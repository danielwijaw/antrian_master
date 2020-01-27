<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Data Monitoring Antrian</h1>
            </div>
            <div class="row">
                <?php 
                    $json = file_get_contents(base_url('backend/dokter_poli_all'));
                    $obj = json_decode($json, true);
                    foreach($obj['results'] as $key => $value){
                ?>
                <div class="col-lg-3" style="cursor: pointer" onclick="openInNewTab('<?php echo base_url('display/'.$value['id']) ?>')">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <b><?php echo $value['text'] ?></b><br/><?php echo $value['poli_name'] ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <hr>
            <div class="text-center" style="display:none">
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