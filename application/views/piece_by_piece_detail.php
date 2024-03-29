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
        <h1>Piece By Piece Detail</h1>
        <h2 class="">Piece By Piece Detail...</h2>
    </div>
    <div class="pull-right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="active">Piece By Piece Detail</li>
        </ol>
    </div>
</div>
<div class="container clear_both padding_fix">
    <!--\\\\\\\ container  start \\\\\\-->
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">
                <div class="header">
                    <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                    <h3 class="content-header"></h3>
                </div>
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

                <?php
                    $sizes = [];

                    foreach ($pieces as $s){
                        array_push($sizes, $s['size']);
                    }

                $sizes = array_unique($sizes);
                ?>

                <div class="porlets-content">
                    <div class="row" style="text-align: left">
                        <div class="form-group">
                            <div class="col-md-2">
                                <select class="form-control select" id="last_scan" name="last_scan">
                                    <option value="">Select Last Scan</option>
                                    <option value="2">Line Input</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control select" id="size" name="size">
                                    <option value="">Select Size</option>

                                    <?php foreach ($sizes as $size){ ?>
                                        <option value="<?php echo $size?>"><?php echo $size?></option>
                                    <?php } ?>

                                </select>
                                <input type="hidden" name="so_no" id="so_no" value="<?php echo $so_no?>" readonly="readonly" />
                            </div>
                            <div class="col-md-1">
                                <span id="search_btn" class="btn btn-success" onclick="filterPieces()"><i class="fa fa-search"></i> SEARCH</span>
                            </div>
                            <div class="col-md-1" id="loader" style="display: none;"><div class="loader"></div></div>
                        </div>
                    </div>
                    <br />
                    <div class="row" style="text-align: left">
                        <div class="form-group">

                            <div class="col-md-4">
                                <button type="submit" id="save_btn" class="btn btn-danger" onclick="deletePieces()"><i class="fa fa-archive"></i> DELETE PIECES</button>
                                <span id="" class="btn btn-warning" onclick="updatePieceLastScanningPointModal()"><i class="fa fa-edit"></i> UPDATE LAST SCAN POINT</span>
                            </div>
                            <div class="col-md-4">
                                <h3>Total Selected:  <span id="count_select">0</span></h3>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <sec class="table-responsive">
                            <section class="panel default blue_title h2">

                                <div class="panel-body" id="table_content" style="overflow-x:auto;">

                                    <table class="display table table-bordered table-striped" id="" border="1">
                                        <thead>
                                            <tr>
                                                <th class="hidden-phone center"><input type="checkbox" id="checkAll"/></th>
                                                <th class="hidden-phone center">Piece No</th>
                                                <th class="hidden-phone center">Size</th>
                                                <th class="hidden-phone center">Last Scan</th>
                                                <th class="hidden-phone center">SO</th>
                                                <th class="hidden-phone center">Type</th>
                                                <th class="hidden-phone center">Brand</th>
                                                <th class="hidden-phone center">Purchase Order</th>
                                                <th class="hidden-phone center">Item</th>
                                                <th class="hidden-phone center">Style</th>
                                                <th class="hidden-phone center">Style Name</th>
                                                <th class="hidden-phone center">Quality</th>
                                                <th class="hidden-phone center">Color</th>
                                                <th class="hidden-phone center">ExFac</th>
                                                <th class="hidden-phone center">Cutting Package Ready?</th>
                                                <th class="hidden-phone center">Sent to Sew</th>
                                                <th class="hidden-phone center">Line</th>
                                                <th class="hidden-phone center">Line Input</th>
                                                <th class="hidden-phone center">Mid Pass</th>
                                                <th class="hidden-phone center">Line Output</th>
                                                <th class="hidden-phone center">Wash Sent</th>
                                                <th class="hidden-phone center">Wash Received</th>
                                                <th class="hidden-phone center">Poly</th>
                                                <th class="hidden-phone center">Carton</th>
                                                <th class="hidden-phone center">Close By Admin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($pieces as $p){ ?>
                                            <tr>
                                                <td class="center">
                                                    <input class="checkItem" type="checkbox" name="checkItem[]" id="checkItem" value="<?php echo $p['pc_tracking_no']?>">
<!--                                                    <a href="--><?php //echo base_url();?><!--access/deletePieceNo/--><?php //echo $p['pc_tracking_no'];?><!--" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">X</a>-->
                                                </td>
                                                <td class="center"><?php echo $p['pc_tracking_no'];?></td>
                                                <td class="center"><?php echo $p['size'];?></td>
                                                <td class="center">
                                                    <?php

                                                    $last_scanning_point = "";

                                                    if($p['warehouse_qa_type'] == 1){
                                                        $last_scanning_point = "Buyer Warehouse";
                                                    } elseif($p['warehouse_qa_type'] == 2){
                                                        $last_scanning_point = "Factory Warehouse";
                                                    } elseif($p['warehouse_qa_type'] == 3){
                                                        $last_scanning_point = "Trash";
                                                    } elseif($p['warehouse_qa_type'] == 4){
                                                        $last_scanning_point = "Production Sample Warehouse";
                                                    } elseif($p['warehouse_qa_type'] == 5){
                                                        $last_scanning_point = "Other Purpose";
                                                    } elseif($p['warehouse_qa_type'] == 6){
                                                        $last_scanning_point = "Lost";
                                                    } elseif($p['warehouse_qa_type'] == 7){
                                                        $last_scanning_point = "Size Set";
                                                    } elseif($p['carton_status'] == 1){
                                                        $last_scanning_point = "Carton";
                                                    } elseif($p['packing_status'] == 1){
                                                        $last_scanning_point = "Packing";
                                                    } elseif($p['washing_status'] == 1){
                                                        $last_scanning_point = "Wash Return";
                                                    } elseif($p['is_going_wash'] == 1){
                                                        $last_scanning_point = "Wash Send";
                                                    } elseif(($p['access_points'] == 4) && ($p['access_points_status'] == 4)){
                                                        $last_scanning_point = "End Line";
                                                    } elseif(($p['access_points'] == 4) && ($p['access_points_status'] == 2)){
                                                        $last_scanning_point = "Mid Line & End-Line Defect";
                                                    } elseif($p['access_points'] == 3){
                                                        $last_scanning_point = "Mid Line";
                                                    } elseif($p['access_points'] == 2){
                                                        $last_scanning_point = "Input Line";
                                                    } elseif($p['sent_to_production'] == 1){
                                                        $last_scanning_point = "Cutting";
                                                    } elseif($p['sent_to_production'] == 0){
                                                        $last_scanning_point = "Cutting not Sent";
                                                    }

                                                    echo $last_scanning_point;
                                                    ?>
                                                </td>
                                                <td class="center"><?php echo $p['so_no'];?></td>
                                                <td class="center">
                                                    <?php
                                                        if($p['po_type'] == 0){
                                                            echo 'BULK';
                                                        }
                                                        if($p['po_type'] == 1){
                                                            echo 'SIZE SET';
                                                        }
                                                        if($p['po_type'] == 2){
                                                            echo 'SAMPLE';
                                                        }
                                                    ?>
                                                </td>
                                                <td class="center"><?php echo $p['brand'];?></td>
                                                <td class="center"><?php echo $p['purchase_order'];?></td>
                                                <td class="center"><?php echo $p['item'];?></td>
                                                <td class="center"><?php echo $p['style_no'];?></td>
                                                <td class="center"><?php echo $p['style_name'];?></td>
                                                <td class="center"><?php echo $p['quality'];?></td>
                                                <td class="center"><?php echo $p['color'];?></td>
                                                <td class="center"><?php echo $p['ex_factory_date'];?></td>
                                                <td class="center"><?php echo ($p['is_package_ready'] == 1 ? 'YES' : 'NO');?></td>
                                                <td class="center"><?php echo $p['package_sent_to_production_date_time'];?></td>
                                                <td class="center"><?php echo $p['line_code'];?></td>
                                                <td class="center"><?php echo $p['line_input_date_time'];?></td>
                                                <td class="center"><?php echo $p['mid_line_qc_date_time'];?></td>
                                                <td class="center"><?php echo $p['end_line_qc_date_time'];?></td>
                                                <td class="center"><?php echo $p['going_wash_scan_date_time'];?></td>
                                                <td class="center"><?php echo $p['washing_date_time'];?></td>
                                                <td class="center"><?php echo $p['packing_date_time'];?></td>
                                                <td class="center"><?php echo $p['carton_date_time'];?></td>
                                                <td class="center">
                                                    <?php
                                                        if($p['manually_closed'] == 1){
                                                            echo 'Yes';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </sec>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Update Scanning Point</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Scanning Point:</label>
                    <select class="form-control" id="scanning_point" name="scanning_point">
                        <option value="">Select Scanning Point</option>
                        <option value="3">Line Mid QC Pass</option>
                        <option value="8">Line Collar-Cuff Package Ready</option>
<!--                        <option value="4">Line End QC Pass</option>-->
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <span class="btn btn-primary" onclick="updatePieceLastScanningPoint()">Update</span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.select').select2();

    $(document).on('click','#checkAll',function () {
        $('.checkItem').not(this).prop('checked', this.checked);

        var numberNotChecked = $('input[name="checkItem[]"]:checked').length;
        $("#count_select").text(numberNotChecked);
    });

    $(document).on('click','.checkItem',function () {
        var numberNotChecked = $('input[name="checkItem[]"]:checked').length;
        $("#count_select").text(numberNotChecked);
    });


    function deletePieces()
    {

        var pc_nos = [];

        $('input.checkItem:checkbox:checked').each(function () {
            var sThisVal = $(this).val();

            pc_nos.push(sThisVal);

        });

        var r = confirm('Are you sure to delete the pieces!');
        if(r == true){
            if(pc_nos !='')
            {
                $.ajax({
                    url:"<?php echo base_url('access/deleteMultiplePieceNosAtOnce')?>",
                    type:"post",
                    dataType:"html",
                    data:{pc_nos:pc_nos},
                    success:function (data) {
                        if(data == 'done'){
                            alert('Successfully Deleted!');
                            location.reload(true);
                        }
                    }
                });
            }else{
                alert('No Pieces Selected!');
            }
        }

    }
    
    function filterPieces() {
        var so_no = $("#so_no").val();
        var last_scan = $("#last_scan").val();
        var size = $("#size").val();

        $("#table_content").empty();
        $("#loader").css('display', 'block');

        $.ajax({
            url:"<?php echo base_url('access/filterPieces')?>",
            type:"post",
            dataType:"html",
            data:{so_no:so_no, last_scan: last_scan, size:size},
            success:function (data) {
                $("#table_content").append(data);
                $("#loader").css('display', 'none');
            }
        });
    }
    
    function updatePieceLastScanningPointModal() {
        $("#myModal").modal('show');
    }

    function updatePieceLastScanningPoint() {
        var scanning_point = $("#scanning_point").val();

        var pc_nos = [];

        $('input.checkItem:checkbox:checked').each(function () {
            var sThisVal = $(this).val();

            pc_nos.push(sThisVal);
        });

        if(pc_nos !='' && scanning_point != '')
        {
            $.ajax({
                url:"<?php echo base_url('access/updatePieceLastScanningPoint')?>",
                type:"post",
                dataType:"html",
                data:{scanning_point: scanning_point, pc_nos:pc_nos},
                success:function (data) {
                    console.log(data);

                    if(data == 'done'){
                        $("#myModal").modal('hide');
                        $("#search_btn").click();
                        $("#count_select").text(0);
                    }
                }
            });
        }
    }

</script>