<style>
    .loader {
        border: 20px solid #f3f3f3;
        border-radius: 50%;
        border-top: 20px solid #3498db;
        width: 35px;
        height: 35px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Packing List</h1>
          <h2 class="">Packing List...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">Packing List</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->

            <div class="row">
                <div class="col-md-2">
                    <select class="form-control" name="brands[]" id="brands" multiple data-placeholder="Select Brands">
                        <?php foreach ($brands as $v){
                            if($v['brand'] != ''){
                                ?>
                                <option value="<?php echo "'".$v['brand']."'"?>"><?php echo $v['brand']?></option>
                                <?php
                            }
                        } ?>
                    </select>
                    <br />
                    <span><b>* Select Brands </b></span>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="po_type[]" id="po_type" onchange="getShipDateLists();">
                        <option value="">PO Type...</option>
                        <option value="0">Bulk</option>
                        <option value="1">Size Set</option>
                        <option value="2">Sample</option>
                    </select>
                    <br />
                    <span><b>* Select PO Type </b></span>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="ship_date" id="ship_date">
                        <option value="">Ship Date...</option>
                    </select>
                    <br />
                    <span><b>* Select Ship Date </b></span>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="packing_list_type" id="packing_list_type">
                        <option value="">Packing List Type</option>
                        <option value="1">Type-1</option>
                        <option value="2">Type-2</option>
                    </select>
                    <br />
                    <span><b>* Select Packing List Type </b></span>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-success" id="generate_btn" onclick="generatePackingList();">Generate</button>
                </div>
                <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                <div class="col-md-2">
                    <button class="btn btn-warning" onclick="refreshManualQtyAsPerformance();"><i class="fa fa-refresh" aria-hidden="true"></i> Performance-Qty</button>
                </div>
            </div>
          <br />
          <div class="row">
              <div class="col-md-1">
                  <button class="btn btn-primary" style="color: #FFF;" id="btnExport123" onclick="ExportToExcel('table_id')"><b>Export Excel</b></button>
              </div>
<!--              <div class="col-md-1">-->
<!--                  <button type="button" onclick="printDiv('packing_list')" class="print_cl_btn" style="border-style: none; width: 80px; height: 30px; background-color: green; color: white; border-radius: 5px;">Print</button>-->
<!--              </div>-->
          </div>
          <br />
            <div class="row">
                <div class="col-md-12">
                    <div class="block-web">

                        <div class="porlets-content">

                            <div id="packing_list">

                            </div><!--/table-responsive-->
                        </div>

                    </div><!--/porlets-content-->
                </div><!--/block-web-->
            </div><!--/col-md-12-->

      </div>

<script type="text/javascript">

    $('select').select2();

    function getShipDateLists() {
        var brands = $("#brands").val();
        var po_type = $("#po_type").val();

        var brands_length = (brands != null ? brands.length : 0);

        $("#ship_date").empty();

        if(brands_length > 0 && po_type != ''){
            $.ajax({
                url: "<?php echo base_url();?>access/getShipDateLists/",
                type: "POST",
                data: {brands: brands, po_type: po_type},
                dataType: "html",
                success: function (data) {

                    $("#ship_date").append(data);

                }
            });
        }else {
            alert('Please Select Brand and PO Type !');
            location.reload();
        }

    }
    
    function generatePackingList() {
        var brands = $("#brands").val();
        var po_type = $("#po_type").val();
        var ship_date = $("#ship_date").val();
        var packing_list_type = $("#packing_list_type").val();

        var brands_length = (brands != null ? brands.length : 0);

        $("#packing_list").empty();

        if(brands_length > 0 && po_type != '' && ship_date != '' && packing_list_type != ''){

            if(packing_list_type == 1){
                $("#loader").css('display', 'block');

                $.ajax({
                    url: "<?php echo base_url();?>access/generatePackingList/",
                    type: "POST",
                    data: {brands: brands, po_type: po_type, ship_date: ship_date},
                    dataType: "html",
                    success: function (data) {

                        $("#packing_list").append(data);
                        $("#loader").css('display', 'none');

                    }
                });
            }

            if(packing_list_type == 2){
                $("#loader").css('display', 'block');

                $.ajax({
                    url: "<?php echo base_url();?>access/generatePackingList2/",
                    type: "POST",
                    data: {brands: brands, po_type: po_type, ship_date: ship_date},
                    dataType: "html",
                    success: function (data) {

                        $("#packing_list").append(data);
                        $("#loader").css('display', 'none');

                    }
                });
            }

        }else{
            alert("Please Select Brand, PO Type, Ship Date, Packing List Type !");
        }

    }

    function refreshManualQtyAsPerformance() {
        $("#loader").css('display', 'block');

        $.ajax({
            url: "<?php echo base_url();?>access/refreshManualQtyAsPerformance/",
            type: "POST",
            data: {},
            dataType: "html",
            success: function (data) {

                if(data='done'){
                    $("#loader").css('display', 'none');
                    alert("Manual Qty is Adjusted with Today's Performance!");
                }

            }
        });
    }
    
    function ExportToExcel(tableid) {

        $(".size_carton_quantity").css('background-color', '#ffffff');
        $(".size_carton_quantity").css('color', '#000000');

        $(".carton").css('display', 'none');
        $(".carton_span").css('display', 'block');

        $(".net_weight_single_carton").css('display', 'none');
        $(".gross_weight_single_carton").css('display', 'none');

        $(".minus_sign").css('display', 'none');
        $("a.qty").contents().unwrap();

        var tab_text = "<table border='2px'><tr>";
        var textRange; var j = 0;
        tab = document.getElementById(tableid);//.getElementsByTagName('table'); // id of table
        if (tab==null) {
            return false;
        }
        if (tab.rows.length == 0) {
            return false;
        }

        for (j = 0 ; j < tab.rows.length ; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "download.xls");
        }
        else                 //other browser not tested on IE 11
        //sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            try {
                var blob = new Blob([tab_text], { type: "application/vnd.ms-excel" });
                window.URL = window.URL || window.webkitURL;
                link = window.URL.createObjectURL(blob);
                a = document.createElement("a");
                if (document.getElementById("caption")!=null) {
                    a.download=document.getElementById("caption").innerText;
                }
                else
                {
                    a.download = 'download';
                }

                a.href = link;

                document.body.appendChild(a);

                a.click();

                document.body.removeChild(a);
            } catch (e) {
            }

        document.getElementById('generate_btn').click();

        return false;
        //return (sa);
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

        location.reload();
    }

</script>