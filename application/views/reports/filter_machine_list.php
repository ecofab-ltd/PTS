<?php

$sl=1;

foreach ($machine_list as $v){ ?>

    <tr>
        <td class="center"><?php echo $sl; $sl++;?></td>
        <td class="center"><?php echo $v['machine_no'];?></td>
        <td class="center"><?php echo $v['machine_description'];?></td>
        <td class="center"><?php echo $v['model_no'];?></td>
        <td class="center"><?php echo $v['line_code'];?></td>
        <td class="center"><?php echo $v['other_location'];?></td>
        <td class="center"><?php echo ($v['status'] == 1 ? 'ACTIVE' : ($v['status'] == 0 ? 'INACTIVE' : '') );?></td>
        <td class="center"><?php echo ($v['status'] == 1 ? 'RUNNING' : ($v['status'] == 2 ? 'UNDER MAINTENANCE' : '') );?></td>
        <td class="center">
            <a class="btn btn-warning" href="" title="EDIT"><i class="fa fa-edit"></i></a>
        </td>
    </tr>

    <?php
}
?>