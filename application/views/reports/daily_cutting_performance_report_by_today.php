<table class="display table table-bordered table-striped" id="">
    <thead>
    <tr style="background-color: #615000; color: #FFFFFF;">
        <th colspan="4" class="center"><h2>Cutting Report</h2></th>
    </tr>
    <tr style="background-color: #f7ffb0;">
        <th class="center">TARGET</th>
        <th class="center">PACKAGE READY</th>
    </tr>
    </thead>
    <tbody>
    <tr style="background-color: #f7ffb0;">
        <th class="center"><?php echo $cutting_target[0]['target'];?></th>
        <th class="center"><a target="_blank" class="btn btn-warning" href="<?php echo base_url();?>dashboard/getDailyCuttingReportDetail/<?php echo $search_date;?>"><?php echo $cutting_prod[0]['cut_package_ready_qty'];?></a></th>
    </tr>
    </tbody>
</table>