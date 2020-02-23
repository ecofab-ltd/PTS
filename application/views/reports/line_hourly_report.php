<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="300">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />

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
    </style>
</head>
<body>
<table id="" border="1" width="100%" style="border: 1px solid black;">
        <thead>
        <tr style="background-color: #f7ffb0;">
            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">LINE</th>
            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 50px;">TARGET</th>
            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 60px;">Per/Hr</th>
            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">MP</th>
            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">Effi.</th>
            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">DHU</th>
            <th align="center" colspan="10" style="font-size: 20px; font-weight: 900;">HOURS</th>
            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">Total</th>
            <th align="center" rowspan="2" style="font-size: 20px; font-weight: 900; width: 40px;">BLNC</th>
        </tr>
        <tr style="background-color: #f7ffb0;">

            <th align="center" style="font-size: 20px; font-weight: 900;">1</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">2</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">3</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">4</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">5</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">6</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">7</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">8</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">9</th>
            <th align="center" style="font-size: 20px; font-weight: 900;">10</th>

        </tr>
        </thead>
        <tbody>

        <?php

        $man_power = 0;
        $grand_total_target = 0;
        $grand_total_output = 0;
        $grand_total_line_target_per_hour = 0;
        $grand_total_line_mp = 0;
        $grand_total_eff = 0;
        $grand_average_eff = 0;

        $count_line = 0;

        foreach ($lines AS $k => $line){

            $line_id = $line['id'];

            $line_info = $this->method_call->getLineTargetInfo($line_id);
            $line_rep = $this->method_call->getLineInfo($line_id);
            $dhu_summary = $this->method_call->getLineDHUSummary($line_id);

            $dhu_sum = ($dhu_summary[0]['dhu_sum'] != '' ? $dhu_summary[0]['dhu_sum'] : 0);
            $work_hour_1 = ($dhu_summary[0]['work_hour_1'] != '' ? $dhu_summary[0]['work_hour_1'] : 0);
            $work_hour_2 = ($dhu_summary[0]['work_hour_2'] != '' ? $dhu_summary[0]['work_hour_2'] : 0);
            $work_hour_3 = ($dhu_summary[0]['work_hour_3'] != '' ? $dhu_summary[0]['work_hour_3'] : 0);
            $work_hour_4 = ($dhu_summary[0]['work_hour_4'] != '' ? $dhu_summary[0]['work_hour_4'] : 0);

            $total_wh = $work_hour_1+$work_hour_2+$work_hour_3+$work_hour_4;
            $average_dhu = round($dhu_sum/$total_wh, 2);

            $line_target_hour = $line_info[0]['target_hour'];
            $line_target_per_hour = round($line_info[0]['target']/$line_target_hour);
        ?>
        <tr>
            <td align="center"><?php echo $line['line_code']; ?></td>
            <td align="center"><?php echo $line_info[0]['target'];?></td>
            <td align="center"><?php echo round($line_target_per_hour).' / '.$line_target_hour;?></td>
            <td align="center">
                <?php
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
            <td align="center"><?php echo $average_dhu;?></td>
            <?php
            $total_output = 0;
            $total_output_balance = 0;

            foreach ($hours as $h){
            $line_report = $this->method_call->getLineHourlyReport($line_id, $h['start_time'], $h['end_time']);

                foreach ($line_report AS $lr){
                ?>

                <td align="center"
                    <?php
                    if($lr['qty'] > 0){

                    if($line_target_per_hour > $lr['qty']){?>
                    style="background-color: rgba(255,117,111,0.8);"
                    <?php }else{ ?>
                    style="background-color: rgba(164,255,130,0.8);"
                    <?php }
                    }else { ?>
                    style="background-color: #FFFFFF;"
                    <?php
                    }?>>
                    <?php
                    $total_output += $lr['qty'];

                    $blnc = ($line_target_per_hour - $lr['qty']);
                    $balance = round($blnc * (-1), 2);
                    echo $lr['qty'].' ( '.$balance.' ) ';
                    ?>
                </td>

                <?php
                }
            }
            $total_output_balance = $total_output - $line_info[0]['target'];
            ?>
            <td align="center"><?php echo $total_output;?></td>
            <td align="center"><?php echo $total_output_balance;?></td>
        </tr>

        <?php
            $count_line++;

            $grand_total_target += $line_info[0]['target'];
            $grand_total_output += $total_output;
            $grand_total_line_target_per_hour += $line_target_per_hour;
            $grand_total_line_mp += $man_power;
            $grand_total_eff += $line_rep[0]['efficiency'];

        }

        $grand_average_eff = round($grand_total_eff/$count_line, 2);
        ?>

        </tbody>
            <tfoot>
            <tr>
                <th align="center" style="font-size: 20px; font-weight: 900;">Grand Total</th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_total_target?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo round($grand_total_line_target_per_hour);?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_total_line_mp?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_average_eff?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo ''?></th>
                <?php
                foreach ($hours as $h_2){
                    $hour_summary = $this->method_call->getHourlySummaryReport($h_2['start_time'], $h_2['end_time']);

                ?>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $hour_summary[0]['total_hour_qty'];?></th>
                <?php

                }
                ?>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_total_output?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $grand_total_output - $grand_total_target;?></th>
            </tr>
            <?php

            foreach ($floors as $floor){
                $floor_line_target_per_hour = 0;

                $floor_total_target = 0;
                $floor_total_efficiency = 0;
                $floor_average_efficiency = 0;

                $floor_total_line_mp = 0;

                $floor_id = $floor['id'];

                $floor_lines_target = $this->method_call->getFloorWiseTargets($floor_id);
                $floor_eff = $this->method_call->getFloorSummaryReport($floor_id);

                $count_lines = 0;

                foreach ($floor_eff as $fe){
                    $floor_total_efficiency += $fe['efficiency'];

//                            echo '<pre>';
//                            print_r($floor_total_efficiency);
//                            echo '</pre>';

                    $count_lines++;
                }

                foreach ($floor_lines_target as $fl){
                    $floor_total_target += $fl['target'];
                    $floor_line_target_per_hour += ($fl['target'] / $fl['target_hour']);

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
//                        $floor_line_target_per_hour = $floor_total_target / 10;
            ?>
            <tr>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor['floor_name']?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_total_target?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo round($floor_line_target_per_hour);?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_total_line_mp?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_average_efficiency?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo ''?></th>
                <?php

                $floor_grand_total_output = 0;
                foreach ($hours as $h_2){
                    $floor_total_output = 0;

                    $floor_hour_summary = $this->method_call->getHourlyFloorSummaryReport($h_2['start_time'], $h_2['end_time'], $floor_id);

                    foreach ($floor_hour_summary as $fhs){
                        $floor_total_output += $fhs['line_qty'];
                    }

                    $floor_grand_total_output += $floor_total_output;
                    ?>
                    <th class="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_total_output;?></th>
                    <?php

                }
                ?>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_grand_total_output?></th>
                <th align="center" style="font-size: 20px; font-weight: 900;"><?php echo $floor_grand_total_output - $floor_total_target;?></th>
            </tr>
            <?php } ?>
            </tfoot>
</table>
</body>
</html>