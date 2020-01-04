<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title ?></title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <script src="<?php echo base_url(); ?>assets/js/jquery-latest.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/css/jquery-1.9.0.js"></script>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/colorpicker.css" />
    <link href="<?php echo base_url(); ?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet" />

    <!--Select2 Start-->
    <script src="<?php echo base_url(); ?>assets/select2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/select2/select2.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/select2/select2.min.css" rel="stylesheet"/>

    <style type="text/css">

        .has-error .select2-selection {
            /*border: 1px solid #a94442;
            border-radius: 4px;*/
            border-color:rgb(185, 74, 72) !important;
        }

    </style>
    <!--Select2 End-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body class="light_theme  fixed_header atm-spmenu-push green_thm left_nav_hide">
<div class="wrapper">
    <!--\\\\\\\ wrapper Start \\\\\\-->
    <div class="header_bar">
        <!--\\\\\\\ header Start \\\\\\-->
        <div class="brand">
            <!--\\\\\\\ brand Start \\\\\\-->
            <div class="logo" style="display:block;">PTS Admin</div>
            <div class="small_logo" style="display:none"><img src="<?php echo base_url(); ?>assets/images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
        </div>
        <!--\\\\\\\ brand end \\\\\\-->
        <div class="header_top_bar">
            <!--\\\\\\\ header top bar start \\\\\\-->
            <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
            <div class="top_left">
                <div class="top_left_menu">
                    <ul>
                        <li> <a href="javascript:void(0);" onclick="window.location.reload(1);"> <i class="fa fa-repeat"></i> </a> </li>
                        <!--            <li> <a href="javascript:void(0);"> <i class="fa fa-th-large"></i> </a> </li>-->
                    </ul>
                </div>
            </div>
            <!--<a href="javascript:void(0);" class="add_user" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus-square"></i> <span> New Task</span> </a>-->
            <div class="top_right_bar">
                <div class="top_right">
                    <div class="top_right_menu">
                        <!--<ul>
                          <li class="dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"> Tasks <span class="badge badge">8</span> </a>
                            <ul class="drop_down_task dropdown-menu">
                              <div class="top_pointer"></div>
                              <li>
                                <p class="number">You have 7 pending tasks</p>
                              </li>
                              <li> <a href="task.html" class="task">
                                <div class="green_status task_height" style="width:80%;"></div>
                                <div class="task_head"> <span class="pull-left">Task Heading</span> <span class="pull-right green_label">80%</span> </div>
                                <div class="task_detail">Task details goes here</div>
                                </a> </li>
                              <li> <a href="task.html" class="task">
                                <div class="yellow_status task_height" style="width:50%;"></div>
                                <div class="task_head"> <span class="pull-left">Task Heading</span> <span class="pull-right yellow_label">50%</span> </div>
                                <div class="task_detail">Task details goes here</div>
                                </a> </li>
                              <li> <a href="task.html" class="task">
                                <div class="blue_status task_height" style="width:70%;"></div>
                                <div class="task_head"> <span class="pull-left">Task Heading</span> <span class="pull-right blue_label">70%</span> </div>
                                <div class="task_detail">Task details goes here</div>
                                </a> </li>
                              <li> <a href="task.html" class="task">
                                <div class="red_status task_height" style="width:85%;"></div>
                                <div class="task_head"> <span class="pull-left">Task Heading</span> <span class="pull-right red_label">85%</span> </div>
                                <div class="task_detail">Task details goes here</div>
                                </a> </li>
                              <li> <span class="new"> <a href="task.html" class="pull_left">Create New</a> <a href="task.html" class="pull-right">View All</a> </span> </li>
                            </ul>
                          </li>
                          <li class="dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"> Mail <span class="badge badge color_1">4</span> </a>
                            <ul class="drop_down_task dropdown-menu">
                              <div class="top_pointer"></div>
                              <li>
                                <p class="number">You have 4 mails</p>
                              </li>
                                  <li> <a href="readmail.html" class="mail"> <span class="photo"><img src="images/user.png" /></span> <span class="subject"> <span class="from">sarat m</span> <span class="time">just now</span> </span> <span class="message">Hello,this is an example msg.</span> </a> </li>
                              <li> <a href="readmail.html" class="mail"> <span class="photo"><img src="images/user.png" /></span> <span class="subject"> <span class="from">sarat m</span> <span class="time">just now</span> </span> <span class="message">Hello,this is an example msg.</span> </a> </li>
                              <li> <a href="readmail.html" class="mail red_color"> <span class="photo"><img src="images/user.png" /></span> <span class="subject"> <span class="from">sarat m</span> <span class="time">just now</span> </span> <span class="message">Hello,this is an example msg.</span> </a> </li>
                              <li> <a href="readmail.html" class="mail"> <span class="photo"><img src="images/user.png" /></span> <span class="subject"> <span class="from">sarat m</span> <span class="time">just now</span> </span> <span class="message">Hello,this is an example msg.</span> </a> </li>

                            </ul>
                          </li>
                          <li class="dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"> notification <span class="badge badge color_2">6</span> </a>
                            <div class="notification_drop_down dropdown-menu">
                              <div class="top_pointer"></div>
                              <div class="box"> <a href="inbox.html"> <span class="block primery_6"> <i class="fa fa-envelope-o"></i> </span> <span class="block_text">Mailbox</span> </a> </div>
                              <div class="box"> <a href="calendar.html"> <span class="block primery_2"> <i class="fa fa-calendar-o"></i> </span> <span class="block_text">Calendar</span> </a> </div>
                              <div class="box"> <a href="maps.html"> <span class="block primery_4"> <i class="fa fa-map-marker"></i> </span> <span class="block_text">Map</span> </a> </div>
                              <div class="box"> <a href="todo.html"> <span class="block primery_3"> <i class="fa fa-plane"></i> </span> <span class="block_text">To-Do</span> </a> </div>
                              <div class="box"> <a href="task.html"> <span class="block primery_5"> <i class="fa fa-picture-o"></i> </span> <span class="block_text">Tasks</span> </a> </div>
                              <div class="box"> <a href="timeline.html"> <span class="block primery_1"> <i class="fa fa-clock-o"></i> </span> <span class="block_text">Timeline</span> </a> </div>
                            </div>
                          </li>
                        </ul>-->
                    </div>
                </div>
                <div class="user_admin dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"><img src="<?php echo base_url();?>assets/images/favicon.ico" style="background: #ffffff; border-radius: 5px;"/><span class="user_adminname">Profile</span> <b class="caret"></b> </a>
                    <ul class="dropdown-menu">
                        <div class="top_pointer"></div>
                        <li><span style="color:#006; font-size: 12px;"><b><?php echo $this->session->userdata('employee_name');?></b></span></li>
                        <li> <a href="<?php echo base_url();?>access/change_password"><i class="fa fa-user"></i> Change Password </a> </li>
                        <li> <a href="<?php echo base_url(); ?>access/logout"><i class="fa fa-power-off"></i> Logout</a> </li>
                    </ul>
                </div>
                <!--<a href="javascript:;" class="toggle-menu menu-right push-body jPushMenuBtn rightbar-switch"><i class="fa fa-comment chat"></i></a>-->
            </div>
        </div>
        <!--\\\\\\\ header top bar end \\\\\\-->
    </div>
    <!--\\\\\\\ header end \\\\\\-->
    <div class="inner">
        <!--\\\\\\\ inner start \\\\\\-->
        <div class="left_nav">
            <!--\\\\\\\left_nav start \\\\\\-->
            <!--<div class="search_bar"> <i class="fa fa-search"></i>
              <input name="" type="text" class="search" placeholder="Search Dashboard..." />
            </div>-->
            <div class="left_nav_slidebar">
                <ul>
                    <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> DASHBOARD <span class="left_nav_pointer"></span></a></li>
                    <!--            <li> <a href="javascript:void(0);"> <i class="fa fa-plus"></i> Manage Master Data <span class="plus"><i class="fa fa-plus"></i></span></a>-->
                    <!--              <ul>-->
                    <!--                  <li> <a href="--><?php //echo base_url();?><!--access/company_list"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Company List</b> </a> </li>-->
                    <!--                  <li> <a href="--><?php //echo base_url();?><!--access/vehicle_codes"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Vehicle Cards</b> </a> </li>-->
                    <!--              </ul>-->
                    <!--            </li>-->
                    <!--            <li> <a href="javascript:void(0);"> <i class="fa fa-plus"></i> Upload Files <span class="plus"><i class="fa fa-plus"></i></span></a>-->
                    <!--              <ul>-->
                    <!--                  <li> <a href="--><?php //echo base_url();?><!--access/upload_in_out_file"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Upload File</b> </a> </li>-->
                    <!--              </ul>-->
                    <!--            </li>-->
                    <!--            <li> <a href="--><?php //echo base_url();?><!--access/process"><i class="fa fa-circle"></i> Process </a></li>-->
                    <!--            <li> <a href="--><?php //echo base_url();?><!--access/excelUpload"><i class="fa fa-circle"></i> Upload Excel - PO </a></li>-->
                    <!--            <li> <a href="--><?php //echo base_url();?><!--access/po_list"><i class="fa fa-circle"></i> PO List </a></li>-->
                    <li> <a href="<?php echo base_url();?>access/cutting"><i class="fa fa-circle"></i> Cutting </a></li>
                    <!--            <li> <a href="--><?php //echo base_url();?><!--access/po_list_for_cutting"><i class="fa fa-circle"></i> Create Bundle </a></li>-->
                    <li> <a href="<?php echo base_url();?>access/po_cut_for_care_label"><i class="fa fa-circle"></i> Print Care Label </a></li>
                    <!--            <li> <a href="--><?php //echo base_url();?><!--access/care_label_send_to_production"><i class="fa fa-circle"></i> Send to Prod. </a></li>-->
                    <li> <a href="<?php echo base_url();?>access/care_label_send_to_production_individual"><i class="fa fa-circle"></i> Send to Prod. Individual </a></li>
                    <li> <a href="<?php echo base_url();?>access/search_care_label"><i class="fa fa-circle"></i> Search Care Label </a></li>
                    <li> <a href="javascript:void(0);"> <i class="fa fa-plus"></i> Reports <span class="plus"><i class="fa fa-plus"></i></span></a>
                        <ul>
                            <!--                  <li> <a href="--><?php //echo base_url();?><!--access/care_label_report"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>CL Sent Report</b> </a> </li>-->
                            <!--                  <li> <a href="--><?php //echo base_url();?><!--access/care_label_report_new"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>CL Sent To Prod.</b> </a> </li>-->
                            <li> <a style="margin-bottom: 1px;" href="<?php echo base_url();?>access/sendingToProductionReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>CL Sent To Prod.</b> </a> </li>
                            <li> <a style="margin-bottom: 1px;" target="_blank" href="<?php echo base_url();?>access/cuttingTableWiseReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Cut-Table Report</b> </a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--\\\\\\\left_nav end \\\\\\-->
        <div class="contentpanel">
            <div class="pull-left breadcrumb_admin clear_both">
                <div class="pull-left page_title theme_color">
                    <h1>Cut-Table Report</h1>
                    <h2 class="">Cut-Table Report...</h2>
                </div>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="active">Cut-Table Report</li>
                    </ol>
                </div>
            </div>
            <div class="container clear_both padding_fix">
                <!--\\\\\\\ container  start \\\\\\-->
<!--                <form>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12">-->
<!--                            <div class="block-web">-->
<!--                                <input type="date" name="date" id="date" />-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
<!--                <br />-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-web">
                            <h5><b>Table Report Date: </b><?php echo $date;?></h5>
                            <div id="chart_div"></div>
                        </div>
                    </div>
                </div>
             </div>

        </div>
        <!--\\\\\\\ inner end\\\\\\-->
    </div>

</body>
</html>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.0.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/common-script.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jPushMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/side-chats.js"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/form-components.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/data-tables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/data-tables/dynamic_table_init.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/edit-table/edit-table.js"></script>
<script type="text/javascript">
    setTimeout(function(){
        window.location.reload(1);
    }, 5000);

    //bar chart code started
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var data = google.visualization.arrayToDataTable([
            ['Tables', 'Production  Qty', { role: 'annotation'}],

            <?php

            foreach ($table_qty as $v)
            {
                $table=$v['cut_table'];
                $count_total_pc=$v['count_total_pc'];

                echo "['$table',$count_total_pc,$count_total_pc],";
            }
            ?>
        ]);

        var options = {
            title: 'Table Wise Cutting Production Report',
            chartArea: {width: '50%'},
            vAxis: {
                title: 'Production  Qty',
                minValue: 0
            },
            hAxis: {
                title: 'Tables'
            },
            legend: 'none',
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

        chart.draw(data, options);

//        google.visualization.events.addListener(chart, 'select', function()
//            {
//                var row = chart.getSelection()[0].row;
//                var element = data.getValue(row, 0);
//
//                //  var element2 = data.getValue(row, 2);
//
//
//                window.open("<?php //echo base_url();?>//access/cutting_table_wise_report_detail/<?php //echo $table; ?>//","mywindow","menubar=1,resizable=1,width=800,height=400,left=40,top=90,location=yes");
//
//        //	  colors:['green','#006600'];
//
//                    }
//                );
//            }
//            google.setOnLoadCallback(drawVisualization);
    }
</script>