<div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>AQL Plan</h1>
          <h2 class="">AQL Plan...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li class="active">AQL Plan</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row center">
        <div class="col-lg-12 ">
        <section class="panel default green_title h2">
        <div class="panel-heading border"></div>
        <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>access/saveAqlPlan" method="post">
        <div style="padding-top:10px">
                <h6 style="color:red">
                    <?php
                    $exc = $this->session->userdata('exception');
                    if (isset($exc)) {
                        echo $exc;
                        $this->session->unset_userdata('exception');
                    }
                    ?>
                </h6>

                <h6 style="color:green">
                    <?php
                    $msg = $this->session->userdata('message');
                    if (isset($msg)) {
                        echo $msg;
                        $this->session->unset_userdata('message');
                    }
                    ?>
                </h6>
            </div>
        <div class="porlets-content">
            <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Sales Order</b> <span style="color: red;">*</span></label>
                  <div class="col-md-4">
                      <select name="sales_order" id="sales_order" class="form-control" onchange="getSoInfo();" required>
                          <option value="">SO_PO_Item_Quality_Color_StyleNo_ExFacDate_Type</option>
                          <?php foreach ($so_list as $v_so){

                              $po_type = '';

                              if($v_so['po_type'] == 0){
                                  $po_type = 'BULK';
                              }

                              if($v_so['po_type'] == 1){
                                  $po_type = 'SIZE SET';
                              }

                              if($v_so['po_type'] == 2){
                                  $po_type = 'SAMPLE';
                              }
                          ?>
                              <option value="<?php echo $v_so['so_no'];?>">
                                  <?php echo $v_so['so_no'].'_'.$v_so['purchase_order'].'_'.$v_so['item'].'_'.$v_so['quality'].'_'.$v_so['color'].'_'.$v_so['style_no'].'_'.$v_so['approved_ex_factory_date'].'_'.$po_type;?>
                              </option>
                          <?php } ?>
                      </select>
                      <p style="font-size: 11px; padding: 5px;">* SO_PO_Item_Quality_Color_StyleNo_ExFacDate_Type</p>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>PO</b> <span style="color: red;">*</span></label>
                  <div class="col-md-4">
                      <input type="text" name="po" id="po" class="form-control" readonly required />
                  </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>ITEM</b> <span style="color: red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="item" id="item" class="form-control" readonly required />
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <label class="col-md-2"><b>Quality</b> <span style="color: red;">*</span></label>
                  <div class="col-md-4">
                      <input type="text" name="quality" id="quality" class="form-control" readonly required />
                  </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Color</b> <span style="color: red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="color" id="color" class="form-control" readonly required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Style No</b> <span style="color: red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="style_no" id="style_no" class="form-control" readonly required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Style Name</b> <span style="color: red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="style_name" id="style_name" class="form-control" readonly required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>AQL Date</b> <span style="color: red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" id="aql_plan_date" name="aql_plan_date" required="required" readonly="readonly" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-2"><b>Ready for AQL?</b></label>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-control" id="ready_for_aql" name="ready_for_aql" value="1" />
                        </div>
                    </div>
                </div>
            <br />

         
        <div class="row">
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                    <button class="btn btn-primary" id="submit_btn">SAVE</button>
                </div>
            </div>
        </div><br />
        </form>
        </section>
        </div>
            
        </div>
        
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    
    <script type="text/javascript">
        $('select').select2();

        function getSoInfo() {
            var sales_order = $("#sales_order").val();

            $("#po").empty();
            $("#item").empty();
            $("#quality").empty();
            $("#color").empty();
            $("#style_no").empty();
            $("#style_name").empty();
            $("#smv").empty();

            $("#ready_for_aql").attr('checked', false);

            if(sales_order != ''){
                $.ajax({
                    url: "<?php echo base_url();?>access/getSoInfo/",
                    type: "POST",
                    data: {sales_order: sales_order},
                    dataType: "json",
                    success: function (data) {
                        $("#po").val(data[0].purchase_order);
                        $("#item").val(data[0].item);
                        $("#quality").val(data[0].quality);
                        $("#color").val(data[0].color);
                        $("#style_no").val(data[0].style_no);
                        $("#style_name").val(data[0].style_name);

                        if(data[0].is_ready_for_aql == 1){
                            $("#ready_for_aql").attr('checked', true);
                        }

                        var aql_pln_dt = data[0].aql_plan_date;
                        var aql_pln_dt_array = aql_pln_dt.split("-");

                        var yr = aql_pln_dt_array[0];
                        var mon = aql_pln_dt_array[1];
                        var dt = aql_pln_dt_array[2];

                        var aql_plan_date = mon+'-'+dt+'-'+yr;

                        $("#aql_plan_date").val(aql_plan_date);
                    }
                });
            }
        }

        function resetAqlDate() {
            $("#aql_plan_date").val('00-00-0000');
        }
    </script>