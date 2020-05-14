<?php

class Dashboard_model extends CI_Model {
    //put your code here


    public function insertSapData($tbl, $data)
    {
        $this->db->INSERT($tbl, $data);
        //return $this->db->insert_id();
    }

    public function testSelectQuery(){

        $sql = "Select * From tb_floor";

        $query = $this->db->query($sql)->result();
        return $query;
    }

    public function getWarehouseTypes(){

        $sql = "Select * From tb_warehouse_type";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLineInputReportForChart($date){

        $sql = "SELECT B.*, E.count_mid_pass_qty, F.count_end_line_qc_pass, G.count_wip_qty_line, 
                I.line_name, I.line_code, J.floor_name, K.target
                FROM 
                (SELECT line_id
                FROM `tb_care_labels` WHERE line_id !=0 GROUP BY  line_id) as A
                LEFT JOIN
                (SELECT line_id, COUNT(pc_tracking_no) as count_input_qty_line,
                DATE_FORMAT(line_input_date_time, '%Y-%m-%d') as line_input_date
                FROM `tb_care_labels` WHERE line_id !=0 AND DATE_FORMAT(line_input_date_time, '%Y-%m-%d') LIKE '%$date%'
                GROUP BY DATE_FORMAT(line_input_date_time, '%Y-%m-%d'), line_id) as B
                ON A.line_id=B.line_id
            
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_mid_pass_qty, 
                DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') as mid_line_qc_date_time 
                FROM `tb_care_labels` 
                WHERE line_id !=0  
                AND access_points >= 3
                AND access_points_status in (1, 4)
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%'
                GROUP BY DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d'), line_id) as E
                ON A.line_id=E.line_id
                
                LEFT JOIN
                (SELECT line_id, COUNT(pc_tracking_no) as count_end_line_qc_pass, 
                DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') as end_line_qc_date_time 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points_status=4
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as F
                ON A.line_id=F.line_id
                
                LEFT JOIN
                (SELECT line_id, COUNT(pc_tracking_no) as count_wip_qty_line 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points_status < 4
                GROUP BY line_id) as G
                ON A.line_id=G.line_id
                
                LEFT JOIN
                (SELECT line_id, target, `date`
                FROM `line_daily_target` 
                WHERE line_id !=0 AND `date` LIKE '%$date%'
                GROUP BY line_id) as K
                ON A.line_id=K.line_id
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id
				ORDER BY (I.line_code * 1)";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLineStatusByLine($line_id, $date){

        $sql = "SELECT B.*, E.count_mid_pass_qty, F.count_end_line_qc_pass, G.count_wip_qty_line, 
                I.line_name, I.line_code, J.floor_name, K.target
                FROM 
                (SELECT line_id
                FROM `tb_care_labels` WHERE line_id !=0 GROUP BY  line_id) as A
                LEFT JOIN
                (SELECT line_id, COUNT(pc_tracking_no) as count_input_qty_line,
                DATE_FORMAT(line_input_date_time, '%Y-%m-%d') as line_input_date
                FROM `tb_care_labels` WHERE line_id !=0 AND DATE_FORMAT(line_input_date_time, '%Y-%m-%d') LIKE '%$date%'
                GROUP BY DATE_FORMAT(line_input_date_time, '%Y-%m-%d'), line_id) as B
                ON A.line_id=B.line_id
            
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_mid_pass_qty, 
                DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') as mid_line_qc_date_time 
                FROM `tb_care_labels` 
                WHERE line_id !=0  
                AND access_points >= 3
                AND access_points_status in (1, 4)
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%'
                GROUP BY DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d'), line_id) as E
                ON A.line_id=E.line_id
                
                LEFT JOIN
                (SELECT line_id, COUNT(pc_tracking_no) as count_end_line_qc_pass, 
                DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') as end_line_qc_date_time 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points_status=4
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as F
                ON A.line_id=F.line_id
                
                LEFT JOIN
                (SELECT line_id, COUNT(pc_tracking_no) as count_wip_qty_line 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points_status < 4
                GROUP BY line_id) as G
                ON A.line_id=G.line_id
                
                LEFT JOIN
                (SELECT line_id, target, `date`
                FROM `line_daily_target` 
                WHERE line_id !=0 AND `date` LIKE '%$date%'
                GROUP BY line_id) as K
                ON A.line_id=K.line_id
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                
                INNER JOIN
                tb_floor as J ON I.floor=J.id
                
                WHERE A.line_id=$line_id
                
				ORDER BY (I.line_code * 1)";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLineStatusByLineViewTable($line_id, $date){

        $sql = "SELECT A.id, A.line_name, A.line_code, B.*, 
                E.count_mid_pass_qty, F.count_end_line_qc_pass, G.count_wip_qty_line, 
                J.floor_name, K.target
                FROM 
                (SELECT *
                FROM `tb_line` WHERE id=$line_id) as A
                
                LEFT JOIN
                (SELECT * FROM `vt_curdate_input`) as B
                ON A.id=B.line_id
            
                LEFT JOIN 
                (SELECT * FROM `vt_curdate_mid_line_qc`) as E
                ON A.id=E.line_id
                
                LEFT JOIN
                (SELECT * FROM `vt_curdate_end_line_qc`) as F
                ON A.id=F.line_id
                
                LEFT JOIN
                (SELECT * FROM `vt_line_wip`) as G
                ON A.id=G.line_id
                
                LEFT JOIN
                (SELECT * FROM `vt_curdate_line_target`) as K
                ON A.id=K.line_id
                
                LEFT JOIN
                tb_floor as J ON A.floor=J.id
                                
				ORDER BY (A.line_code * 1)";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getWorkingTimeRange(){
        $sql = "SELECT min(start_time) as starting_time, max(end_time) as ending_time FROM `tb_hours`";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getCuttingTotalProductionReport($date, $starting_time, $ending_time){

        $sql = "SELECT COUNT(pc_tracking_no) as total_cutting_output 
                FROM `tb_care_labels` 
                WHERE sent_to_production = 1 
                AND date_format(sent_to_production_date_time, '%Y-%m-%d') LIKE '%$date%'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getCuttingTarget($previous_date){

        $sql = "SELECT *
                FROM `cutting_daily_target` 
                WHERE `date` LIKE '%$previous_date%'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getCuttingExtraProductionReport($date, $starting_time, $ending_time){

        $sql = "SELECT COUNT(pc_tracking_no) as normal_hour_cutting_output
                FROM `tb_care_labels` 
                WHERE sent_to_production = 1 
                AND date_format(sent_to_production_date_time, '%Y-%m-%d') LIKE '%$date%' 
                AND TIME_FORMAT(sent_to_production_date_time, '%H:%i:%s') BETWEEN '$starting_time' AND '$ending_time'
                GROUP BY DATE_FORMAT(sent_to_production_date_time, '%Y-%m-%d')";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getDateWiseWashReturnReport($po_from_date){

        $sql = "SELECT t1.*, t2.total_count_wash_return_qty, t3.total_order_qty, t3.ex_factory_date, 
                t4.total_cut_qty, t5.total_line_output_qty, t6.total_count_wash_going_qty
                FROM (SELECT *, COUNT(pc_tracking_no) as count_wash_return_qty FROM `tb_care_labels` 
                WHERE washing_status=1 AND DATE_FORMAT(washing_date_time, '%Y-%m-%d') LIKE '%$po_from_date%'
                GROUP BY po_no, purchase_order, item, quality, color) as t1
                INNER JOIN
                (SELECT *, COUNT(pc_tracking_no) as total_count_wash_return_qty
                FROM `tb_care_labels` 
                WHERE washing_status=1
                GROUP BY po_no, purchase_order, item, quality, color) as t2
                ON t1.po_no=t2.po_no AND t1.purchase_order=t2.purchase_order 
                AND t1.item=t2.item AND t1.quality=t2.quality AND t1.color=t2.color
                INNER JOIN
                (SELECT *, SUM(quantity) as total_order_qty
                FROM `tb_po_detail` 
                GROUP BY po_no, purchase_order, item, quality, color) as t3
                ON t1.po_no=t3.po_no AND t1.purchase_order=t3.purchase_order 
                AND t1.item=t3.item AND t1.quality=t3.quality AND t1.color=t3.color
                INNER JOIN
                (SELECT *, SUM(cut_qty) as total_cut_qty
                FROM `tb_cut_summary` 
                GROUP BY po_no, purchase_order, item, quality, color) as t4
                ON t1.po_no=t4.po_no AND t1.purchase_order=t4.purchase_order 
                AND t1.item=t4.item AND t1.quality=t4.quality AND t1.color=t4.color
                INNER JOIN
                (SELECT *, COUNT(pc_tracking_no) as total_line_output_qty
                FROM `tb_care_labels` 
                GROUP BY po_no, purchase_order, item, quality, color) as t5
                ON t1.po_no=t5.po_no AND t1.purchase_order=t5.purchase_order 
                AND t1.item=t5.item AND t1.quality=t5.quality AND t1.color=t5.color
                INNER JOIN
                (SELECT *, COUNT(pc_tracking_no) as total_count_wash_going_qty FROM `tb_care_labels`
                 WHERE is_going_wash=1
                GROUP BY po_no, purchase_order, item, quality, color) as t6
                ON t1.po_no=t6.po_no AND t1.purchase_order=t6.purchase_order 
                AND t1.item=t6.item AND t1.quality=t6.quality AND t1.color=t6.color";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getDateWiseWashSendReport($po_from_date){

        $sql = "SELECT t1.*, t2.total_count_wash_send_qty, t3.total_order_qty, t3.ex_factory_date, 
                t4.total_cut_qty, t5.total_line_output_qty
                
                FROM (SELECT *, COUNT(pc_tracking_no) as count_wash_send_qty FROM `tb_care_labels` 
                WHERE is_going_wash=1 AND DATE_FORMAT(going_wash_scan_date_time, '%Y-%m-%d') LIKE '%$po_from_date%'
                GROUP BY po_no, purchase_order, item, quality, color) as t1
                INNER JOIN
                (SELECT *, COUNT(pc_tracking_no) as total_count_wash_send_qty
                FROM `tb_care_labels` 
                WHERE is_going_wash=1
                GROUP BY po_no, purchase_order, item, quality, color) as t2
                ON t1.po_no=t2.po_no AND t1.purchase_order=t2.purchase_order 
                AND t1.item=t2.item AND t1.quality=t2.quality AND t1.color=t2.color
                INNER JOIN
                (SELECT *, SUM(quantity) as total_order_qty
                FROM `tb_po_detail` 
                GROUP BY po_no, purchase_order, item, quality, color) as t3
                ON t1.po_no=t3.po_no AND t1.purchase_order=t3.purchase_order 
                AND t1.item=t3.item AND t1.quality=t3.quality AND t1.color=t3.color
                INNER JOIN
                (SELECT *, SUM(cut_qty) as total_cut_qty
                FROM `tb_cut_summary` 
                GROUP BY po_no, purchase_order, item, quality, color) as t4
                ON t1.po_no=t4.po_no AND t1.purchase_order=t4.purchase_order 
                AND t1.item=t4.item AND t1.quality=t4.quality AND t1.color=t4.color
                INNER JOIN
                (SELECT *, COUNT(pc_tracking_no) as total_line_output_qty
                FROM `tb_care_labels` 
                GROUP BY po_no, purchase_order, item, quality, color) as t5
                ON t1.po_no=t5.po_no AND t1.purchase_order=t5.purchase_order 
                AND t1.item=t5.item AND t1.quality=t5.quality AND t1.color=t5.color";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getWashDetailByDate($where){

        $sql = "SELECT * FROM `tb_care_labels` 
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getWarehousePcsReport($where){

        $sql = "SELECT * FROM `tb_care_labels` 
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getDateWiseCuttingReport($po_from_date){

//        $sql = "SELECT t2.po_no, t3.po_no, t1.po_no, t1.purchase_order, t1.item, t1.style_no, t1.style_name,
//                t1.quality, t1.color, t1.cut_pass_qty, t2.total_cut_pass_qty,
//                t3.total_order_qty, t3.ex_factory_date, t3.brand, t4.total_cut_qty,
//                t5.cut_collar_bundle_ready, t6.cut_cuff_bundle_ready,
//                t7.today_cut_collar_bundle_ready, t8.today_cut_cuff_bundle_ready
//
//                FROM
//                (SELECT *, COUNT(pc_tracking_no) as cut_pass_qty FROM `tb_care_labels`
//                 WHERE sent_to_production=1
//                 AND DATE_FORMAT(sent_to_production_date_time, '%Y-%m-%d') LIKE '%$po_from_date%'
//                 GROUP by po_no, purchase_order, item, quality, color) as t1
//                 LEFT JOIN
//                (SELECT *, COUNT(pc_tracking_no) as total_cut_pass_qty FROM `tb_care_labels`
//                 WHERE sent_to_production=1 GROUP by  po_no, purchase_order, item, quality, color) as t2
//                 ON t1.po_no=t2.po_no AND t1.purchase_order=t2.purchase_order AND t1.item=t2.item AND t1.quality=t2.quality AND t1.color=t2.color
//                  LEFT JOIN
//                (SELECT *, SUM(quantity) as total_order_qty FROM `tb_po_detail` GROUP by  po_no, purchase_order, item, quality, color) as t3
//                 ON t1.po_no=t3.po_no AND t1.purchase_order=t3.purchase_order AND t1.item=t3.item AND t1.quality=t3.quality AND t1.color=t3.color
//                 LEFT JOIN
//                (SELECT *, SUM(cut_qty) as total_cut_qty FROM `tb_cut_summary` GROUP by  po_no, purchase_order, item, quality, color) as t4
//                 ON t1.po_no=t4.po_no AND t1.purchase_order=t4.purchase_order AND t1.item=t4.item AND t1.quality=t4.quality AND t1.color=t4.color
//                 LEFT JOIN
//                (SELECT *, SUM(cut_qty) as cut_collar_bundle_ready FROM `tb_cut_summary`
//                WHERE is_cutting_collar_bundle_ready=1 GROUP by po_no, purchase_order, item, quality, color) as t5
//                 ON t1.po_no=t5.po_no AND t1.purchase_order=t5.purchase_order AND t1.item=t5.item AND t1.quality=t5.quality AND t1.color=t5.color
//                 LEFT JOIN
//                (SELECT *, SUM(cut_qty) as cut_cuff_bundle_ready FROM `tb_cut_summary`
//                WHERE is_cutting_cuff_bundle_ready=1 GROUP by po_no, purchase_order, item, quality, color) as t6
//                 ON t1.po_no=t6.po_no AND t1.purchase_order=t6.purchase_order AND t1.item=t6.item AND t1.quality=t6.quality AND t1.color=t6.color
//
//                 LEFT JOIN
//                (SELECT *, SUM(cut_qty) as today_cut_collar_bundle_ready FROM `tb_cut_summary`
//                WHERE is_cutting_collar_bundle_ready=1
//                AND DATE_FORMAT(cutting_collar_bundle_ready_date_time, '%Y-%m-%d') LIKE '%$po_from_date%'
//                GROUP by po_no, purchase_order, item, quality, color) as t7
//                 ON t1.po_no=t7.po_no AND t1.purchase_order=t7.purchase_order AND t1.item=t7.item
//                 AND t1.quality=t7.quality AND t1.color=t7.color
//
//
//                 LEFT JOIN
//                (SELECT *, SUM(cut_qty) as today_cut_cuff_bundle_ready FROM `tb_cut_summary`
//                WHERE is_cutting_cuff_bundle_ready=1
//                AND DATE_FORMAT(cutting_cuff_bundle_ready_date_time, '%Y-%m-%d') LIKE '%$po_from_date%'
//                GROUP by po_no, purchase_order, item, quality, color) as t8
//                 ON t1.po_no=t8.po_no AND t1.purchase_order=t8.purchase_order AND t1.item=t8.item
//                 AND t1.quality=t8.quality AND t1.color=t8.color";


        $sql = "SELECT A.* FROM (SELECT t1.po_no, t1.purchase_order, t1.item, t1.style_no, t1.style_name, 
                t1.quality, t1.color, t1.cut_pass_qty, t2.total_cut_pass_qty, 
                t3.total_order_qty, t3.ex_factory_date, t3.brand, t4.total_cut_qty,
                t5.cut_collar_bundle_ready, t6.cut_cuff_bundle_ready, 
                t7.today_cut_collar_bundle_ready, t8.today_cut_cuff_bundle_ready
                
                FROM 
                (SELECT *, COUNT(pc_tracking_no) as cut_pass_qty FROM `tb_care_labels` 
                 WHERE sent_to_production=1 
                 AND DATE_FORMAT(sent_to_production_date_time, '%Y-%m-%d') LIKE '%$po_from_date%'
                 GROUP by po_no, purchase_order, item, quality, color) as t1
                 
                 LEFT JOIN
                (SELECT *, COUNT(pc_tracking_no) as total_cut_pass_qty FROM `tb_care_labels` 
                 WHERE sent_to_production=1 GROUP by  po_no, purchase_order, item, quality, color) as t2
                 ON t1.po_no=t2.po_no AND t1.purchase_order=t2.purchase_order AND t1.item=t2.item AND t1.quality=t2.quality AND t1.color=t2.color
                 
                  LEFT JOIN
                (SELECT *, SUM(quantity) as total_order_qty FROM `tb_po_detail` GROUP by  po_no, purchase_order, item, quality, color) as t3
                 ON t1.po_no=t3.po_no AND t1.purchase_order=t3.purchase_order AND t1.item=t3.item AND t1.quality=t3.quality AND t1.color=t3.color
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as total_cut_qty FROM `tb_cut_summary` GROUP by  po_no, purchase_order, item, quality, color) as t4
                 ON t1.po_no=t4.po_no AND t1.purchase_order=t4.purchase_order AND t1.item=t4.item AND t1.quality=t4.quality AND t1.color=t4.color
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as cut_collar_bundle_ready FROM `tb_cut_summary` 
                WHERE is_cutting_collar_bundle_ready=1 GROUP by po_no, purchase_order, item, quality, color) as t5
                 ON t1.po_no=t5.po_no AND t1.purchase_order=t5.purchase_order AND t1.item=t5.item AND t1.quality=t5.quality AND t1.color=t5.color
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as cut_cuff_bundle_ready FROM `tb_cut_summary` 
                WHERE is_cutting_cuff_bundle_ready=1 GROUP by po_no, purchase_order, item, quality, color) as t6
                 ON t1.po_no=t6.po_no AND t1.purchase_order=t6.purchase_order AND t1.item=t6.item AND t1.quality=t6.quality AND t1.color=t6.color
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as today_cut_collar_bundle_ready FROM `tb_cut_summary` 
                WHERE is_cutting_collar_bundle_ready=1 
                AND DATE_FORMAT(cutting_collar_bundle_ready_date_time, '%Y-%m-%d') LIKE '%$po_from_date%' 
                GROUP by po_no, purchase_order, item, quality, color) as t7
                 ON t1.po_no=t7.po_no AND t1.purchase_order=t7.purchase_order AND t1.item=t7.item 
                 AND t1.quality=t7.quality AND t1.color=t7.color
                 
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as today_cut_cuff_bundle_ready FROM `tb_cut_summary` 
                WHERE is_cutting_cuff_bundle_ready=1 
                AND DATE_FORMAT(cutting_cuff_bundle_ready_date_time, '%Y-%m-%d') LIKE '%$po_from_date%' 
                GROUP by po_no, purchase_order, item, quality, color) as t8
                 ON t1.po_no=t8.po_no AND t1.purchase_order=t8.purchase_order AND t1.item=t8.item 
                 AND t1.quality=t8.quality AND t1.color=t8.color) as A
                 
                 UNION
                 
                SELECT B.* FROM (SELECT t0.po_no, t0.purchase_order, t0.item, t0.style_no, t0.style_name, 
                t0.quality, t0.color, t1.cut_pass_qty, t2.total_cut_pass_qty, 
                t3.total_order_qty, t3.ex_factory_date, t3.brand, t4.total_cut_qty,
                t5.cut_collar_bundle_ready, t6.cut_cuff_bundle_ready, 
                t7.today_cut_collar_bundle_ready, t8.today_cut_cuff_bundle_ready
                
                FROM 
                (SELECT * FROM `tb_cut_summary` 
                 WHERE 1 AND DATE_FORMAT(cutting_collar_bundle_ready_date_time, '%Y-%m-%d') LIKE '%$po_from_date%' 
                 GROUP BY po_no, purchase_order, item, quality, color) as t0
                
                LEFT JOIN
                (SELECT *, COUNT(pc_tracking_no) as cut_pass_qty FROM `tb_care_labels` 
                 WHERE sent_to_production=1 
                 AND DATE_FORMAT(sent_to_production_date_time, '%Y-%m-%d') LIKE '%$po_from_date%'
                 GROUP by po_no, purchase_order, item, quality, color) as t1
                 ON t0.po_no=t1.po_no AND t0.purchase_order=t1.purchase_order AND t0.item=t1.item AND t0.quality=t1.quality AND t0.color=t1.color
                 
                 LEFT JOIN
                (SELECT *, COUNT(pc_tracking_no) as total_cut_pass_qty FROM `tb_care_labels` 
                 WHERE sent_to_production=1 GROUP by  po_no, purchase_order, item, quality, color) as t2
                 ON t0.po_no=t2.po_no AND t0.purchase_order=t2.purchase_order AND t0.item=t2.item AND t0.quality=t2.quality AND t0.color=t2.color
                 
                  LEFT JOIN
                (SELECT *, SUM(quantity) as total_order_qty FROM `tb_po_detail` GROUP by  po_no, purchase_order, item, quality, color) as t3
                 ON t0.po_no=t3.po_no AND t0.purchase_order=t3.purchase_order AND t0.item=t3.item AND t0.quality=t3.quality AND t0.color=t3.color
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as total_cut_qty FROM `tb_cut_summary` GROUP by  po_no, purchase_order, item, quality, color) as t4
                 ON t0.po_no=t4.po_no AND t0.purchase_order=t4.purchase_order AND t0.item=t4.item AND t0.quality=t4.quality AND t0.color=t4.color
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as cut_collar_bundle_ready FROM `tb_cut_summary` 
                WHERE is_cutting_collar_bundle_ready=1 GROUP by po_no, purchase_order, item, quality, color) as t5
                 ON t0.po_no=t5.po_no AND t0.purchase_order=t5.purchase_order AND t0.item=t5.item AND t0.quality=t5.quality AND t0.color=t5.color
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as cut_cuff_bundle_ready FROM `tb_cut_summary` 
                WHERE is_cutting_cuff_bundle_ready=1 GROUP by po_no, purchase_order, item, quality, color) as t6
                 ON t0.po_no=t6.po_no AND t0.purchase_order=t6.purchase_order AND t0.item=t6.item AND t0.quality=t6.quality AND t0.color=t6.color
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as today_cut_collar_bundle_ready FROM `tb_cut_summary` 
                WHERE is_cutting_collar_bundle_ready=1 
                AND DATE_FORMAT(cutting_collar_bundle_ready_date_time, '%Y-%m-%d') LIKE '%$po_from_date%' 
                GROUP by po_no, purchase_order, item, quality, color) as t7
                 ON t0.po_no=t7.po_no AND t0.purchase_order=t7.purchase_order AND t0.item=t7.item 
                 AND t0.quality=t7.quality AND t0.color=t7.color
                 
                 
                 LEFT JOIN
                (SELECT *, SUM(cut_qty) as today_cut_cuff_bundle_ready FROM `tb_cut_summary` 
                WHERE is_cutting_cuff_bundle_ready=1 
                AND DATE_FORMAT(cutting_cuff_bundle_ready_date_time, '%Y-%m-%d') LIKE '%$po_from_date%' 
                GROUP by po_no, purchase_order, item, quality, color) as t8
                 ON t0.po_no=t8.po_no AND t0.purchase_order=t8.purchase_order AND t0.item=t8.item 
                 AND t0.quality=t8.quality AND t0.color=t8.color) as B";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLineProductionSummaryReport($date, $starting_time, $ending_time){

        $sql = "SELECT I.id as line_id, I.line_name, I.line_code, J.floor_name, K.target, 
                B.total_line_output, F.line_normal_hours_output
                
                FROM 
                (SELECT line_id
                FROM `tb_care_labels` WHERE line_id != 0 GROUP BY  line_id) as A
                
                LEFT JOIN
                (SELECT line_id, COUNT(pc_tracking_no) as total_line_output, 
                DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') as end_line_qc_date_time 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points_status=4
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as B
                ON A.line_id=B.line_id
                
                LEFT JOIN
                (SELECT line_id, COUNT(pc_tracking_no) as line_normal_hours_output, 
                DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') as end_line_qc_date_time 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points_status=4
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                AND TIME_FORMAT(end_line_qc_date_time, '%H:%i:%s') BETWEEN '$starting_time' AND '$ending_time'
                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as F
                ON A.line_id=F.line_id
                
                LEFT JOIN
                (SELECT line_id, target, `date`
                FROM `line_daily_target` 
                WHERE line_id !=0 AND `date` LIKE '%$date%'
                GROUP BY line_id) as K
                ON A.line_id=K.line_id
                
                LEFT JOIN
                tb_line as I ON A.line_id=I.id
                
                LEFT JOIN
                tb_floor as J ON I.floor=J.id
                         
				ORDER BY (I.line_code * 1)";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getDailyPerformanceDetail($line_id, $date){

        $sql = "SELECT po_no, brand, purchase_order, style_no, style_name, item, quality, color, 
                COUNT(pc_tracking_no) as line_output_po_qty
                FROM `tb_care_labels` 
                WHERE DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' AND line_id=$line_id
                GROUP BY po_no, purchase_order, item, quality, color, line_id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getFinishingProductionSummaryReport($date, $starting_time, $ending_time){

        $sql = "SELECT J.floor_name, K.target, 
                B.total_finishing_output, F.finishing_normal_hours_output
                
                FROM 
                (SELECT finishing_floor_id
                FROM `tb_care_labels` WHERE finishing_floor_id !=0 GROUP BY  finishing_floor_id) as A
                
                LEFT JOIN
                (SELECT finishing_floor_id, COUNT(pc_tracking_no) as total_finishing_output, 
                DATE_FORMAT(carton_date_time, '%Y-%m-%d') as finishing_date_time 
                FROM `tb_care_labels` WHERE finishing_floor_id !=0 AND carton_status=1
                AND DATE_FORMAT(carton_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(carton_date_time, '%Y-%m-%d'), finishing_floor_id) as B
                ON A.finishing_floor_id=B.finishing_floor_id
                
                LEFT JOIN
                (SELECT finishing_floor_id, COUNT(pc_tracking_no) as finishing_normal_hours_output
                FROM `tb_care_labels` WHERE finishing_floor_id !=0 AND carton_status=1
                AND DATE_FORMAT(carton_date_time, '%Y-%m-%d') LIKE '%$date%' 
                AND TIME_FORMAT(carton_date_time, '%H:%i:%s') BETWEEN '$starting_time' AND '$ending_time'
                GROUP BY DATE_FORMAT(carton_date_time, '%Y-%m-%d'), finishing_floor_id) as F
                ON A.finishing_floor_id=F.finishing_floor_id
                
                LEFT JOIN
                (SELECT floor_id, target, `date`
                FROM `finishing_daily_target` 
                WHERE floor_id !=0 AND `date` LIKE '%$date%'
                GROUP BY floor_id) as K
                ON A.finishing_floor_id=K.floor_id
                                
                LEFT JOIN
                tb_floor as J ON A.finishing_floor_id=J.id
                                
				ORDER BY J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPoOrderInfobyPo($where){
        $sql = "SELECT A.*, B.count_scanned_pc, C.count_unscanned_pc FROM
                (SELECT po_no, purchase_order, brand, item, style_no, style_name, quality, 
                color, SUM(quantity) as order_quality, ex_factory_date 
                FROM `tb_po_detail` GROUP BY purchase_order, item, style_no, quality, color) as A

                LEFT Join

                (SELECT COUNT(pc_tracking_no) as count_scanned_pc, purchase_order, item, 
                quality, style_no, style_name, brand, size, color FROM `tb_care_labels` 
                WHERE sent_to_production=1 GROUP BY purchase_order, item, style_no, quality, color) as B

                ON A.purchase_order=B.purchase_order and A.item=B.item
                and A.style_no=B.style_no and A.quality=B.quality
                and A.color=B.color
                
                LEFT Join

                (SELECT COUNT(pc_tracking_no) as count_unscanned_pc, purchase_order, item, 
                quality, style_no, style_name, brand, size, color FROM `tb_care_labels` 
                WHERE sent_to_production=0 GROUP BY purchase_order, item, style_no, quality, color) as C

                ON A.purchase_order=C.purchase_order and A.item=C.item
                and A.style_no=C.style_no and A.quality=C.quality
                and A.color=C.color
                
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPoOrderPackingInfobyPo($where){
        $sql = "SELECT A.*, B.total_cut_qty, D.total_end_pass_qty, E.total_packing_qty, 
                F.total_carton_qty, date_format(F.po_closing_date_time, '%Y-%m-%d') as po_closing_date,
                G.total_wh_qty
                
                FROM 
                (SELECT po_no, purchase_order, brand, item, style_no, style_name, quality, 
                color, SUM(quantity) as order_quantity, ex_factory_date 
                FROM `tb_po_detail` GROUP BY po_no, purchase_order, item, style_no, quality, color) as A
                
                LEFT Join
                (SELECT *, MIN(bundle) as bundle_start, MAX(bundle) as bundle_end, SUM(cut_qty) as total_cut_qty 
                 FROM `tb_cut_summary`
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as B
                ON A.po_no=B.po_no and A.purchase_order=B.purchase_order and A.item=B.item
                and A.style_no=B.style_no and A.quality=B.quality
                and A.color=B.color
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_end_pass_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color FROM `tb_care_labels` 
                WHERE access_points=4 AND access_points_status=4 
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as D
                ON A.po_no=D.po_no and A.purchase_order=D.purchase_order and A.item=D.item
                and A.style_no=D.style_no and A.quality=D.quality
                and A.color=D.color
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_packing_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color
                FROM `tb_care_labels` 
                WHERE packing_status=1
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as E
                ON A.po_no=E.po_no and A.purchase_order=E.purchase_order and A.item=E.item
                and A.style_no=E.style_no and A.quality=E.quality
                and A.color=E.color
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_carton_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color, max(carton_date_time) as po_closing_date_time 
                FROM `tb_care_labels` 
                WHERE carton_status=1
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as F
                ON A.po_no=F.po_no and A.purchase_order=F.purchase_order and A.item=F.item
                and A.style_no=F.style_no and A.quality=F.quality
                and A.color=F.color
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_wh_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color
                FROM `tb_care_labels` 
                WHERE warehouse_qa_type!=0
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as G
                ON A.po_no=G.po_no and A.purchase_order=G.purchase_order and A.item=G.item
                and A.style_no=G.style_no and A.quality=G.quality
                and A.color=G.color
                
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPoShippingDateWiseReport($where){
        $sql = "SELECT A.*, B.total_cut_qty, D.total_end_pass_qty, E.total_packing_qty, 
                F.*, date_format(A.po_closing_date_time, '%Y-%m-%d') as po_closing_date,
                G.count_wh_qty, H.count_other_qty, I.total_cut_pass_qty, J.total_wash_qty
                
                FROM
                (SELECT po_no, so_no, purchase_order, brand, item, style_no, style_name, quality, 
                color, SUM(quantity) as order_quantity, ex_factory_date 
                FROM `tb_po_detail` GROUP BY po_no, purchase_order, item, style_no, quality, color, ex_factory_date) as F
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_carton_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color, max(carton_date_time) as po_closing_date_time 
                FROM `tb_care_labels` 
                WHERE carton_status=1
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as A
                ON A.po_no=F.po_no and A.purchase_order=F.purchase_order and A.item=F.item
                and A.style_no=F.style_no and A.quality=F.quality
                and A.color=F.color
                
                LEFT Join
                (SELECT *, MIN(bundle) as bundle_start, MAX(bundle) as bundle_end, SUM(cut_qty) as total_cut_qty 
                 FROM `tb_cut_summary`
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as B
                ON F.po_no=B.po_no and F.purchase_order=B.purchase_order and F.item=B.item
                and F.style_no=B.style_no and F.quality=B.quality
                and F.color=B.color
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_end_pass_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color FROM `tb_care_labels` 
                WHERE access_points=4 AND access_points_status=4 
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as D
                ON F.po_no=D.po_no and F.purchase_order=D.purchase_order and F.item=D.item
                and F.style_no=D.style_no and F.quality=D.quality
                and F.color=D.color
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_packing_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color
                FROM `tb_care_labels` 
                WHERE packing_status=1
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as E
                ON F.po_no=E.po_no and F.purchase_order=E.purchase_order and F.item=E.item
                and F.style_no=E.style_no and F.quality=E.quality
                and F.color=E.color
                                
                LEFT Join
                (SELECT po_no, purchase_order, item, style_no, quality, color, COUNT(pc_tracking_no) as count_wh_qty
                FROM `tb_care_labels` WHERE warehouse_qa_type in (1,2,3,4)
                 GROUP BY po_no, purchase_order, item, style_no, quality, color) as G
                ON F.po_no=G.po_no and F.purchase_order=G.purchase_order and F.item=G.item
                and F.style_no=G.style_no and F.quality=G.quality
                and F.color=G.color
                                       
                LEFT Join
                (SELECT po_no, purchase_order, item, style_no, quality, color, COUNT(pc_tracking_no) as count_other_qty
                FROM `tb_care_labels` WHERE warehouse_qa_type in (5, 6)
                 GROUP BY po_no, purchase_order, item, style_no, quality, color) as H
                ON F.po_no=H.po_no and F.purchase_order=H.purchase_order and F.item=H.item
                and F.style_no=H.style_no and F.quality=H.quality
                and F.color=H.color
                                                             
                LEFT Join
                (SELECT po_no, purchase_order, item, style_no, quality, color, COUNT(pc_tracking_no) as total_cut_pass_qty
                FROM `tb_care_labels` WHERE sent_to_production=1 
                 GROUP BY po_no, purchase_order, item, style_no, quality, color) as I
                ON F.po_no=I.po_no and F.purchase_order=I.purchase_order and F.item=I.item
                and F.style_no=I.style_no and F.quality=I.quality
                and F.color=I.color
                                                             
                LEFT Join
                (SELECT po_no, purchase_order, item, style_no, quality, color, COUNT(pc_tracking_no) as total_wash_qty
                FROM `tb_care_labels` WHERE washing_status=1 
                 GROUP BY po_no, purchase_order, item, style_no, quality, color) as J
                ON F.po_no=J.po_no and F.purchase_order=J.purchase_order and F.item=J.item
                and F.style_no=J.style_no and F.quality=J.quality
                and F.color=J.color
                    
                WHERE 1 $where
                
                ORDER BY DATE_FORMAT(F.ex_factory_date, '%Y-%m-%d') DESC";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getSearchedDates($where){
        $sql = "SELECT ex_factory_date 
                FROM `tb_po_detail` 
                WHERE 1
                $where
                GROUP BY ex_factory_date";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPoClosingReport($where){
        $sql = "SELECT A.*, B.total_cut_qty, D.total_end_pass_qty, E.total_packing_qty, 
                F.*, date_format(A.po_closing_date_time, '%Y-%m-%d') as po_closing_date,
                G.count_wh_qty
                
                FROM 
                (SELECT COUNT(pc_tracking_no) as total_carton_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color, max(carton_date_time) as po_closing_date_time 
                FROM `tb_care_labels` 
                WHERE carton_status=1
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as A
                
                LEFT Join
                (SELECT *, MIN(bundle) as bundle_start, MAX(bundle) as bundle_end, SUM(cut_qty) as total_cut_qty 
                 FROM `tb_cut_summary`
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as B
                ON A.po_no=B.po_no and A.purchase_order=B.purchase_order and A.item=B.item
                and A.style_no=B.style_no and A.quality=B.quality
                and A.color=B.color
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_end_pass_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color FROM `tb_care_labels` 
                WHERE access_points=4 AND access_points_status=4 
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as D
                ON A.po_no=D.po_no and A.purchase_order=D.purchase_order and A.item=D.item
                and A.style_no=D.style_no and A.quality=D.quality
                and A.color=D.color
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_packing_qty, po_no, purchase_order, item, 
                quality, style_no, style_name, brand, size, color
                FROM `tb_care_labels` 
                WHERE packing_status=1
                GROUP BY po_no, purchase_order, item, style_no, quality, color) as E
                ON A.po_no=E.po_no and A.purchase_order=E.purchase_order and A.item=E.item
                and A.style_no=E.style_no and A.quality=E.quality
                and A.color=E.color
                
                
                LEFT Join
                (SELECT po_no, so_no, purchase_order, brand, item, style_no, style_name, quality, 
                color, SUM(quantity) as order_quantity, ex_factory_date 
                FROM `tb_po_detail` GROUP BY po_no, purchase_order, item, style_no, quality, color) as F
                ON A.po_no=F.po_no and A.purchase_order=F.purchase_order and A.item=F.item
                and A.style_no=F.style_no and A.quality=F.quality
                and A.color=F.color

                
                LEFT Join
                (SELECT po_no, purchase_order, item, style_no, quality, color, COUNT(pc_tracking_no) as count_wh_qty
                FROM `tb_care_labels` WHERE warehouse_qa_type != 0
                 GROUP BY po_no, purchase_order, item, style_no, quality, color) as G
                ON A.po_no=G.po_no and A.purchase_order=G.purchase_order and A.item=G.item
                and A.style_no=G.style_no and A.quality=G.quality
                and A.color=G.color
                                
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPoItemWiseSizeReport($where){
        $sql = "Select t1.*, t2.po_item_size_wise_endline_qty, t4.po_item_size_wise_packing_qty, 
                t5.total_cut_input_qty, t6.count_input_qty_line,
                (IFNULL(t7.count_mid_line_qc_pass, 0)+IFNULL(t8.count_mid_line_qc_pass_in_end, 0)) as count_mid_line_qc_pass,
                t9.count_end_line_qc_pass, t10.count_washing_pass, t11.count_carton_pass, t12.total_cut_qty, t13.count_wash_going
                From 
                (SELECT po_no, purchase_order, style_no, style_name, ex_factory_date, item, 
                quality, color, size, SUM(quantity) as po_item_size_wise_order_qty
                FROM `tb_po_detail` GROUP BY po_no, purchase_order, item, quality, color, size) as t1
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as po_item_size_wise_endline_qty
                FROM `tb_care_labels` 
                WHERE line_id != 0 AND access_points=4 AND access_points_status=4
                GROUP BY po_no, purchase_order, item, quality, color, size) as t2
                ON t1.po_no=t2.po_no AND t1.purchase_order=t2.purchase_order AND t1.item=t2.item 
                AND t1.quality=t2.quality AND t1.color=t2.color AND t1.size=t2.size
                
                LEFT JOIN
                (SELECT *, COUNT(id) as total_cut_input_qty
                FROM `tb_care_labels` 
                WHERE sent_to_production=1 
                GROUP BY po_no, purchase_order, item, quality, color, size) as t5
                ON t1.po_no=t5.po_no AND t1.purchase_order=t5.purchase_order AND t1.item=t5.item
                AND t1.quality=t5.quality AND t1.color=t5.color AND t1.size=t5.size
                
                LEFT JOIN
                 (SELECT po_no, purchase_order, item, quality, color, style_no, style_name, COUNT(id) as count_input_qty_line, size, line_id
                FROM `tb_care_labels` WHERE line_id !=0 GROUP BY po_no, purchase_order, item, quality, color, size) as t6
                ON t1.po_no=t6.po_no AND t1.purchase_order=t6.purchase_order AND t1.item=t6.item
                AND t1.quality=t6.quality AND t1.color=t6.color AND t1.size=t6.size
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as count_mid_line_qc_pass
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 3 
                AND access_points_status in (1)
                GROUP BY po_no, purchase_order, item, quality, color, size) as t7
                ON t1.po_no=t7.po_no AND t1.purchase_order=t7.purchase_order AND t1.item=t7.item
                AND t1.quality=t7.quality AND t1.color=t7.color AND t1.size=t7.size
                
                LEFT JOIN 
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as count_mid_line_qc_pass_in_end
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 4 
                AND access_points_status in (1, 2, 3, 4)
                GROUP BY po_no, purchase_order, item, quality, color, size) as t8
                ON t1.po_no=t8.po_no AND t1.purchase_order=t8.purchase_order AND t1.item=t8.item
                AND t1.quality=t8.quality AND t1.color=t8.color AND t1.size=t8.size
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as count_end_line_qc_pass
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 4 
                AND access_points_status=4 
                GROUP BY po_no, purchase_order, item, quality, color, size) as t9
                ON t1.po_no=t9.po_no AND t1.purchase_order=t9.purchase_order AND t1.item=t9.item
                AND t1.quality=t9.quality AND t1.color=t9.color AND t1.size=t9.size
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as count_washing_pass
                FROM `tb_care_labels` WHERE washing_status = 1
                GROUP BY po_no, purchase_order, item, quality, color, size) as t10
                ON t1.po_no=t10.po_no AND t1.purchase_order=t10.purchase_order AND t1.item=t10.item
                AND t1.quality=t10.quality AND t1.color=t10.color AND t1.size=t10.size
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as po_item_size_wise_packing_qty
                FROM `tb_care_labels` 
                WHERE packing_status=1
                GROUP BY po_no, purchase_order, item, quality, color, size) as t4
                ON t1.po_no=t4.po_no AND t1.purchase_order=t4.purchase_order AND t1.item=t4.item 
                AND t1.quality=t4.quality AND t1.color=t4.color AND t1.size=t4.size
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as count_carton_pass
                FROM `tb_care_labels` 
                WHERE carton_status=1
                GROUP BY po_no, purchase_order, item, quality, color, size) as t11
                ON t1.po_no=t11.po_no AND t1.purchase_order=t11.purchase_order AND t1.item=t11.item 
                AND t1.quality=t11.quality AND t1.color=t11.color AND t1.size=t11.size
                
                LEFT Join
                (SELECT *, SUM(cut_qty) as total_cut_qty 
                 FROM `tb_cut_summary`
                GROUP BY po_no, purchase_order, item, style_no, quality, color, size) as t12
                ON t1.po_no=t12.po_no AND t1.purchase_order=t12.purchase_order AND t1.item=t12.item 
                AND t1.quality=t12.quality AND t1.color=t12.color AND t1.size=t12.size
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as count_wash_going
                FROM `tb_care_labels` WHERE is_going_wash = 1
                GROUP BY po_no, purchase_order, item, quality, color, size) as t13
                ON t1.po_no=t13.po_no AND t1.purchase_order=t13.purchase_order AND t1.item=t13.item
                AND t1.quality=t13.quality AND t1.color=t13.color AND t1.size=t13.size
                
                LEFT JOIN
                `tb_size_serial` as t3
                ON t1.size=t3.size
                
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPoItemWiseWarehouseSizeReport($where){
        $sql = "Select t1.*

                From 
                
                (SELECT po_no, purchase_order, item, style_no, style_name, quality, 
                color, `size`, pc_tracking_no, warehouse_qa_type, other_purpose_remarks
                FROM `tb_care_labels` 
                WHERE line_id != 0 AND warehouse_qa_type != 0) as t1
                
                LEFT JOIN
                `tb_size_serial` as t3
                ON t1.size=t3.size
                
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getRemainingCLBySize($where){
        $sql = "SELECT t1.*, t2.line_name 
                FROM `tb_care_labels` as t1
                LEFT JOIN 
                `tb_line` as t2 
                ON t1.line_id=t2.id
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getCutVsOutputReport($year_month){
        $sql = "SELECT A.*, B.* FROM
                (SELECT SUM(t1.cut_qty) as total_cut_qty, DATE_FORMAT(t1.date_time, '%Y-%m') as cut_date 
                FROM `tb_cut_summary` as t1  
                WHERE DATE_FORMAT(t1.date_time, '%Y-%m') = '$year_month') as A
                LEFT JOIN
                (SELECT COUNT(t2.id) as total_pack_qty, DATE_FORMAT(t2.packing_date_time, '%Y-%m') as pack_date 
                FROM `tb_care_labels` as t2  
                WHERE DATE_FORMAT(t2.packing_date_time, '%Y-%m') = '$year_month') as B
                ON A.cut_date=B.pack_date";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getRemainingMidEndCLBySize($where, $where1, $where2){
//        $sql = "SELECT A.* From (SELECT t1.* FROM
//                (SELECT * FROM `tb_care_labels` WHERE 1 $where $where1) as t1) as A
//
//                UNION
//
//                SELECT B.* From(SELECT t2.* FROM
//                (SELECT * FROM `tb_care_labels` WHERE 1 $where $where2) as t2) as B";

        $sql = "SELECT A.* From (SELECT t1.*, t3.line_name FROM
                (SELECT * FROM `tb_care_labels` WHERE 1 $where $where1) as t1
                LEFT JOIN 
                `tb_line` as t3 
                ON t1.line_id=t3.id) as A

                UNION
                
                SELECT B.* From(SELECT t2.*, t4.line_name FROM
                (SELECT * FROM `tb_care_labels` WHERE 1 $where $where2) as t2
                LEFT JOIN 
                `tb_line` as t4 
                ON t2.line_id=t4.id) as B";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLinePoItemWiseSizeReport($where){
        $sql = "Select t1.*, t2.*, t4.po_item_size_wise_endline_qty From 
                (SELECT po_no, purchase_order, item, quality, color, size, line_id, COUNT(id) as po_item_size_wise_inline_qty
                FROM `tb_care_labels` 
                WHERE line_id != 0
                GROUP BY po_no, purchase_order, item, quality, color, size, line_id) as t1
                
                LEFT JOIN 
                (SELECT po_no, purchase_order, style_no, style_name, 
                ex_factory_date, item, quality, color, size, SUM(quantity) as po_item_size_wise_order_qty
                FROM `tb_po_detail` GROUP BY po_no, purchase_order, item, color, size) as t2
                ON t1.po_no=t2.po_no AND t1.purchase_order=t2.purchase_order 
                AND t1.item=t2.item AND t1.quality=t2.quality AND t1.color=t2.color AND t1.size=t2.size
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, quality, color, size, COUNT(id) as po_item_size_wise_endline_qty
                FROM `tb_care_labels` 
                WHERE line_id != 0 AND access_points=4 AND access_points_status=4
                GROUP BY po_no, purchase_order, item, quality, color, size, line_id) as t4
                ON t1.po_no=t4.po_no AND t1.purchase_order=t4.purchase_order AND t1.item=t4.item 
                AND t1.quality=t4.quality AND t1.color=t4.color AND t1.size=t4.size
                
                LEFT JOIN
                `tb_size_serial` as t3
                ON t1.size=t3.size
                
                WHERE 1 $where";

//        $sql = "SELECT po_no, purchase_order, item, line_id, size, COUNT(id) AS total_size_qty
//                FROM `tb_care_labels`
//                WHERE 1 $where
//                GROUP BY line_id, po_no, purchase_order, item, `size`";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPoWiseCuttingInfo($where){
        $sql = "SELECT A.*, B.count_scanned_pc, C.count_unscanned_pc, D.total_cut_qty FROM
                
                (SELECT po_no, purchase_order, brand, item, style_no, style_name, quality, 
                color, size, quantity, ex_factory_date
                FROM `tb_po_detail`
                GROUP BY purchase_order, item, style_no, quality, color, size) as A
                
                LEFT Join
                
                (SELECT COUNT(pc_tracking_no) as count_scanned_pc, purchase_order, item, 
                quality, style_no, style_name, brand, size, color FROM `tb_care_labels` 
                WHERE sent_to_production=1 GROUP BY purchase_order, item, style_no, quality, color, size) as B
                ON A.purchase_order=B.purchase_order and A.item=B.item
                and A.style_no=B.style_no and A.quality=B.quality
                and A.color=B.color AND A.size=B.size
                
                LEFT Join
                
                (SELECT COUNT(sent_to_production) as count_unscanned_pc, purchase_order, item, 
                quality, style_no, style_name, brand, color, size FROM `tb_care_labels` 
                WHERE sent_to_production=0
                GROUP BY purchase_order, item, color, style_no, quality, size) as C
                ON A.purchase_order=C.purchase_order and A.item=C.item
                and A.style_no=C.style_no and A.quality=C.quality
                and A.color=C.color AND A.size=C.size
                
                LEFT Join
                (SELECT *, MIN(bundle) as bundle_start, MAX(bundle) as bundle_end, SUM(cut_qty) as total_cut_qty 
                 FROM `tb_cut_summary`
                GROUP BY po_no, purchase_order, item, style_no, quality, color, size) as D
                ON A.purchase_order=D.purchase_order and A.item=D.item
                and A.style_no=D.style_no and A.quality=D.quality
                and A.color=D.color AND A.size=D.size
                
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getPoSizeWisePackingInfo($where){
        $sql = "SELECT A.*, B.total_cut_qty, D.total_end_pass_qty, E.total_packing_qty, G.total_carton_qty, H.total_wh_qty
                FROM 
                (SELECT po_no, purchase_order, brand, item, style_no, style_name, quality, 
                color, SUM(quantity) as order_quantity, ex_factory_date, size 
                FROM `tb_po_detail` GROUP BY po_no, purchase_order, item, style_no, quality, color, size) as A
                
                LEFT Join
                (SELECT *, MIN(bundle) as bundle_start, MAX(bundle) as bundle_end, SUM(cut_qty) as total_cut_qty 
                 FROM `tb_cut_summary`
                GROUP BY po_no, purchase_order, item, style_no, quality, color, size) as B
                ON A.po_no=B.po_no AND A.purchase_order=B.purchase_order and A.item=B.item
                and A.style_no=B.style_no and A.quality=B.quality
                and A.color=B.color AND A.size=B.size
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_end_pass_qty, po_no, purchase_order, item, size, 
                quality, style_no, style_name, brand, color FROM `tb_care_labels` 
                WHERE access_points=4 AND access_points_status=4 
                GROUP BY po_no, purchase_order, item, style_no, quality, color, size) as D
                ON A.po_no=D.po_no AND A.purchase_order=D.purchase_order and A.item=D.item
                and A.style_no=D.style_no and A.quality=D.quality
                and A.color=D.color AND A.size=D.size
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_packing_qty, po_no, purchase_order, item, size, 
                quality, style_no, style_name, brand, color FROM `tb_care_labels` 
                WHERE packing_status=1
                GROUP BY po_no, purchase_order, item, style_no, quality, color, size) as E
                ON A.po_no=E.po_no AND A.purchase_order=E.purchase_order and A.item=E.item
                and A.style_no=E.style_no and A.quality=E.quality
                and A.color=E.color AND A.size=E.size
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_carton_qty, po_no, purchase_order, item, size, 
                quality, style_no, style_name, brand, color FROM `tb_care_labels` 
                WHERE carton_status=1
                GROUP BY po_no, purchase_order, item, style_no, quality, color, size) as G
                ON A.po_no=G.po_no AND A.purchase_order=G.purchase_order and A.item=G.item
                and A.style_no=G.style_no and A.quality=G.quality
                and A.color=G.color AND A.size=G.size
                
                LEFT Join
                (SELECT COUNT(pc_tracking_no) as total_wh_qty, po_no, purchase_order, item, size, 
                quality, style_no, style_name, brand, color FROM `tb_care_labels` 
                WHERE warehouse_qa_type != 0
                GROUP BY po_no, purchase_order, item, style_no, quality, color, size) as H
                ON A.po_no=H.po_no AND A.purchase_order=H.purchase_order and A.item=H.item
                and A.style_no=H.style_no and A.quality=H.quality
                and A.color=H.color AND A.size=H.size
                
                LEFT JOIN
                `tb_size_serial` as F
                ON A.size=F.size
                
                WHERE 1 $where
                
                Order By F.serial";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLineInputReport($date){
        $sql = "SELECT A.line_id, B.count_qty_line, C.count_mid_line_qc_pass, D.count_mid_line_qc_defect, 
                E.count_mid_line_qc_reject, F.count_wip_qty, G.count_end_line_qc_pass, 
                H.count_end_line_qc_defect, I.count_end_line_qc_reject, J.line_name, K.floor_name 
                FROM 
                (SELECT line_id, COUNT(pc_tracking_no) as count_input_qty_line
                FROM `tb_care_labels` WHERE line_id !=0 GROUP BY line_id) as A
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_qty_line, 
                DATE_FORMAT(line_input_date_time, '%Y-%m-%d') as line_input_date 
                FROM `tb_care_labels` WHERE line_id !=0 AND DATE_FORMAT(line_input_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(line_input_date_time, '%Y-%m-%d'), line_id) as B
                ON A.line_id=B.line_id
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_mid_line_qc_pass, 
                DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') as line_input_date 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points >= 3 
                AND access_points_status in (1, 4)
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d'), line_id) as C
                ON A.line_id=C.line_id
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_mid_line_qc_defect, 
                DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') as line_input_date 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 3 
                AND access_points_status=2
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d'), line_id) as D
                ON A.line_id=D.line_id
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_mid_line_qc_reject, 
                DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') as line_input_date 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 3 
                AND access_points_status=3
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d'), line_id) as E
                ON A.line_id=E.line_id
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_wip_qty 
                FROM `tb_care_labels` WHERE line_id !=0  AND access_points_status < 4 
                GROUP BY line_id) as F
                ON A.line_id=F.line_id
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_end_line_qc_pass, 
                DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') as line_input_date 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 4 
                AND access_points_status=4
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as G
                ON A.line_id=G.line_id
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_end_line_qc_defect, 
                DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') as line_input_date 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 4 
                AND access_points_status=2
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as H
                ON A.line_id=H.line_id
                LEFT JOIN 
                (SELECT line_id, COUNT(pc_tracking_no) as count_end_line_qc_reject, 
                DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') as line_input_date 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 4 
                AND access_points_status=3
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as I
                ON A.line_id=I.line_id
                Inner Join
                tb_line as J ON A.line_id=J.id
                INNER JOIN
                tb_floor as K ON J.floor=K.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getOtherLineInputQty(){

    }

    public function getProducitonSummaryReport($where){
        $sql = "SELECT t1.*, t2.bundle_start, t2.bundle_end, t2.total_cut_qty, t3.cut_prod_date_time,
                t3.total_cut_input_qty, t4.min_care_label, t4.max_care_label, t5.count_input_qty_line,
                t6.collar_cuff_bndl_qty, (IFNULL(t7.count_mid_line_qc_pass, 0)+IFNULL(t8.count_mid_line_qc_pass_in_end, 0)) as count_mid_line_qc_pass,
                t9.count_end_line_qc_pass, t10.count_washing_pass, t11.count_packing_pass, t11.max_packing_date_time, t12.count_carton_pass, t12.max_carton_date_time,
                t13.count_wh_prod_sample, t14.count_wh_buyer, t15.count_wh_factory, t16.max_warehouse_last_action_date_time, t17.count_wh_trash,
                t18.responsible_line, t19.collar_bndl_qty, t20.cuff_bndl_qty, t21.min_line_input_date_time, t22.planned_lines, t23.count_other_purpose,
                t24.count_wash_going, t25.count_lost_qty
                
                From (SELECT *, SUM(quantity) as total_order_qty FROM `tb_po_detail`
                GROUP BY po_no, purchase_order, item) as t1
                LEFT JOIN
                (SELECT *, MIN(bundle) as bundle_start, MAX(bundle) as bundle_end, SUM(cut_qty) as total_cut_qty
                 FROM `tb_cut_summary` GROUP BY po_no, purchase_order, item) as t2
                ON t1.po_no=t2.po_no AND t1.purchase_order=t2.purchase_order AND t1.item=t2.item
                LEFT JOIN
                (SELECT *, COUNT(id) as total_cut_input_qty,
                MAX(sent_to_production_date_time) as cut_prod_date_time
                FROM `tb_care_labels` WHERE sent_to_production=1 GROUP BY po_no, purchase_order, item) as t3
                ON t1.po_no=t3.po_no AND t1.purchase_order=t3.purchase_order AND t1.item=t3.item
                LEFT JOIN
                (SELECT *, MIN(CAST(pc_tracking_no AS UNSIGNED)) as min_care_label,
                MAX(CAST(pc_tracking_no AS UNSIGNED)) as max_care_label
                 FROM `tb_care_labels` GROUP BY po_no, purchase_order, item) as t4
                 ON t1.po_no=t4.po_no AND t1.purchase_order=t4.purchase_order AND t1.item=t4.item
                 LEFT JOIN
                 (SELECT po_no, purchase_order, item, quality, style_no, style_name, COUNT(id) as count_input_qty_line
                FROM `tb_care_labels` WHERE line_id !=0 GROUP BY po_no, purchase_order, item) as t5
                ON t1.po_no=t5.po_no AND t1.purchase_order=t5.purchase_order AND t1.item=t5.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, style_no, quality, color, SUM(cut_qty) as collar_cuff_bndl_qty FROM `tb_cut_summary`
                WHERE is_bundle_collar_cuff_scanned_line=1 GROUP BY po_no, purchase_order, item) as t6
                ON t1.po_no=t6.po_no AND t1.purchase_order=t6.purchase_order AND t1.item=t6.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(id) as count_mid_line_qc_pass
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 3
                AND access_points_status in (1)
                GROUP BY po_no, purchase_order, item) as t7
                ON t1.po_no=t7.po_no AND t1.purchase_order=t7.purchase_order AND t1.item=t7.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(id) as count_mid_line_qc_pass_in_end
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 4
                AND access_points_status in (1, 2, 3, 4)
                GROUP BY po_no, purchase_order, item) as t8
                ON t1.po_no=t8.po_no AND t1.purchase_order=t8.purchase_order AND t1.item=t8.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_end_line_qc_pass
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 4
                AND access_points_status=4
                GROUP BY po_no, purchase_order, item) as t9
                ON t1.po_no=t9.po_no AND t1.purchase_order=t9.purchase_order AND t1.item=t9.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_washing_pass
                FROM `tb_care_labels` WHERE washing_status = 1
                GROUP BY po_no, purchase_order, item) as t10
                ON t1.po_no=t10.po_no AND t1.purchase_order=t10.purchase_order AND t1.item=t10.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_packing_pass,
                MAX(packing_date_time) as max_packing_date_time
                FROM `tb_care_labels` WHERE packing_status = 1
                GROUP BY po_no, purchase_order, item) as t11
                ON t1.po_no=t11.po_no AND t1.purchase_order=t11.purchase_order AND t1.item=t11.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_carton_pass,
                MAX(carton_date_time) as max_carton_date_time
                FROM `tb_care_labels` WHERE carton_status = 1
                GROUP BY po_no, purchase_order, item) as t12
                ON t1.po_no=t12.po_no AND t1.purchase_order=t12.purchase_order AND t1.item=t12.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_wh_prod_sample
                FROM `tb_care_labels` WHERE warehouse_qa_type = 4
                GROUP BY po_no, purchase_order, item) as t13
                ON t1.po_no=t13.po_no AND t1.purchase_order=t13.purchase_order AND t1.item=t13.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_wh_buyer
                FROM `tb_care_labels` WHERE warehouse_qa_type = 1
                GROUP BY po_no, purchase_order, item) as t14
                ON t1.po_no=t14.po_no AND t1.purchase_order=t14.purchase_order AND t1.item=t14.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_wh_factory
                FROM `tb_care_labels` WHERE warehouse_qa_type = 2
                GROUP BY po_no, purchase_order, item) as t15
                ON t1.po_no=t15.po_no AND t1.purchase_order=t15.purchase_order AND t1.item=t15.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item,
                MAX(warehouse_last_action_date_time) as max_warehouse_last_action_date_time
                FROM `tb_care_labels`
                GROUP BY po_no, purchase_order, item) as t16
                ON t1.po_no=t16.po_no AND t1.purchase_order=t16.purchase_order AND t1.item=t16.item
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_wh_trash
                FROM `tb_care_labels` WHERE warehouse_qa_type = 3
                GROUP BY po_no, purchase_order, item) as t17
                ON t1.po_no=t17.po_no AND t1.purchase_order=t17.purchase_order AND t1.item=t17.item
                LEFT JOIN
                (SELECT t1.po_no, t1.purchase_order, t1.item, GROUP_CONCAT(t2.line_code SEPARATOR '; ') as responsible_line
                From (SELECT po_no, purchase_order, item, line_id 
                FROM `tb_care_labels` WHERE line_id !=0 
                GROUP BY po_no, purchase_order, item, line_id) as t1
                LEFT JOIN
                (SELECT id, line_name, line_code FROM `tb_line`) as t2 On t1.line_id=t2.id
                GROUP BY t1.po_no, t1.purchase_order, t1.item) as t18
                ON t1.po_no=t18.po_no AND t1.purchase_order=t18.purchase_order AND t1.item=t18.item
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, style_no, quality, color,
                SUM(cut_qty) as collar_bndl_qty FROM `tb_cut_summary`
                WHERE is_bundle_collar_scanned_line=1 GROUP BY po_no, purchase_order, item) as t19
                ON t1.po_no=t19.po_no AND t1.purchase_order=t19.purchase_order AND t1.item=t19.item
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, style_no, quality, color,
                SUM(cut_qty) as cuff_bndl_qty FROM `tb_cut_summary`
                WHERE is_bundle_cuff_scanned_line=1 GROUP BY po_no, purchase_order, item) as t20
                ON t1.po_no=t20.po_no AND t1.purchase_order=t20.purchase_order AND t1.item=t20.item
                
                LEFT JOIN
                (SELECT *, MIN(line_input_date_time) as min_line_input_date_time
                FROM `tb_care_labels` WHERE sent_to_production=1 AND line_input_date_time != '0000-00-00 00:00:00'
                GROUP BY po_no, purchase_order, item) as t21
                ON t1.po_no=t21.po_no AND t1.purchase_order=t21.purchase_order AND t1.item=t21.item
                
                LEFT JOIN
                (SELECT t1.po_no, t1.purchase_order, t1.item, GROUP_CONCAT(t2.line_code SEPARATOR '; ') as planned_lines
                From (SELECT po_no, purchase_order, item, planned_line_id 
                FROM `tb_care_labels` WHERE planned_line_id !=0 
                GROUP BY po_no, purchase_order, item, planned_line_id) as t1
                
                LEFT JOIN
                (SELECT id, line_name, line_code FROM `tb_line`) as t2 On t1.planned_line_id=t2.id
                GROUP BY t1.po_no, t1.purchase_order, t1.item) as t22
                ON t1.po_no=t22.po_no AND t1.purchase_order=t22.purchase_order AND t1.item=t22.item
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_other_purpose
                FROM `tb_care_labels` WHERE warehouse_qa_type = 5
                GROUP BY po_no, purchase_order, item) as t23
                ON t1.po_no=t23.po_no AND t1.purchase_order=t23.purchase_order AND t1.item=t23.item
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_wash_going
                FROM `tb_care_labels` WHERE is_going_wash = 1
                GROUP BY po_no, purchase_order, item) as t24
                ON t1.po_no=t24.po_no AND t1.purchase_order=t24.purchase_order AND t1.item=t24.item
                
                LEFT JOIN
                (SELECT po_no, purchase_order, item, COUNT(pc_tracking_no) as count_lost_qty
                FROM `tb_care_labels` WHERE warehouse_qa_type = 6
                GROUP BY po_no, purchase_order, item) as t25
                ON t1.po_no=t25.po_no AND t1.purchase_order=t25.purchase_order AND t1.item=t25.item
                
                WHERE 1 $where
                
                ORDER BY t1.ex_factory_date DESC";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function lineWIPReportChart(){
        $sql = "Select A.*, B.line_name, C.floor_name From (SELECT line_id, COUNT(pc_tracking_no) as count_wip_qty 
                FROM `tb_care_labels` WHERE line_id !=0 AND access_points_status < 4
                GROUP BY line_id) as A
                
                Inner Join
                tb_line as B ON A.line_id=B.id
                INNER JOIN
                tb_floor as C ON B.floor=C.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLineDefectReportForChart($date){
//        $sql = "SELECT A.*, E.count_mid_pass_qty, F.count_end_line_qc_pass, I.line_name, J.floor_name
//                FROM (SELECT line_id, COUNT(pc_tracking_no) as count_qty_line
//                FROM `tb_care_labels` WHERE line_id !=0 AND access_points_status < 4
//                GROUP BY line_id) as A
//
//                LEFT JOIN
//                (SELECT line_id, COUNT(pc_tracking_no) as count_mid_pass_qty,
//                DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') as mid_line_qc_date_time
//                FROM `tb_care_labels`
//                WHERE line_id !=0
//                AND sent_to_production=1
//                AND access_points = 3
//                AND access_points_status = 2
//                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%'
//                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as E
//                ON A.line_id=E.line_id
//
//                LEFT JOIN
//                (SELECT line_id, COUNT(pc_tracking_no) as count_end_line_qc_pass,
//                DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') as end_line_qc_date_time
//                FROM `tb_care_labels` WHERE line_id !=0 AND access_points = 4 AND access_points_status=2
//                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%'
//                GROUP BY DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d'), line_id) as F
//                ON A.line_id=F.line_id
//
//                Inner Join
//                tb_line as I ON A.line_id=I.id
//                INNER JOIN
//                tb_floor as J ON I.floor=J.id";

        $sql = "SELECT A.*, E.count_mid_defect_qty, F.count_end_defect_qty, 
                G.count_mid_defect_recovered_qty, H.count_end_defect_recovered_qty, I.line_name, J.floor_name 
                FROM (SELECT line_id FROM `tb_defects_tracking` WHERE line_id !=0
                GROUP BY line_id) as A
            
                LEFT JOIN 
                (Select t1.*, COUNT(pc_tracking_no) as count_mid_defect_qty From 
                (SELECT line_id, pc_tracking_no, 
                DATE_FORMAT(defect_date_time, '%Y-%m-%d') as mid_defect_date_time 
                FROM `tb_defects_tracking` 
                WHERE line_id !=0 
                AND qc_point=3 
                AND DATE_FORMAT(defect_date_time, '%Y-%m-%d') LIKE '%$date%'
                GROUP BY DATE_FORMAT(defect_date_time, '%Y-%m-%d'), line_id, pc_tracking_no) as t1) as E
                ON A.line_id=E.line_id
                
                LEFT JOIN
                (Select t1.*, COUNT(pc_tracking_no) as count_end_defect_qty 
                From (SELECT line_id, pc_tracking_no,
                DATE_FORMAT(defect_date_time, '%Y-%m-%d') as end_defect_date_time 
                FROM `tb_defects_tracking` 
                WHERE line_id !=0 
                AND qc_point=4 
                AND DATE_FORMAT(defect_date_time, '%Y-%m-%d') LIKE '%$date%'
                GROUP BY DATE_FORMAT(defect_date_time, '%Y-%m-%d'), line_id, pc_tracking_no) as t1) as F
                ON A.line_id=F.line_id
                
                LEFT JOIN 
                (Select t1.*, COUNT(pc_tracking_no) as count_mid_defect_recovered_qty From 
                (SELECT line_id, pc_tracking_no, 
                DATE_FORMAT(defect_recovered_date_time, '%Y-%m-%d') as mid_defect_recovered_date_time 
                FROM `tb_defects_tracking` 
                WHERE line_id !=0 
                AND qc_point=3 
                AND defect_recovered=1
                AND DATE_FORMAT(defect_recovered_date_time, '%Y-%m-%d') LIKE '%$date%'
                GROUP BY DATE_FORMAT(defect_recovered_date_time, '%Y-%m-%d'), line_id, pc_tracking_no) as t1) as G
                ON A.line_id=G.line_id
                
                LEFT JOIN 
                (Select t1.*, COUNT(pc_tracking_no) as count_end_defect_recovered_qty From 
                (SELECT line_id, pc_tracking_no, 
                DATE_FORMAT(defect_recovered_date_time, '%Y-%m-%d') as end_defect_recovered_date_time 
                FROM `tb_defects_tracking` 
                WHERE line_id !=0 
                AND qc_point=4 
                AND defect_recovered=1
                AND DATE_FORMAT(defect_recovered_date_time, '%Y-%m-%d') LIKE '%$date%'
                GROUP BY DATE_FORMAT(defect_recovered_date_time, '%Y-%m-%d'), line_id, pc_tracking_no) as t1) as H
                ON A.line_id=H.line_id
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function isAvailAlready($where){
        $sql = "SELECT * FROM `tb_po_detail` 
                WHERE 1 $where";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getLineId($line)
    {
        $sql = "SELECT * FROM `tb_line` 
                WHERE line_name='$line' 
                AND line_code='$line'";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function lineWipQty($line_id){
        $sql = "Select A.*, I.line_name, J.floor_name FROM 
                (SELECT * FROM `tb_care_labels` 
                WHERE line_id=$line_id AND access_points_status < 4) as A               
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function midQcPass($line_id, $date){
        $sql = "Select A.*, I.line_name, J.floor_name FROM 
                (SELECT * FROM `tb_care_labels` 
                WHERE line_id=$line_id 
                AND access_points >= 3
                AND access_points_status in (1, 4)
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%') as A
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function midQcDefects($line_id, $date){
        $sql = "Select A.*, I.line_name, J.floor_name FROM 
                (SELECT * FROM `tb_care_labels` 
                WHERE line_id=$line_id 
                AND access_points = 3 
                AND access_points_status=2
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%') as A
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function midQcRejects($line_id, $date){
        $sql = "Select A.*, I.line_name, J.floor_name FROM 
                (SELECT * FROM `tb_care_labels` 
                WHERE line_id=$line_id 
                AND access_points = 3 
                AND access_points_status=3
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%') as A
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function endQcPass($line_id, $date){
        $sql = "Select A.*, I.line_name, J.floor_name FROM 
                (SELECT * FROM `tb_care_labels` 
                WHERE line_id=$line_id 
                AND access_points = 4
                AND access_points_status = 4
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%') as A
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function endQcDefects($line_id, $date){
        $sql = "Select A.*, I.line_name, J.floor_name FROM 
                (SELECT * FROM `tb_care_labels` 
                WHERE line_id=$line_id 
                AND access_points = 4
                AND access_points_status = 2
                AND DATE_FORMAT(end_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%') as A
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function endQcRejects($line_id, $date){
        $sql = "Select A.*, I.line_name, J.floor_name FROM 
                (SELECT * FROM `tb_care_labels` 
                WHERE line_id=$line_id 
                AND access_points = 4
                AND access_points_status = 3
                AND DATE_FORMAT(mid_line_qc_date_time, '%Y-%m-%d') LIKE '%$date%') as A
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function lineInputQty($line_id, $date){
        $sql = "Select A.*, I.line_name, J.floor_name FROM 
                (SELECT * FROM `tb_care_labels` 
                WHERE line_id=$line_id AND DATE_FORMAT(line_input_date_time, '%Y-%m-%d') LIKE '%$date%' 
                GROUP BY DATE_FORMAT(line_input_date_time, '%Y-%m-%d'), line_id) as A
                
                Inner Join
                tb_line as I ON A.line_id=I.id
                INNER JOIN
                tb_floor as J ON I.floor=J.id";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getBundleSummary($where){
        $sql = "SELECT t1.* FROM (SELECT po_no, purchase_order, item, quality, style_no, style_name, 
                color, brand, cut_no, cut_tracking_no, `size`, cut_qty, cut_layer, bundle, bundle_range 
                FROM `tb_cut_summary` WHERE 1 $where) as t1";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getAllShipDates(){
        $sql = "SELECT ex_factory_date 
                FROM `tb_po_detail` 
                GROUP BY ex_factory_date";

        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function updateTbl($tbl, $id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update($tbl, $data);

        return $query;
    }

    public function updateTbl_2($tbl, $po_no, $data)
    {
        $this->db->where('po_no', $po_no);
        $query = $this->db->update($tbl, $data);

        return $query;
    }
}

?>