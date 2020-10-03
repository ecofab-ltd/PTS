<style>
    .loader {
        border: 20px solid #f3f3f3;
        border-radius: 50%;
        border-top: 20px solid #3498db;
        width: 20px;
        height: 20px;
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
          <h1>Machine List</h1>
          <h2 class="">Machine List...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">Machine List</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
          <div class="header">
              <div class="actions">
                  <div class="row">
                      <div class="col-md-2">
                          <select required class="form-control" id="machine_no" name="machine_no">
                              <option value="">Machine</option>

                              <?php foreach ($machine_nos as $mno){ ?>
                                  <option value="<?php echo $mno['machine_no']?>"><?php echo $mno['machine_no'];?></option>
                              <?php } ?>

                          </select>
                      </div>
                      <div class="col-md-2">
                          <select required class="form-control" id="model" name="model">
                              <option value="">Model</option>

                              <?php foreach ($machine_models as $m){ ?>
                                  <option value="<?php echo $m['model_no']?>"><?php echo $m['model_no'];?></option>
                              <?php } ?>

                          </select>
                      </div>
                      <div class="col-md-1">
                          <select required class="form-control" id="line_id" name="line_id">
                              <option value="">Line</option>

                              <?php foreach ($lines as $l){ ?>
                                  <option value="<?php echo $l['id']?>"><?php echo $l['line_code'];?></option>
                              <?php } ?>

                          </select>
                      </div>
                      <div class="col-md-1">
                          <input type="text" autocomplete="off" name="other_location" id="other_location" placeholder="Other Location">
                      </div>
                      <div class="col-md-1 text-right">
                          <span class="btn btn-primary" onclick="filterMachineList();">SEARCH</span>
                      </div>
                      <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                      <div class="col-md-3"></div>
                      <div class="col-md-1">
                          <div class="table-responsive">
                              <table class="display" id="">
                                  <thead>
                                  <tr>
                                      <!--                                <th class="hidden-phone center"><a target="_blank" href="--><?php //echo base_url();?><!--dashboard/poWiseCuttingReport" class="btn btn-danger">Cutting</a></th>-->
                                      <th class="hidden-phone center">
                                          <span class="btn btn-success"><i class="fa fa-plus"></i> Machine</span>
                                      </th>
                                      <th class="hidden-phone center">
                                          <span class="btn btn-default" id="btnExport123" onclick="ExportToExcel('table_id')">
                                                <i class="fa fa-arrow-down"></i> <b> EXCEL</b>
                                          </span>
                                      </th>
                                  </tr>
                                  </thead>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="block-web" style="overflow-x:auto;">
              <table class="display table table-bordered table-striped" id="table_id" border="1">
                  <thead>
                      <tr style="font-size: 16px;">
                          <th class="hidden-phone center">SL.</th>
                          <th class="hidden-phone center">Machine No</th>
                          <th class="hidden-phone center">Machine Description</th>
                          <th class="hidden-phone center">Model</th>
                          <th class="hidden-phone center">Line</th>
                          <th class="hidden-phone center">Other Location</th>
                          <th class="hidden-phone center">Status</th>
                          <th class="hidden-phone center">Service Status</th>
                          <th class="hidden-phone center">Action</th>
                      </tr>
                  </thead>

                  <tbody id="table_body">
                  <?php

                  $sl=1;

                  foreach ($machine_list as $v){ ?>

                      <tr>
                          <td class="center"><?php echo $sl; $sl++;?></td>
                          <td class="center"><?php echo $v['machine_no'];?></td>
                          <td class="center"><?php echo $v['machine_description'];?></td>
                          <td class="center"><?php echo $v['model_no'];?></td>
                          <td class="center"><?php echo $v['line_code'];?></td>
                          <td class="center"><?php echo $v['other_location'];?></td>
                          <td class="center"><?php echo ($v['status'] == 1 ? 'ACTIVE' : ($v['status'] == 0 ? 'INACTIVE' : '') );?></td>
                          <td class="center"><?php echo ($v['status'] == 1 ? 'RUNNING' : ($v['status'] == 2 ? 'UNDER MAINTENANCE' : '') );?></td>
                          <td class="center">
                              <a class="btn btn-warning" href="" title="EDIT"><i class="fa fa-edit"></i></a>
                          </td>
                      </tr>

                  <?php
                    }
                  ?>

                  </tbody>

              </table>
          </div>
      </div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>

            <div class="modal-body">
                <div class="col-md-3 scroll4">
                    <div class="porlets-content">
                        <div class="table-responsive" id="remain_cl_list">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <!--                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $('select').select2();

    function filterMachineList() {
        var machine_no = $("#machine_no").val();
        var model = $("#model").val();
        var line_id = $("#line_id").val();
        var other_location = $("#other_location").val();

        $("#table_body").empty();
        $("#loader").css("display", "block");

        $.ajax({
            url: "<?php echo base_url();?>access/filterMachineList/",
            type: "POST",
            data: {machine_no: machine_no, model: model, line_id: line_id, other_location: other_location},
            dataType: "html",
            success: function (data) {
                $("#table_body").append(data);
                $("#loader").css("display", "none");
            }
        });
    }

    function ExportToExcel(tableid) {
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


        return false;
        //return (sa);
    }

</script>