<?php

$count_floor = 0;

$grand_total_target = 0;
$grand_total_output = 0;
$grand_sum_eff = 0;
$grand_average_eff = 0;
$grand_achievement_rate = 0;
$grand_wip = 0;

foreach ($floors as $v_f){

    $floor_id = $v_f['id'];

?>

<table class="display table table-bordered table-striped" id="">
    <thead>
    <tr style="background-color: #0A6EA0; color: #FFFFFF;">
        <th colspan="6" class="center"><h2><?php echo $v_f['floor_name'];?></h2></th>
    </tr>
    <tr style="background-color: #f7ffb0;">
        <th class="center">LINE</th>
        <th class="center">TARGET</th>
        <th class="center">TOTAL</th>
        <th class="center">EFFICIENCY</th>
        <th class="center">WIP</th>
        <th class="center">REMARKS</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $total_line_target=0;
    $total_line_output=0;
    $total_sum_efficiency=0;
    $total_wip=0;
    $count_lines=0;

    $line_prod = $this->method_call->getTodayLineProductionSummaryReport($search_date, $floor_id);
//    echo '<pre>';
//    print_r($line_prod);
//    echo '</pre>';
//    die();

    foreach ($line_prod as $v){

        $line_target = ($v['target'] != '' ? $v['target'] : 0);
        $line_output = ($v['total_line_output'] != '' ? $v['total_line_output'] : 0);
        $wip=$v['wip'];

        $total_line_target += $line_target;
        $total_line_output += $line_output;
        $total_wip += $wip;
        ?>
        <tr>
            <td class="center">
                <a class="btn btn-primary" target="_blank" href="<?php echo base_url()?>dashboard/getDailyPerformanceDetail/<?php echo $v['line_name'];?>/<?php echo $v['line_id'];?>/<?php echo $search_date;?>">
                    <?php echo $v['line_code'];?>
                </a>
            </td>
            <td class="center"><?php echo $line_target;?></td>
            <td class="center"><?php echo $line_output;?></td>
            <td class="center">
                <?php

                echo $line_efficiency = ($v['efficiency'] != '' ? $v['efficiency'] : "0.00");

                $total_sum_efficiency += $line_efficiency;

                if($v['total_line_output'] > 0){
                    $count_lines++;
                }
                ?>
            </td>
            <td class="center">
                <a target="_blank" href="<?php echo base_url();?>dashboard/lineWiseWipDetailReport/<?php echo $v['line_name'];?>/<?php echo $v['line_id'];?>/<?php echo $search_date;?>"><?php echo $v['wip'];?></a>
            </td>
            <td class="center"><?php echo $v['remarks']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <td align="center"><h5><b>Total</b></h5></td>
        <td align="center"><h5><b><?php echo $total_line_target;?></b></h5></td>
        <td align="center"><h5><b><?php echo $total_line_output;?></b></h5></td>
        <td align="center">
            <h5>
                <b>
                    <?php
                    $total_eff = $total_sum_efficiency / $count_lines;
                    echo $total_line_efficiency = sprintf('%0.2f', $total_eff);
                    ?>
                </b>
            </h5>
        </td>
        <td class="center"><?php echo $total_wip;?></td>
        <td class="center"></td>
    </tr>
    </tfoot>
</table>

<?php
    $count_floor++;

    $grand_total_target +=  $total_line_target;
    $grand_total_output +=  $total_line_output;
    $grand_wip +=  $total_wip;
    $grand_sum_eff += $total_eff;

}

?>

<table class="display table table-bordered table-striped" id="">

    <thead>
        <tr style="background-color: #04a401; color: #FFFFFF;">
            <th class="center" colspan="5"><h2>GRAND TOTAL</h2></th>
        </tr>
        <tr style="">
            <th class="center"><h5><b>TARGET</b></h5></th>
            <th class="center"><h5><b>OUTPUT</b></h5></th>
            <th class="center"><h5><b>WIP</b></h5></th>
            <th class="center"><h5><b>ACHIEVEMENT(%)</b></h5></th>
            <th class="center"><h5><b>EFFICIENCY</b></h5></th>
        </tr>
    </thead>
    <tbody>
        <tr style="">
            <td class="center"><h5><?php echo $grand_total_target;?></h5></td>
            <td class="center"><h5><?php echo $grand_total_output;?></h5></td>
            <td class="center"><h5><?php echo $grand_wip;?></h5></td>
            <td class="center">
                <h5>
                    <?php
                    $grand_achievement_rate = (($grand_total_output/$grand_total_target)*100);
                        echo round($grand_achievement_rate).' %';
                    ?>
                </h5>
            </td>
            <td class="center">
                <h5>
                    <?php
                    $grand_average_eff = ($grand_sum_eff/$count_floor);
                    echo round($grand_average_eff, 2);
                    ?>
                </h5>
            </td>
        </tr>
    </tbody>

</table>
