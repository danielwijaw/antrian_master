<link href="<?php echo base_url() ?>public/css/daterangepicker.css" rel="stylesheet">
<script src="<?php echo base_url() ?>public/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>public/js/daterangepicker.js"></script>
<script src="<?php echo base_url() ?>public/vendor/bootstrap/js/bootstrap.min.js"></script>
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" onclick="actionedit()" class="btn btn-primary">Edit</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" onclick="actiondelete()" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="valsearch" class="form-control form-control-user">
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="datesearch" class="form-control form-control-user">
                        </div>
                        <div class="col-md-3">
                            <button type="button" onclick="exportdata('show')" class="btn btn-primary">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>
                            <button type="button" onclick="exportdata('excel')" class="btn btn-primary">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <input type="hidden" value="0" id="reportedit">
            <div class="col-md-12" style="overflow-y:scroll; height: 50vh">
                <div id="showingdata"></div>
            </div>
            <div style="display:none">
                <p id="catching_error"></p>
            </div>
        </div>
    </div>
</div>
<div style="display:none">
<button type="button" id="clickbuttonmodal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div id="modal_here_antrian">
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
      
    </div>
</div>
<script>
    function actionedit(){
        var getval = $("#reportedit").val();
        if(getval=='0'){
            alert("Row Data Belum Diplih");
            return false;
        }
        $("#clickbuttonmodal").click();
    }

    function actiondelete(){
        var getval = $("#reportedit").val();
        if(getval=='0'){
            alert("Row Data Belum Diplih");
            return false;
        }
        var r = confirm("Anda yakin akan menghapus data ?");
        if (r == true) {
            $.ajax({
                url: "<?php echo base_url('/backend/delete_antrian_by_admin/') ?>"+getval,
                contentType: false,
                cache: true,
                processData: false,
                success: function(data) {
                    alert("Data Telah Terhapus");
                    exportdata('show');
                    $("#reportedit").val('0');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#showingdata").html("<p class='ajaxloadingdata'>Error Catching Data</p>");
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
        } else {
            // Only Alert
        } 
    }

    function edit_report(id)
    {
        var getval = $("#"+id).val();
        $("#reportedit").val(getval);
    }

    $('#datesearch').daterangepicker({ 
        locale: {
            format: 'Y-MM-DD'
        }
    });

    function exportdata(type){
        $("#reportedit").val('0');
        var date = $("#datesearch").val();
        var valsearch = $("#valsearch").val();
        if(valsearch==""){
            valsearch = "-";
        }
        if(type=='excel'){
            var win = window.open("<?php echo base_url('/admin/report_excel/') ?>"+date+"/"+type+"/"+valsearch, '_blank');
            win.focus();
        }
        if(type!='excel'){
            $("#showingdata").html("Loading Catch Data");
            $.ajax({
                url: "<?php echo base_url('/admin/report_excel/') ?>"+date+"/"+type+"/"+valsearch,
                contentType: false,
                cache: true,
                processData: false,
                success: function(data) {
                    $("#showingdata").html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#showingdata").html("<p class='ajaxloadingdata'>Error Catching Data</p>");
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
    }
</script>