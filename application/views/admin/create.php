<?php 
    $data = current_url();
    $pecah = explode("/", $data);
    $json = file_get_contents(base_url('backend/category_row/'.$pecah[5]));
    $obj = json_decode($json, true);
?>
<?php if($obj['results']['url']=='dokter'){ ?>
    <link href="<?php echo base_url() ?>public/css/select2.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>public/js/select2.full.min.js"></script>
<?php }; ?>
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data <?php echo $obj['results']['text'] ?></h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="col-md-12">
                <form method="POST" action="<?php echo base_url('backend/create/'.$obj['results']['url']) ?>">   
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" class="form-control" name="result[k0]" value="<?php echo $obj['results']['url'] ?>" required>
                    <?php if($obj['results']['url']=='jenis_penjamin'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Penjamin</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="result[k2]" placeholder="Masukan Nama Jenis Penjamin" required>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($obj['results']['url']=='poliklinik'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Poliklinik</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="result[k2]" placeholder="Masukan Nama Poli Klinik" required>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($obj['results']['url']=='dokter'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Dokter</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="result[k2]" placeholder="Masukan Nama Dokter" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Poli</label>
                                </div>
                                <div class="col-md-9">
                                <input type="hidden" class="form-control" name="result[k4]" id="k4" required>
                                    <select class="form-control poliklinik_select2" name="result[k3]" required>
                                        <option disabled selected="true">Poliklinik</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Tambah Data">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    <?php if($obj['results']['url']=='dokter'){ ?>
        $('.poliklinik_select2').select2({
                ajax: {
                url: '<?php echo base_url('backend/poliklinik') ?>',
                dataType: 'json',
                placeholder: "Poliklinik"
            }
        });
        $('.poliklinik_select2').on('select2:select', function (e) {
            $("#k4").val(e.params.data.text);
        });
    <?php }; ?>
</script>