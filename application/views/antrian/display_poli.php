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
<?php 
    $data = current_url();
    $pecah = explode("/", $data);
    $json = file_get_contents(base_url('backend/get_doctor/'.$pecah[5]));
    $obj = json_decode($json, true);
    $pecah[6] = urldecode($pecah[6]);
?>
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h1 class="text-gray-900 mb-4" style="font-weight: bold">Antrian <?php echo $obj['data']['poli_name']."<br/>".urldecode($pecah[6]) ?></h1>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <img width="100%" src="<?php echo base_url('public/img/doctor.png') ?>" id="foto-dokter"/>
                            <br/>
                            <p class="text-gray-900" style="font-size: 22pt; font-weight: bold;"><?php echo $obj['data']['doctor_name'] = str_replace(" ", "<br/>",$obj['data']['doctor_name']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center">
                            <p class="nomor-antrian-poli" style="color: #476CD9; -webkit-text-stroke: 2px #373F41;" id="nomor_antrian"></p>
                            <p class="text-gray-900" style="font-size: 18pt;" id="text_antrian"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:none">
                <p id="loging"></p>
            </div>
            <hr>
            <div class="text-center">
                <a class="small" href="<?php echo base_url("display") ?>">Kembali Ke Antrian</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<script>
    call_poli();
    function call_poli(){
        $("#nomor_antrian").html("&infin;");
        $("#text_antrian").html("Loading Catching Data");
        $.ajax({
            url: "<?php echo base_url('backend/called_antrian/'.$pecah[5].'/'.$pecah[6]) ?>",
            contentType: false,
            cache: true,
            processData: false,
            success: function(data) {
                if(data.results=="Failed Catching Data"){
                    $("#nomor_antrian").html("-");
                    $("#text_antrian").html("-");
                    return false;
                }else{
                    $("#nomor_antrian").html(data.results.nomor_urut);
                    $("#text_antrian").html("Nomor Antrian <b>"+data.results.terbilang+"</b>");
                    return false;
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $(div).html("<p class='ajaxloadingdata'>Error Catching Data</p>");
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
        if(data[0]=='<?php echo $pecah[5]; ?>' && data[1]=='<?php echo $pecah[6]; ?>'){
            call_poli();
        };
    });
</script>