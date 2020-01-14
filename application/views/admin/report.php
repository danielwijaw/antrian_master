<link href="<?php echo base_url() ?>public/css/daterangepicker.css" rel="stylesheet">
<script src="<?php echo base_url() ?>public/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>public/js/daterangepicker.js"></script>
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">&nbsp;</div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            &nbsp;
                        </div>
                        <div class="col-md-6">
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
            <div class="col-md-12" style="overflow-y:scroll; height: 50vh">
                <div id="showingdata"></div>
            </div>
            <div style="display:none">
                <p id="catching_error"></p>
            </div>
        </div>
    </div>
</div>
<script>
    $('#datesearch').daterangepicker({ 
        locale: {
            format: 'Y-MM-DD'
        }
    });

    function exportdata(type){
        var date = $("#datesearch").val();
        if(type=='excel'){
            var win = window.open("<?php echo base_url('/admin/report_excel/') ?>"+date+"/"+type, '_blank');
            win.focus();
        }
        if(type!='excel'){
            $("#showingdata").html("Loading Catch Data");
            $.ajax({
                url: "<?php echo base_url('/admin/report_excel/') ?>"+date+"/"+type,
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