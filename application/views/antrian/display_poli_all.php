<style>
.nomor-antrian-poli
{
	font-weight: bold;
	font-size: 192.5px;
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
            <div class="row">
                <?php 
                    $json = file_get_contents(base_url('backend/dokter_poli_all'));
                    $obj = json_decode($json, true);
                    foreach($obj['results'] as $key => $value){
                ?>
                <div class="col-md-3">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <b><?php echo $value['text'] ?></b>
                            <p><?php echo $value['poli_name'] ?></p>
                            <h1 id="nomor_antrian_<?php echo $value['id']; ?>">&nbsp;</h1>
                            <p id="text_antrian_<?php echo $value['id']; ?>">&nbsp;</p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div style="display:none">
                <p id="loging"></p>
            </div>
            <hr>
            <div class="text-center">
                <a class="small" href="<?php echo base_url("display") ?>">Kembali Ke Display</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<script>
    <?php 
        foreach($obj['results'] as $key => $value){ 
    ?>
    call_poli('<?php echo $value['id'] ?>');
    <?php        
        }
    ?>
    function call_poli(number){
        $("#nomor_antrian_"+number).html("&infin;");
        $("#text_antrian_"+number).html("Loading Catching Data");
        $.ajax({
            url: "<?php echo base_url('backend/called_antrian/') ?>"+number,
            contentType: false,
            cache: true,
            processData: false,
            success: function(data) {
                if(data.results=="Failed Catching Data"){
                    $("#nomor_antrian_"+number).html("-");
                    $("#text_antrian_"+number).html("-");
                    return false;
                }else{
                    $("#nomor_antrian_"+number).html(data.results.nomor_urut);
                    $("#text_antrian_"+number).html("Nomor Antrian <b>"+data.results.terbilang+"</b>");
                    return false;
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $('#text_antrian').html("<p class='ajaxloadingdata'>Error Catching Data</p>");
                $("#catching_error").html(XMLHttpRequest.responseText); 
                if (XMLHttpRequest.status == 0) {
                alert(' Check Your Network.');
                } else if (XMLHttpRequest.status == 404) {
                alert('Requested URL not found.');
                } else if (XMLHttpRequest.status == 500) {
                alert('Internel Server Error.');
                }  else {
                alert('Unknow Error.\n' + XMLHttpRequest.responseText);
                } 
            }
        });
    };
</script>
<script src="<?php echo base_url() ?>public/js/pusher.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('6da9105f74f8a8d019fc', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        call_poli(data);
    });
</script>