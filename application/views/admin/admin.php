<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Record Data Hari Ini</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <?php 
                    error_reporting(0);
                    $json = file_get_contents(base_url('backend/dokter_poli_all'));
                    $obj = json_decode($json, true);
                    $json_list = file_get_contents(base_url('backend/get_list_today'));
                    $obj_list = json_decode($json_list, true);
                    foreach($obj_list['results'] as $keyx => $valuex){
                        $dokter[$valuex['id']][$valuex['jam_praktik']]['count'] = $valuex['count'];
                        $dokter[$valuex['id']][$valuex['jam_praktik']]['jam_praktik'] = $valuex['jam_praktik'];
                    }
                    foreach($obj['results'] as $key => $value){
                ?>
                <div onclick="openInNewTab('<?php echo base_url('call_antrian/'.$value['id']) ?>')"  style="margin: 1vh; width: 50vh; cursor: pointer" >
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase">
                                        <b><?php echo $value['text'] ?></b> <?php echo $value['poli_name'] ?>
                                    </div>
                                    <div class="h6 mb-0 text-gray-800">
                                        Jam Praktik & Jumlah Antrian Hari Ini
                                    </div>
                                    <?php foreach($dokter[$value['id']] as $keyxz => $valxz){ ?>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $valxz['jam_praktik'] ?> || <?php echo $valxz['count'] ?> 
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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