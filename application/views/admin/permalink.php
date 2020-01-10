<?php 
    $data = current_url();
    $pecah = explode("/", $data);
    $json = file_get_contents(base_url('backend/category_row/'.$pecah[5]));
    $obj = json_decode($json, true);
?>
<link href="<?php echo base_url() ?>public/css/datatables.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url() ?>public/js/datatables.min.js"></script>
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $obj['results']['text'] ?></h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <a href="<?php echo base_url('admin/create/'.$obj['results']['url']) ?>">
                <button type="button" class="btn btn-primary btn-sm">Tambah Data</button>
            </a>
            <br/><br/>
            <table id="datatables_<?php echo $obj['results']['url'] ?>" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Text</th>
                        <?php if($pecah[5]=='dokter' or $pecah[5]=='user_admin'){ ?>
                        <th>Attribute</th>
                        <?php }else if($pecah[5]=='jadwal_dokter'){ ?>
                        <th>Attribute</th>
                        <th>Attribute</th>
                        <?php }else if($pecah[5]=='libur_dokter'){ ?>
                        <th>Attribute</th>
                        <th>Attribute</th>
                        <?php }else{ }; ?>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Text</th>
                        <?php if($pecah[5]=='dokter' or $pecah[5]=='user_admin'){ ?>
                        <th>Attribute</th>
                        <?php }else if($pecah[5]=='jadwal_dokter'){ ?>
                        <th>Attribute</th>
                        <th>Attribute</th>
                        <?php }else if($pecah[5]=='libur_dokter'){ ?>
                        <th>Attribute</th>
                        <th>Attribute</th>
                        <?php }else{ }; ?>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#datatables_<?php echo $obj['results']['url'] ?>').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax"      : "<?php echo base_url('backend/datatables_data/'.$obj['results']['url']); ?>"
    });
} );
</script>