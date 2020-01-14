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
?>
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h1 class="text-gray-900 mb-4" style="font-weight: bold">Antrian <?php echo $obj['data']['poli_name']."<br/>".$obj['data']['doctor_name'] ?></h1>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body" style="text-align: center; overflow-y: scroll; height: 47vh;">
                            <p id="list_antrian"></p>
                        </div>
                        <p style="margin-top: 5vh" align="center">
                            <button onclick="antrian_call('<?php echo my_simple_crypt('0', 'e') ?>', '<?php echo $obj['data']['id'] ?>')" class="btn btn-primary">Antrian Selesai</button>
                        </p>
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
                <br/>
                <a class="small" href="<?php echo base_url("/logout") ?>">Logout</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<script>
    var conn = new WebSocket('<?php echo config_item('ipws'); ?>');
    conn.onopen = function(e) {
        clearTimeout(timer);
        call_poli();
        list_poli();
        console.log("Connection Websocket established");
        $("#loging").html("Connection Websocket established");
        conn.onclose = function(e) {
            timeout();
            call_poli();
            list_poli();
        };
        conn.onmessage = function(e) {
            console.log(e.data);
            $("#loging").html(e.data);
            if(e=='<?php echo $pecah[5]; ?>'){
                call_poli();
                list_poli();
            };
        };
    };
    timeout();
    call_poli();
    list_poli();
    var number = 1;
    function timeout() {
        timer = setTimeout(function () {
            var nmer = number++
            console.log('Connecting to Websocket '+nmer);
            var conn = new WebSocket('<?php echo config_item('ipws'); ?>');
            conn.onopen = function(e) {
                clearTimeout(timer);
                call_poli();
                list_poli();
                console.log("Connection established after try connected ("+nmer+")!");
                $("#loging").html("Connection established after try connected ("+nmer+")!");
                conn.onclose = function(e) {
                  timeout();
                  call_poli();
                  list_poli();
                };
                conn.onmessage = function(e) {
                    console.log(e.data);
                    $("#loging").html(e.data);
                    call_poli();
                    list_poli();
                };
            };
            timeout();
            return conn;
        }, 6500);
    };
    function call_poli(){
        $("#nomor_antrian").html("&infin;");
        $("#text_antrian").html("Loading Catching Data");
        $.ajax({
            url: "<?php echo base_url('backend/called_antrian/'.$pecah[5]) ?>",
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
                $("#text_antrian").html("<p class='ajaxloadingdata'>Error Catching Data</p>");
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
    function list_poli(){
        $("#list_antrian").html("Loading Catching Data");
        $.ajax({
            url: "<?php echo base_url('backend/list_antrian/'.$pecah[5]) ?>",
            contentType: false,
            cache: true,
            processData: false,
            success: function(data) {
                if(data.results=="Failed Catching Data"){
                    $("#list_antrian").html("-");
                    return false;
                }else{
                    $("#list_antrian").html("");
                    data.results.forEach(myFunction);
                    console.log(data.results);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $("#text_antrian").html("<p class='ajaxloadingdata'>Error Catching Data</p>");
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

    function myFunction(item, index) {
        if(item.called_antrian=="1"){
            var warna = "btn-danger";
        }else{
            var warna = "btn-primary";
        }
        document.getElementById("list_antrian").innerHTML += "<button onclick=\"antrian_call('"+item.antrian_id+"', '"+item.dokter_id+"')\" class=\"btn "+warna+"\">Nomor Urut " + item.nomor_urut + "</button> <br/> <br/>"; 
    }

    function antrian_call(id, poli){
        $.ajax({
            url: "<?php echo base_url('backend/update_call_antrian/') ?>"+id,
            contentType: false,
            cache: true,
            processData: false,
            success: function(data) {
                if(data.results=="Failed Update Data"){
                    alert("Gagal Memanggil Antrian");
                }else{
                    call_poli();
                    list_poli();
                    conn.send(poli);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $("#text_antrian").html("<p class='ajaxloadingdata'>Error Catching Data</p>");
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
    }
</script>