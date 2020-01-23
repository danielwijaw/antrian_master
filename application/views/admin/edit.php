<?php 
    $data = current_url();
    $pecah = explode("/", $data);
    $json = file_get_contents(base_url('backend/get_full_data/'.$pecah[5].'/'.$pecah[6]));
    $obj = json_decode($json, true);
?>
<?php if($obj['results']['child_value']['k0']=='dokter' or $obj['results']['child_value']['k0']=='user_admin' or $obj['results']['child_value']['k0']=='jadwal_dokter' or $obj['results']['child_value']['k0']=='libur_dokter' or $obj['results']['child_value']['k0']=='level_user'){ ?>
    <link href="<?php echo base_url() ?>public/css/select2.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>public/js/select2.full.min.js"></script>
<?php }; ?>
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data <?php echo $obj['results']['child_value']['k2'] ?></h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="col-md-12">
                <form method="POST" action="<?php echo base_url('backend/edit/'.$obj['results']['id']) ?>">   
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" class="form-control" name="result[k0]" value="<?php echo $obj['results']['child_value']['k0'] ?>" required>
                    <?php if($obj['results']['child_value']['k0']=='jenis_penjamin'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Penjamin</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="result[k2]" value="<?php echo $obj['results']['child_value']['k2'] ?>" placeholder="Masukan Nama Jenis Penjamin" required>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($obj['results']['child_value']['k0']=='poliklinik'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Poliklinik</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="result[k2]" value="<?php echo $obj['results']['child_value']['k2'] ?>" placeholder="Masukan Nama Poli Klinik" required>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($obj['results']['child_value']['k0']=='dokter'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Dokter</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="result[k2]" value="<?php echo $obj['results']['child_value']['k2'] ?>" placeholder="Masukan Nama Dokter" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Poli</label>
                                </div>
                                <div class="col-md-9">
                                <input type="hidden" class="form-control" value="<?php echo $obj['results']['child_value']['k4'] ?>" name="result[k4]" id="k4" required>
                                    <select class="form-control poliklinik_select2" name="result[k3]" required>
                                        <option value="<?php echo my_simple_crypt($obj['results']['child_value']['k3'], 'e') ?>" selected="true"><?php echo $obj['results']['child_value']['k4'] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($obj['results']['child_value']['k0']=='user_admin'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Pengguna</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="result[k2]" placeholder="Masukan Nama Pengguna" value="<?php echo $obj['results']['child_value']['k2'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Username Pengguna</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="result[k1]" placeholder="Masukan Username Pengguna" value="<?php echo $obj['results']['child_value']['k1'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Kata Sandi Pengguna</label>
                                </div>
                                <div class="col-md-9">
                                    <input onkeyup="validate_password()" type="password" class="form-control" name="result[k3]" id="k3" placeholder="Masukan Kata Sandi Pengguna" value="<?php echo $obj['results']['child_value']['k3_validate'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <p style="font-size: 10pt; color: red" id="alert"></p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Validasi Kata Sandi Pengguna</label>
                                </div>
                                <div class="col-md-9">
                                    <input onkeyup="validate_password()" type="password" class="form-control" name="result[k3_validate]" id="k3_validate" value="<?php echo $obj['results']['child_value']['k3_validate'] ?>" placeholder="Masukan Ulang Kata Sandi Pengguna" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Level Hak Akses</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control" name="result[k5]" id="k5" value="<?php echo $obj['results']['child_value']['k5'] ?>" required>
                                    <select class="form-control hak_akses_select2" name="result[k4]" required>
                                        <option value="<?php echo my_simple_crypt($obj['results']['child_value']['k4'], 'e') ?>"><?php echo $obj['results']['child_value']['k5'] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($obj['results']['child_value']['k0']=='jadwal_dokter'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Dokter</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control" name="result[k4_text]" value="<?php echo $obj['results']['child_value']['k4_text'] ?>" id="k4_text" required>
                                    <select class="form-control dokter_select2" name="result[k4]" required>
                                        <option value="<?php echo my_simple_crypt($obj['results']['child_value']['k4'], 'e') ?>"><?php echo $obj['results']['child_value']['k4_text'] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Hari Praktik</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control hari_select2" name="result[k2]" required>
                                        <option value="<?php echo $obj['results']['child_value']['k2'] ?>" ><?php echo $obj['results']['child_value']['k2'] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input id="jumlah_jadwal" type="hidden" value="<?php echo count($obj['results']['child_value']['k3_count']) ?>">
                        <div id="jadwal-praktik-dokter">
                        <?php foreach($obj['results']['child_value']['k3_count'] as $key => $value){ ?>
                            <div id="jadwal_<?php echo $key+1 ?>">
                                <?php if($key==0){ ?>
                                <div class="col-md-12" style="font-weight: bold; text-align: right">
                                    <button onclick="jadwal_plus()" type="button" class="btn btn-primary btn-sm"><li class="fa fa-plus"></li></button>
                                </div>
                                <?php }else{ ?>
                                <div class="col-md-12" style="font-weight: bold; text-align: right">
                                    <button onclick="jadwal_minus(<?php echo $key+1 ?>)" type="button" class="btn btn-danger btn-sm"><li class="fa fa-minus"></li></button>
                                </div>
                                <?php } ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Jam Praktik Dokter</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="time" value="<?php echo $obj['results']['child_value']['k3_mulai'][$key] ?>" class="form-control" name="result[k3_mulai][]" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="time" value="<?php echo $obj['results']['child_value']['k3_finish'][$key] ?>" class="form-control" name="result[k3_finish][]" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Jumlah Antrian</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" value="<?php echo $obj['results']['child_value']['k3_count'][$key] ?>" onkeyup="this.value=this.value.replace(/[^\d]/,'')" class="form-control" name="result[k3_count][]" placeholder="Masukan Jumlah Antrian" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if($obj['results']['child_value']['k0']=='libur_dokter'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Dokter</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control" value="<?php echo $obj['results']['child_value']['k3_text'] ?>" name="result[k3_text]" id="k3_text" required>
                                    <select class="form-control dokter_select2" name="result[k3]" required>
                                        <option value="<?php echo my_simple_crypt($obj['results']['child_value']['k3'], 'e') ?>"><?php echo $obj['results']['child_value']['k3_text'] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Tanggal Libur</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" value="<?php echo $obj['results']['child_value']['k2'] ?>" name="result[k2]" required>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($obj['results']['child_value']['k0']=='level_user'){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Hak Akses</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?php echo $obj['results']['child_value']['k2'] ?>" name="result[k2]" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Role User</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control" value="<?php echo $obj['results']['child_value']['k3_text'] ?>" name="result[k3_text]" id="k3_text" required>
                                    <select class="form-control dokter_select2" name="result[k3]" required>
                                        <option value="<?php echo my_simple_crypt($obj['results']['child_value']['k3'], 'e') ?>"><?php echo $obj['results']['child_value']['k3_text'] ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Edit Data">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    <?php if($obj['results']['child_value']['k0']=='dokter'){ ?>
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
    <?php if($obj['results']['child_value']['k0']=='user_admin'){ ?>
        $("#submit_form").attr('disabled', 'disabled');
        $('.hak_akses_select2').select2({
                ajax: {
                url: '<?php echo base_url('backend/hakakses') ?>',
                dataType: 'json',
                placeholder: "Level Hak Akses"
            }
        });
        $('.hak_akses_select2').on('select2:select', function (e) {
            $("#k5").val(e.params.data.text);
        });
        function validate_password()
        {
            var password = $("#k3").val();
            var password_validate = $("#k3_validate").val();
            if(password===password_validate){
                $("#submit_form").removeAttr('disabled');
                $("#alert").html("");
            }else{
                $("#alert").html("#Password Dan Validasi Password Tidak Sesuai!!");
                $("#submit_form").attr('disabled', 'disabled');
            }
        }
    <?php }; ?>
    <?php if($obj['results']['child_value']['k0']=='jadwal_dokter'){ ?>
        var data = [
            {
                id: 'Senin',
                text: 'Senin'
            },
            {
                id: 'Selasa',
                text: 'Selasa'
            },
            {
                id: 'Rabu',
                text: 'Rabu'
            },
            {
                id: 'Kamis',
                text: 'Kamis'
            },
            {
                id: 'Jumat',
                text: 'Jumat'
            },
            {
                id: 'Sabtu',
                text: 'Sabtu'
            },
            {
                id: 'Minggu',
                text: 'MInggu'
            }
        ];
        $('.dokter_select2').select2({
                ajax: {
                url: '<?php echo base_url('backend/dokter') ?>',
                dataType: 'json',
                placeholder: "Nama Dokter"
            }
        });
        $('.dokter_select2').on('select2:select', function (e) {
            $("#k4_text").val(e.params.data.text);
        });
        $('.hari_select2').select2({
            data: data
        });
        function jadwal_plus() {
            var html = "";
            var jumlah_jadwal = $("#jumlah_jadwal").val();
            var count = parseInt(jumlah_jadwal) + 1;
            $("#jumlah_jadwal").val(count);
            html += "<div id='jadwal_"+count+"'>";
                html += "<div class=\"col-md-12\" style=\"font-weight: bold; text-align: right\">";
                    html += "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"jadwal_minus("+count+")\"><li class=\"fa fa-minus\"></li></button>";
                html += "</div>";
                html += "<div class=\"form-group\">";
                    html += "<div class=\"row\">";
                        html += "<div class=\"col-md-3\">";
                            html += "<label>Jam Praktik</label>";
                        html += "</div>";
                        html += "<div class=\"col-md-4\">";
                            html += "<input type=\"time\" value=\"<?php echo date('H:i') ?>\" class=\"form-control\" name=\"result[k3_mulai][]\" required>";
                        html += "</div>";
                        html += "<div class=\"col-md-4\">";
                            html += "<input type=\"time\" value=\"<?php echo date('H:i') ?>\" class=\"form-control\" name=\"result[k3_finish][]\" required>";
                        html += "</div>";
                    html += "</div>";
                html += "</div>";
                html += "<div class=\"form-group\">";
                    html += "<div class=\"row\">";
                        html += "<div class=\"col-md-3\">";
                            html += "<label>Jumlah Antrian</label>";
                        html += "</div>";
                        html += "<div class=\"col-md-9\">";
                            html += "<input type=\"number\" onkeyup=\"this.value=this.value.replace(/[^\\d]/,'')\" class=\"form-control\" name=\"result[k3_count][]\" placeholder=\"Masukan Jumlah Antrian\" required>";
                        html += "</div>";
                    html += "</div>";
                html += "</div>";
            html += "</div>";
            $("#jadwal-praktik-dokter").append(html);
        }
        function jadwal_minus(id_minus){
            var elem = document.getElementById("jadwal_"+id_minus);
            return elem.parentNode.removeChild(elem);
        }
    <?php }; ?>
    <?php if($obj['results']['child_value']['k0']=='libur_dokter'){ ?>
        $('.dokter_select2').select2({
                ajax: {
                url: '<?php echo base_url('backend/dokter') ?>',
                dataType: 'json',
                placeholder: "Nama Dokter"
            }
        });
        $('.dokter_select2').on('select2:select', function (e) {
            $("#k3_text").val(e.params.data.text);
        });
    <?php }; ?>
    <?php if($obj['results']['child_value']['k0']=='level_user'){ ?>
        $('.dokter_select2').select2({
                ajax: {
                url: '<?php echo base_url('backend/dokter') ?>',
                dataType: 'json',
                placeholder: "Nama Dokter"
            }
        });
        $('.dokter_select2').on('select2:select', function (e) {
            $("#k3_text").val(e.params.data.text);
        });
    <?php }; ?>
</script>