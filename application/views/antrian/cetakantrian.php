
<?php 
    $cookie_login = get_cookie("cookiebynomorrm");
    $cookie_login = JSON_DECODE($cookie_login, true);
?>
<link href="<?php echo base_url() ?>public/css/sb-admin-2.min.css" rel="stylesheet">
<div class="col-lg-3">
    <div class="card mb-4 py-3">
        <div class="card-body" style="text-align: center">
            <?php echo $cookie_login['dokter_history']['3'] ?> || <?php echo $cookie_login['dokter_history']['5'] ?> 
            <br/> <b style="font-size:36pt"><?php echo $cookie_login['nomor_urut'] ?></b> 
            <br/> <?php echo $cookie_login['hari_tanggal']."<br/>".$cookie_login['jam_praktik'] ?>
        </div>
    </div>
</div>
<script>
doPrint();
function doPrint() {
    window.print();            
    alert("Pandaftaran Pasien Secara Online Telah Berhasil");
    document.location.href = "<?php echo base_url('/') ?>"; 
}
</script>