<div class="col-md-12">
    <section class="panel default blue_title h2">

        <div class="panel-body">
            <table class="table" border="1">
                <thead>
                    <tr>
                        <th class="center" colspan="15"><span style="font-size: 20px;"><?php echo $line_po_items[0]['line_name']?></span></th>
                    </tr>
                    <tr>
                        <th class="center">PO-Item</th>
                        <th class="center">SO</th>
                        <th class="center">BRAND</th>
                        <th class="center">QLTY-CLR</th>
                        <th class="center">STL</th>
                        <th class="center">SMV</th>
                        <th class="center">ExFac</th>
                        <th class="center"><span data-toggle="tooltip" title="Order QTY">Order</span></th>
                        <th class="center"><span data-toggle="tooltip" title="Cut QTY">Cut</span></th>
                        <th class="center"><span data-toggle="tooltip" title="Cut Pass QTY">Cut Pass</span></th>
<!--                        <th class="center"><span data-toggle="tooltip" title="Other Line Input">Other Line</span></th>-->
                        <th class="center">Input</th>
                        <th class="center">Input Date</th>
<!--                        <th class="center"><span data-toggle="tooltip" title="Collar Qty">Collar</span></th>-->
<!--                        <th class="center"><span data-toggle="tooltip" title="Cuff Qty">Cuff</span></th>-->
                        <th class="center"><span data-toggle="tooltip" title="Mid-Pass QTY">Mid</span></th>
                        <th class="center"><span data-toggle="tooltip" title="End-Pass QTY">End</span></th>
                        <th class="center"><span data-toggle="tooltip" title="line Balance QTY">Balance</span></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($line_po_items as $v){
                    $total_line_input_qty = $v['count_input_qty_line'] + $v['count_other_input_qty_line'];

                    if($v['count_input_qty_line'] - $v['count_end_line_qc_pass'] > 0) { ?>

                        <tr>
                            <td class="center">
                                <span style="color: #727dff; cursor: pointer;" onclick="getSizeWiseReport('<?php echo $v['po_no']; ?>', '<?php echo $v['purchase_order']; ?>', '<?php echo $v['item']; ?>', '<?php echo $v['color']; ?>');"><?php echo $v['purchase_order'] . '-' . $v['item']; ?></span>
                            </td>
                            <td class="center"><?php echo $v['so_no']; ?></td>
                            <td class="center"><?php echo $v['brand']; ?></td>
                            <td class="center"><?php echo $v['quality'] . '-' . $v['color']; ?></td>
                            <td class="center"><?php echo $v['style_no'] . '-' . $v['style_name']; ?></td>
                            <td class="center"><?php echo (sprintf('%0.2f', $v['smv'])); ?></td>
                            <td class="center"><?php echo $v['ex_factory_date']; ?></td>
                            <td class="center"><?php echo $v['total_order_qty']; ?></td>
                            <td class="center"><?php echo $v['total_cut_qty']; ?></td>
                            <td class="center"><?php echo $v['total_cut_input_qty']; ?></td>
<!--                            <td class="center">-->
<!--                                --><?php
//                                    echo $v['count_other_input_qty_line'];
//                                ?>
<!--                            </td>-->
                            <td class="center"><?php echo $v['count_input_qty_line']; ?></td>
                            <td class="center"><?php echo $v['min_line_input_date_time']; ?></td>
<!--                            <td class="center">--><?php //echo $v['collar_bndl_qty']; ?><!--</td>-->
<!--                            <td class="center">--><?php //echo $v['cuff_bndl_qty']; ?><!--</td>-->
                            <td class="center"><?php echo $v['count_mid_line_qc_pass']; ?></td>
                            <td class="center"><?php echo $v['count_end_line_qc_pass']; ?></td>
                            <td class="center"><?php echo $v['count_input_qty_line'] - $v['count_end_line_qc_pass']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</div>