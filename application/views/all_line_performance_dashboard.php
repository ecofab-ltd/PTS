<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="refresh" content="120">
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />
    <!--Canvas Chart Asset Start-->
    <script src="<?php echo base_url(); ?>assets/js/canvas_chart/canvasjs.min.js"></script>
    <!--Canvas Chart Asset End-->
</head>
<body>
<div id="chartContainer" style="height: 560px; width: 100%;"></div>
</body>
</html>

<script type="text/javascript">
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "EcoFab Line Report: <?php echo date('Y-m-d');?>"
            },
            axisX: {
                valueFormatString: ""
            },
            axisY: {
                prefix: "",
                labelFormatter: addSymbols
            },
//                toolTip: {
//                    shared: true
//                }
//                ,
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            data: [
                {
                    type: "column",
                    name: "Target",
                    showInLegend: true,
                    color: "#d8cf27",
                    indexLabelFontSize: 16,
                    indexLabelOrientation: "vertical",
                    xValueFormatString: "Target",
                    yValueFormatString: "#,##0",
                    dataPoints: [
//                            { x: 01, y: 1000 },
//                            { x: 02, y: 700 },
//                            { x: 03, y: 750 },
//                            { x: 04, y: 600 },
//                            { x: 05, y: 650 },
//                            { x: 06, y: 550 },
//                            { x: 07, y: 500 },
//                            { x: 08, y: 700 },
//                            { x: 09, y: 600 },
//                            { x: 10, y:  550 },
//                            { x: 11, y: 600 },
//                            { x: 12, y: 650 },
//                            { x: 13, y: 650 },
//                            { x: 14, y: 650 },
//                            { x: 15, y: 650 },
//                            { x: 16, y: 650 },
//                            { x: 17, y: 650 },
//                            { x: 18, y: 650 }

                        <?php foreach ($line_report as $k_1 => $v_1){ ?>
                        { label: "<?php echo $v_1['line_code'];?>", y: <?php echo $v_1['target'];?>, indexLabel: "<?php echo $v_1['target'];?>" },
                        <?php } ?>
                    ]
                },
                {
                    type: "column",
                    name: "Actual",
                    showInLegend: true,
                    color: "GREEN",
                    indexLabelFontSize: 16,
                    indexLabelOrientation: "vertical",
                    xValueFormatString: "Actual",
                    yValueFormatString: "##0",
                    dataPoints: [
//                            { x: 01, y: 500 },
//                            { x: 02, y: 400 },
//                            { x: 03, y: 600 },
//                            { x: 04, y: 300 },
//                            { x: 05, y: 100 },
//                            { x: 06, y: 650 },
//                            { x: 07, y: 450 },
//                            { x: 08, y: 400 },
//                            { x: 09, y: 550 },
//                            { x: 10, y:  500 },
//                            { x: 11, y: 546 },
//                            { x: 12, y: 233 },
//                            { x: 13, y: 233 },
//                            { x: 14, y: 233 },
//                            { x: 15, y: 233 },
//                            { x: 16, y: 233 },
//                            { x: 17, y: 233 },
//                            { x: 18, y: 233 }

                        <?php foreach ($line_report as $k_1 => $v_1){ ?>
                        { label: "<?php echo $v_1['line_code'];?>", y: <?php echo $v_1['total_output_qty'];?>, indexLabel: "<?php echo $v_1['total_output_qty'];?>" },
                        <?php } ?>

                    ]
                },
                {
                    type: "line",
                    name: "Efficiency",
                    indexLabelFontColor: "blue",
                    indexLabelFontWeight: "bold",
                    indexLabelFontSize: 20,
                    showInLegend: true,
                    indexLabelOrientation: "vertical",
                    xValueFormatString: "Efficiency",
                    yValueFormatString: "00.00#",
                    dataPoints: [
//                            { x: 01, y: 455, indexLabel: "45.50" },
//                            { x: 02, y: 400, indexLabel: "40" },
//                            { x: 03, y: 414.2, indexLabel: "41.42" },
//                            { x: 04, y: 355.6, indexLabel: "35.56" },
//                            { x: 05, y: 342, indexLabel: "34.20" },
//                            { x: 06, y: 278, indexLabel: "27.80" },
//                            { x: 07, y: 325, indexLabel: "32.50" },
//                            { x: 08, y: 422, indexLabel: "42.20" },
//                            { x: 09, y: 435, indexLabel: "43.50" },
//                            { x: 10, y: 506.1, indexLabel: "50.61" },
//                            { x: 11, y: 304, indexLabel: "30.40" },
//                            { x: 12, y: 387, indexLabel: "38.70" },
//                            { x: 13, y: 387, indexLabel: "38.70" },
//                            { x: 14, y: 387, indexLabel: "38.70" },
//                            { x: 15, y: 387, indexLabel: "38.70" },
//                            { x: 16, y: 387, indexLabel: "38.70" },
//                            { x: 17, y: 387, indexLabel: "38.70" },
//                            { x: 18, y: 387, indexLabel: "38.70" }

                        <?php foreach ($line_report as $k_1 => $v_1){

                        ?>
                        { label: "<?php echo $v_1['line_code'];?>", y: <?php echo ($v_1['efficiency'] * 10);?>, indexLabel: "<?php echo $v_1['efficiency'];?>" },
                        <?php } ?>
                    ]
                }]
        });
        chart.render();

        function addSymbols(e) {
            var suffixes = ["", "K", "M", "B"];
            var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

            if(order > suffixes.length - 1)
                order = suffixes.length - 1;

            var suffix = suffixes[order];
            return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

        function toggleDataSeries(e) {
            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            e.chart.render();
        }

    }
</script>