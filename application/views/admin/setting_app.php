<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pengaturan Aplikasi</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('backend/setting_update') ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <table width="100%">
                    <tr>
                        <td width="50%">Status Aplikasi Pendaftaran</td>
                        <td width="50%">
                            <input type="radio" name="status_apps" value="aktif" required> Aktif<br>
                            <input type="radio" name="status_apps" value="non-aktif" required> Non Aktif<br>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><br/><input type="submit" class="btn btn-primary btn-md" value="Submit"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>