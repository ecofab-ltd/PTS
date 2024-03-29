<!DOCTYPE html>
<html>
<head>
    <style>
        table, td, th {
            border: 1px solid #ddd;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 2px;
        }


        body {font-family: Arial, Helvetica, sans-serif;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /*Loader Start*/
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
        /*Loader End*/
    </style>
</head>
<body>

<?php $hour_count = sizeof($hours);?>

<table id="" border="1" width="100%" style="border: 1px solid black;">
    <thead>
    <tr style="background-color: #f7ffb0;">
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">LINE</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 50px;">TAR.</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 60px;">Per/Hr</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">MP</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">Effi.</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">DHU</th>
        <th align="center" rowspan="2" style="font-size: 18px; font-weight: 900; width: 40px;">BRND</th>
        <th align="center" colspan="<?php echo $hour_count;?>" style="font-size: 20px; font-weight: 900;">HOURS</th>
        <!--            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">AVG</th>-->
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">AVG</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;" title="Manual Adjustment">Adjust</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">Total</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">BLNC</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">ProdMin</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">SMV</th>
        <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">WorkMin</th>
    </tr>
    <tr style="background-color: #f7ffb0;">
        <?php foreach ($hours as $h){ ?>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $h['hour']?></th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>

    <?php

    $man_power = 0;
    $grand_total_target = 0;
    $grand_total_output = 0;
    $grand_total_manual_output = 0;
    $grand_total_line_target_per_hour = 0;
    $grand_total_line_mp = 0;
    $grand_total_eff = 0;
    $grand_total_dhu = 0;
    $grand_average_eff = 0;
    $grand_average_dhu = 0;
    $grand_produce_min = 0;
    $grand_work_min = 0;

    $count_line = 0;
    $total_wh = 0;
    $total_work_min = 0;
    $total_produce_min = 0;

    $res_hour = $this->method_call->getHoursByTimeRange();
    $hour = $res_hour[0]['hour'];

    foreach ($lines AS $k => $line){

        $line_id = $line['id'];

        $line_info = $this->method_call->getLineTargetInfo($line_id);
        $line_rep = $this->method_call->getLineInfo($line_id);
        $dhu_summary = $this->method_call->getLineDHUSummary($line_id);

        $dhu = ($dhu_summary[0]['dhu'] != '' ? $dhu_summary[0]['dhu'] : 0);
        $brand = $dhu_summary[0]['brand'];

        $work_hour_1 = ($dhu_summary[0]['work_hour_1'] != '' ? $dhu_summary[0]['work_hour_1'] : 0);
        $work_hour_2 = ($dhu_summary[0]['work_hour_2'] != '' ? $dhu_summary[0]['work_hour_2'] : 0);
        $work_hour_3 = ($dhu_summary[0]['work_hour_3'] != '' ? $dhu_summary[0]['work_hour_3'] : 0);
        $work_hour_4 = ($dhu_summary[0]['work_hour_4'] != '' ? $dhu_summary[0]['work_hour_4'] : 0);

        $total_wh = $work_hour_1+$work_hour_2+$work_hour_3+$work_hour_4;

        $work_minute_1 = ($dhu_summary[0]['work_minute_1'] != '' ? $dhu_summary[0]['work_minute_1'] : 0);
        $work_minute_2 = ($dhu_summary[0]['work_minute_2'] != '' ? $dhu_summary[0]['work_minute_2'] : 0);
        $work_minute_3 = ($dhu_summary[0]['work_minute_3'] != '' ? $dhu_summary[0]['work_minute_3'] : 0);
        $work_minute_4 = ($dhu_summary[0]['work_minute_4'] != '' ? $dhu_summary[0]['work_minute_4'] : 0);

        $total_work_min = $work_minute_1+$work_minute_2+$work_minute_3+$work_minute_4;

        $produce_minute_1 = ($dhu_summary[0]['produce_minute_1'] != '' ? $dhu_summary[0]['produce_minute_1'] : 0);
        $produce_minute_2 = ($dhu_summary[0]['produce_minute_2'] != '' ? $dhu_summary[0]['produce_minute_2'] : 0);
        $produce_minute_3 = ($dhu_summary[0]['produce_minute_3'] != '' ? $dhu_summary[0]['produce_minute_3'] : 0);
        $produce_minute_4 = ($dhu_summary[0]['produce_minute_4'] != '' ? $dhu_summary[0]['produce_minute_4'] : 0);

        $total_produce_min = $produce_minute_1+$produce_minute_2+$produce_minute_3+$produce_minute_4;

//            $average_dhu = round($dhu_sum/$hour, 2);

        $line_target_hour = $line_info[0]['target_hour'];
        $line_target_per_hour = round($line_info[0]['target']/$line_target_hour);
        ?>
        <tr>
            <td align="center"><?php echo $line['line_code']; ?></td>
            <td align="center"><?php echo $line_info[0]['target'];?></td>
            <td align="center"><?php echo round($line_target_per_hour).' / '.$line_target_hour;?></td>
            <td align="center">
                <?php
                $segment_id = $this->method_call->getSegments($time, $line['floor']);

                if($segment_id == 1){
                    $man_power = $line_info[0]['man_power_1'];
                    echo $man_power;
                }
                if($segment_id == 2){
                    $man_power = $line_info[0]['man_power_2'];
                    echo $man_power;
                }
                if($segment_id == 3){
                    $man_power = $line_info[0]['man_power_3'];
                    echo $man_power;
                }
                if($segment_id == 4){
                    $man_power = $line_info[0]['man_power_4'];
                    echo $man_power;
                }
                ?>
            </td>
            <td align="center"><?php echo $line_rep[0]['efficiency'];?></td>
            <td align="center" id="myBtn" onclick="getDhuReport(<?php echo $line_id;?>);" style="cursor: pointer;">
                <?php echo $dhu;?>
            </td>
            <td align="center" style="font-size: 11px;">
                <?php echo $brand;?>
            </td>
            <?php
            $total_manual_output = 0;
            $total_output = 0;
            $total_output_balance = 0;

            foreach ($hours as $h){
                $line_report = $this->method_call->getLineHourlyReport($line_id, $h['hour']);

            if(!empty($line_report)) {
                foreach ($line_report AS $lr) {
                    ?>

                    <td align="center" title="<?php echo $lr['start_time'] . ' - ' . $lr['end_time']; ?>"
                        <?php
                        if ($lr['qty'] > 0) {

                            if ($lr['target_hr'] > $lr['qty']) {
                                ?>
                                style="background-color: #ff756f;"
                            <?php } else { ?>
                                style="background-color: #a4ff82;"
                            <?php }
                        } else { ?>
                            style="background-color: #FFFFFF;"
                            <?php
                        } ?>>
                        <?php
                        $line_output_qty = $lr['qty'] + $lr['manual_qty'];
                        $total_manual_output += $lr['manual_qty'];
                        $total_output += $line_output_qty;

                        $blnc = ($lr['target_hr'] - $lr['qty']);
                        $balance = round($blnc * (-1), 2);
                        echo $lr['qty'] . '(' . $balance . ')';
                        ?>
                    </td>

                    <?php
                    }
                }else{ ?>
                    <td align="center"></td>
                <?php }
            }
            $total_output_balance = $total_output - $line_info[0]['target'];

            //            $working_hour = ($total_wh-1)+$min_to_hour; // Getting Exact Current Production Hour-Minute
            ?>
            <!--            <td align="center">--><?php //echo round($total_output/$total_wm_to_wh, 2);?><!--</td>-->
            <td align="center" title="<?php echo $total_wh;?>">
                <?php

                $n = $total_wh;
                $whole = floor($n);      // 1
                $fraction = $n - $whole; // .25

                if($fraction > 0){
                    $whole = $whole + 1;
                }else{
                    $whole = $whole;
                }

                echo round($total_output/ $whole, 2);
                ?>
            </td>
            <td align="center" title="Manual Adjustment"><?php echo $total_manual_output;?></td>
            <td align="center" title="Manual Adjustment: <?php echo $total_manual_output;?>"><?php echo $total_output;?></td>
            <td align="center"><?php echo $total_output_balance;?></td>
            <td align="center"><?php echo $total_produce_min;?></td>
            <td align="center"><?php echo round($total_produce_min/$total_output, 2);?></td>
            <td align="center"><?php echo $total_work_min;?></td>
        </tr>

        <?php
        if($line_rep[0]['efficiency'] > 0){
            $count_line++;
        }
        $grand_total_target += $line_info[0]['target'];
        $grand_total_output += $total_output;
        $grand_total_manual_output += $total_manual_output;
        $grand_total_line_target_per_hour += $line_target_per_hour;
        $grand_total_line_mp += $man_power;
        $grand_total_eff += $line_rep[0]['efficiency'];
        $grand_total_dhu += $dhu;
        $grand_produce_min += $total_produce_min;
        $grand_work_min += $total_work_min;
    }

    $grand_average_eff = round($grand_total_eff/$count_line, 2);
    $grand_average_dhu = round($grand_total_dhu/$count_line, 2);
    ?>

    </tbody>
    <tfoot>
        <tr>
            <th align="center" style="font-size: 20px; font-weight: 900;">Total</th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_total_target?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo round($grand_total_line_target_per_hour);?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_total_line_mp;?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_average_eff;?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_average_dhu;?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo '';?></th>
            <?php
            foreach ($hours as $h_2){
                $hour_summary = $this->method_call->getHourlySummaryReport($h_2['hour']);

                ?>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $hour_summary[0]['total_hour_qty'];?></th>
                <?php

            }
            ?>

            <th align="center" title="<?php echo $working_hour;?>"><?php echo round($grand_total_output/$working_hour, 2);?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;" title="Manual Adjustment"><?php echo $grand_total_manual_output?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_total_output?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_total_output - $grand_total_target;?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_produce_min?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo round($grand_produce_min/$grand_total_output, 2);?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_work_min?></th>
        </tr>
    <?php

    foreach ($floors as $floor){
        $floor_line_target_per_hour = 0;

        $floor_total_target = 0;
        $floor_total_efficiency = 0;
        $floor_average_efficiency = 0;

        $floor_total_dhu = 0;
        $floor_average_dhu = 0;
        $floor_total_no_of_defect = 0;
        $floor_total_inspected_qty = 0;

        $floor_total_line_mp = 0;

        $floor_id = $floor['id'];

        $floor_lines_target = $this->method_call->getFloorWiseTargets($floor_id);
        $floor_eff = $this->method_call->getFloorSummaryReport($floor_id);

        $work_hour = round(($floor_eff[0]['work_hour'] != '' ? $floor_eff[0]['work_hour'] : 0), 2);

        $count_lines = 0;

        foreach ($floor_eff as $fe){
            if($fe['efficiency'] > 0){
                $floor_total_efficiency += $fe['efficiency'];
                $floor_total_dhu += $fe['dhu'];
                $floor_total_no_of_defect += $fe['total_no_of_defect'];
                $floor_total_inspected_qty += $fe['total_inspected_qty'];

                $count_lines++;
            }
        }

        foreach ($floor_lines_target as $fl){
            $floor_total_target += $fl['target'];
            $floor_line_target_per_hour += ($fl['target'] / $fl['target_hour']);

            $segment_id = $this->method_call->getSegments($time, $fl['floor']);

            if($segment_id == 1){
                $floor_total_line_mp += $fl['man_power_1'];
            }
            if($segment_id == 2){
                $floor_total_line_mp += $fl['man_power_2'];
            }
            if($segment_id == 3){
                $floor_total_line_mp += $fl['man_power_3'];
            }
            if($segment_id == 4){
                $floor_total_line_mp += $fl['man_power_4'];
            }
        }

        $floor_average_efficiency = round($floor_total_efficiency/$count_lines, 2);
        $floor_average_dhu = round(($floor_total_no_of_defect/$floor_total_inspected_qty)*100, 2);
//                        $floor_line_target_per_hour = $floor_total_target / 10;
        ?>
        <tr>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor['floor_name']?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_total_target?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo round($floor_line_target_per_hour);?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_total_line_mp?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_average_efficiency?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;" title="<?php echo 'Defects: '.$floor_total_no_of_defect.' Inspected: '.$floor_total_inspected_qty?>"><?php echo $floor_average_dhu;?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo ''?></th>
            <?php

            $floor_grand_total_output = 0;
            $floor_grand_total_manual_output = 0;
            foreach ($hours as $h_2){
                $floor_total_output = 0;
                $floor_total_produce_min = 0;
                $floor_total_work_min = 0;

                $floor_hour_summary = $this->method_call->getHourlyFloorSummaryReport($h_2['hour'], $floor_id);

//                foreach ($floor_hour_summary as $fhs){
//                    $floor_total_output += $fhs['line_qty'];
//                }

                $floor_total_output = $floor_hour_summary[0]['line_qty'];

                $floor_grand_total_output += ($floor_hour_summary[0]['line_qty'] + $floor_hour_summary[0]['line_manual_qty']);
                $floor_grand_total_manual_output += $floor_hour_summary[0]['line_manual_qty'];

                $floor_produce_minute_1 = ($floor_hour_summary[0]['floor_produce_minute_1'] != '' ? $floor_hour_summary[0]['floor_produce_minute_1'] : 0);
                $floor_produce_minute_2 = ($floor_hour_summary[0]['floor_produce_minute_2'] != '' ? $floor_hour_summary[0]['floor_produce_minute_2'] : 0);
                $floor_produce_minute_3 = ($floor_hour_summary[0]['floor_produce_minute_3'] != '' ? $floor_hour_summary[0]['floor_produce_minute_3'] : 0);
                $floor_produce_minute_4 = ($floor_hour_summary[0]['floor_produce_minute_4'] != '' ? $floor_hour_summary[0]['floor_produce_minute_4'] : 0);

                $floor_total_produce_min = round($floor_produce_minute_1+$floor_produce_minute_2+$floor_produce_minute_3+$floor_produce_minute_4, 2);

                $floor_work_minute_1 = ($floor_hour_summary[0]['floor_work_minute_1'] != '' ? $floor_hour_summary[0]['floor_work_minute_1'] : 0);
                $floor_work_minute_2 = ($floor_hour_summary[0]['floor_work_minute_2'] != '' ? $floor_hour_summary[0]['floor_work_minute_2'] : 0);
                $floor_work_minute_3 = ($floor_hour_summary[0]['floor_work_minute_3'] != '' ? $floor_hour_summary[0]['floor_work_minute_3'] : 0);
                $floor_work_minute_4 = ($floor_hour_summary[0]['floor_work_minute_4'] != '' ? $floor_hour_summary[0]['floor_work_minute_4'] : 0);

                $floor_total_work_min = round($floor_work_minute_1+$floor_work_minute_2+$floor_work_minute_3+$floor_work_minute_4, 2);
                ?>
                <th class="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_total_output;?></th>
                <?php

            }
            ?>
            <th align="center" title="<?php echo $work_hour;?>"><?php echo round($floor_grand_total_output/$work_hour, 2);?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;" title="Manual Adjustment"><?php echo $floor_grand_total_manual_output?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_grand_total_output?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_grand_total_output - $floor_total_target;?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_total_produce_min;?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo round($floor_total_produce_min/$floor_grand_total_output, 2);?></th>
            <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_total_work_min;?></th>
        </tr>
    <?php } ?>
    </tfoot>
</table>

</body>
</html>