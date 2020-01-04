<br />
<div class="row">
    <div class="col-md-1">
        <button class="btn btn-primary" style="color: #FFF;" id="btnExport"><b>Export Excel</b></button>
    </div>
    <div class="col-md-1">
        <button type="button" onclick="printDiv('print_div')" class="print_cl_btn" style="border-style: none; width: 80px; height: 30px; background-color: green; color: white; border-radius: 5px;">Print</button>
    </div>
</div>
<br />
<div class="row">
    <div class="col-md-12" id="print_div">
        <div class="block-web" id="tableWrap" style="overflow-x:auto;">
            <table class="display table table-bordered table-striped" id="" border="1">
                <thead>
                <tr>
                    <th class="hidden-phone center" colspan="9"><h4>Package Ready Detail Report</h4></th>
                    <!--                    <th class="hidden-phone center" colspan="0">Total Status</th>-->
                    <th class="hidden-phone center" colspan="1"><h4><?php echo $date;?></h4></th>
                </tr>
                <tr>
                    <th class="hidden-phone center">Brand</th>
                    <th class="hidden-phone center">Purchase Order</th>
                    <th class="hidden-phone center">Item</th>
                    <th class="hidden-phone center">Style</th>
                    <th class="hidden-phone center">Quality</th>
                    <th class="hidden-phone center">Color</th>
                    <th class="hidden-phone center">Ex-Fac</th>
                    <th class="hidden-phone center">Order</th>
                    <th class="hidden-phone center">Cut</th>
                    <!--                    <th class="hidden-phone center">Total Body Pass</th>-->
                    <!--                    <th class="hidden-phone center">BLNC</th>-->
                    <!--                    <th class="hidden-phone center">Collar</th>-->
                    <!--                    <th class="hidden-phone center">Collar BLNC</th>-->
                    <!--                    <th class="hidden-phone center">Cuff</th>-->
                    <!--                    <th class="hidden-phone center">Cuff BLNC</th>-->
                    <th class="hidden-phone center">Package Ready Qty</th>
                    <!--                    <th class="hidden-phone center">COLLAR</th>-->
                    <!--                    <th class="hidden-phone center">CUFF</th>-->
                </tr>
                </thead>

                <tbody>
                <?php

                $total_today_cutting_pass = 0;
                $total_today_cut_collar_pass = 0;
                $total_today_cut_cuff_pass = 0;
                $total_order_qty = 0;
                $total_cut_qty = 0;
                $total_cutting_pass_balance = 0;
                $total_cutting_collar_pass_balance = 0;
                $total_cutting_cuff_pass_balance = 0;

                foreach ($cut_report as $v){
                $cutting_pass_balance = $v['total_cut_qty'] - $v['total_cut_pass_qty'];
                $cutting_collar_pass_balance = $v['total_cut_qty'] - $v['cut_collar_bundle_ready'];
                $cutting_cuff_pass_balance = $v['total_cut_qty'] - $v['cut_cuff_bundle_ready'];

                $total_today_cutting_pass += $v['count_package_ready_qty'];
                $total_order_qty += $v['total_order_qty'];
                $total_cut_qty += $v['total_cut_qty'];
                //                    $total_today_cut_collar_pass += $v['today_cut_collar_bundle_ready'];
                //                    $total_today_cut_cuff_pass += $v['today_cut_cuff_bundle_ready'];

                $total_cutting_pass_balance += $count_package_ready_qty;
                $total_cutting_collar_pass_balance += $cutting_collar_pass_balance;
                $total_cutting_cuff_pass_balance += $cutting_cuff_pass_balance;
                ?>
                <tr>
                    <td class="center"><?php echo $v['brand'];?></td>
                    <td class="center"><?php echo $v['purchase_order'];?></td>
                    <td class="center"><?php echo $v['item'];?></td>
                    <td class="center"><?php echo $v['style_no'].'-'.$v['style_name'];?></td>
                    <td class="center"><?php echo $v['quality'];?></td>
                    <td class="center"><?php echo $v['color'];?></td>
                    <td class="center"><?php echo $v['ex_factory_date']; ?></td>
                    <td class="center"><?php echo $v['total_order_qty'];?></td>
                    <td class="center"><?php echo $v['total_cut_qty'];?></td>
                    <td class="center"><?php echo $v['count_package_ready_qty'];?></td>
                    <!--                    <td class="center">--><?php //echo $cutting_pass_balance;?><!--</td>-->
                    <!--                    <td class="center">--><?php //echo $v['cut_collar_bundle_ready'];?><!--</td>-->
                    <!--                    <td class="center">--><?php //echo $cutting_collar_pass_balance;?><!--</td>-->
                    <!--                    <td class="center">--><?php //echo $v['cut_cuff_bundle_ready'];?><!--</td>-->
                    <!--                    <td class="center">--><?php //echo $cutting_cuff_pass_balance;?><!--</td>-->
                    <!--                    <td class="center">--><?php //echo $v['cut_pass_qty'];?><!--</td>-->
                    <!--                    <td class="center">--><?php //echo $v['today_cut_collar_bundle_ready'];?><!--</td>-->
                    <!--                    <td class="center">--><?php //echo $v['today_cut_cuff_bundle_ready'];?><!--</td>-->
                    <!--                </tr>-->

                    <?php
                    }
                    ?>

                </tbody>

                <tfoot>
                <tr>
                    <td class="" align="right" colspan="7"><h5><b>Total Qty</b></h5></td>
                    <!--                        <td class="center"><h5><b>--><?php //echo $total_cutting_pass_balance;?><!--</b></h5></td>-->
                    <!--                        <td class="center"></td>-->
                    <!--                        <td class="center"><h5><b>--><?php //echo $total_cutting_collar_pass_balance;?><!--</b></h5></td>-->
                    <!--                        <td class="center"></td>-->
                    <!--                        <td class="center"><h5><b>--><?php //echo $total_cutting_cuff_pass_balance;?><!--</b></h5></td>-->
                    <td class="center"><h5><b><?php echo $total_order_qty;?></b></h5></td>
                    <td class="center"><h5><b><?php echo $total_cut_qty;?></b></h5></td>
                    <td class="center"><h5><b><?php echo $total_today_cutting_pass;?></b></h5></td>
                    <!--                        <td class="center"><h5><b>--><?php //echo $total_today_cut_collar_pass;?><!--</b></h5></td>-->
                    <!--                        <td class="center"><h5><b>--><?php //echo $total_today_cut_cuff_pass;?><!--</b></h5></td>-->
                    <!--                    </tr>-->
                </tfoot>

            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#btnExport').click(function(){
            var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#tableWrap').html())
            location.href=url
            return false
        })
    })

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>