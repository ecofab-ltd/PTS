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
          <h1>Add New Machine</h1>
          <h2 class="">Add New Machine...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>">Home</a></li>
              <li><a href="<?php echo base_url();?>access/getMachineList">Machine List</a></li>
              <li class="active">Add New Machine</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
          <form action="<?php echo base_url();?>access/saveNewMachine" method="POST">
              <div class="row">
                  <div class="col-md-12">
                      <div class="block-web" style="overflow-x:auto;">
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
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="new_model" class="col-form-label">Model:</label>
                                      <br />
                                      <select class="form-control" id="model_no_id" name="model_no_id" required="required" onchange="getLastMachineNoByModel();">
                                          <option value="">Select Model</option>
                                          <?php foreach ($machine_models as $mm){ ?>
                                              <option value="<?php echo $mm['id']?>"><?php echo $mm['machine_model'];?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="new_description" class="col-form-label">Machine Name:</label>
                                      <br />
                                      <select class="form-control" id="machine_name_id" name="machine_name_id" required="required">
                                          <option value="">Select Machine Name</option>
                                          <?php foreach ($machine_names as $mn){ ?>
                                              <option value="<?php echo $mn['id']?>"><?php echo $mn['machine_name'];?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="new_machine_no" class="col-form-label">Machine No:</label>
                                      <input type="text" class="form-control" id="new_machine_no" name="new_machine_no" autocomplete="off" onblur="checkMachineAvailability()" required="required" readonly="readonly">
                                  </div>
                                  <div class="form-group">
                                      <label for="new_model" class="col-form-label">Brand:</label>
                                      <br />
                                      <select class="form-control" id="brand_id" name="brand_id" required="required">
                                          <option value="">Select Brand</option>
                                          <?php foreach ($machine_brands as $mb){ ?>
                                              <option value="<?php echo $mb['id']?>"><?php echo $mb['brand'];?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="new_line" class="col-form-label">Line:</label>
                                      <br />
                                      <select class="form-control select" id="line_id" name="line_id">
                                          <option value="">Select Line</option>
                                          <?php foreach ($lines as $l){ ?>
                                              <option value="<?php echo $l['id']?>"><?php echo $l['line_code'];?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="new_other_location" class="col-form-label">Other Location:</label>
                                      <br />
                                      <select class="form-control" id="other_location_id" name="other_location_id" required="required">
                                          <option value="">Select Other Location</option>
                                          <?php foreach ($other_locations as $ol){ ?>
                                              <option value="<?php echo $ol['id']?>"><?php echo $ol['location_name'];?></option>
                                          <?php } ?>
                                      </select>
                                  </div>

                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="new_service_status" class="col-form-label">Service Status:</label>
                                      <br />
                                      <select class="form-control" id="service_status" name="service_status" required="required">
                                          <option value="">Service Status</option>
                                          <option value="0">Out of Service</option>
                                          <option value="1">Running</option>
                                          <option value="2">Under Maintenance</option>
                                          <option value="3">Idle</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="new_status" class="col-form-label">Status:</label>
                                      <br />
                                      <select class="form-control" id="status" name="status" required="required">
                                          <option value="">Select Status</option>
                                          <option value="1">Active</option>
                                          <option value="0">Inactive</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="row">

                              <div class="col-md-6">
                                  <div class="form-group">
                                      <br />
                                      <button type="submit" class="btn btn-primary" id="modal_submit_btn">SAVE</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>

<script type="text/javascript">
    $('select').select2();

    function checkMachineAvailability() {
        var new_machine_no = $("#new_machine_no").val();

        $.ajax({
            url: "<?php echo base_url();?>access/checkMachineAvailability/",
            type: "POST",
            data: {new_machine_no: new_machine_no},
            dataType: "json",
            success: function (data) {

                if(data.length > 0){
                    alert('Machine No: '+new_machine_no+' Already Exist!');
                   $("#modal_submit_btn").attr('disabled', true);
               }else{
                   $("#modal_submit_btn").attr('disabled', false);
               }

            }
        });

    }
    
    function getLastMachineNoByModel() {
        var model_no_id = $("#model_no_id").val();
        var machine_model = $( "#model_no_id option:selected" ).text();

        if(model_no_id != ''){
            $.ajax({
                url: "<?php echo base_url();?>access/getLastMachineNoByModel/",
                type: "POST",
                data: {model_no_id: model_no_id},
                dataType: "json",
                success: function (data) {

                    if(data.length > 0){
                        var machine_no = parseInt(data[0].machine_qty_count) + 1;

                        var new_machine_no = (machine_model+'-'+machine_no+'.');

                        $("#new_machine_no").val(new_machine_no);
                    }else {
                        alert('No Data Found!');
                    }

                }
            });
        }else{
            alert('Please Select Machine Model!');
        }

    }

</script>