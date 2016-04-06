<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/18
 * Time: 16:40
 */
class Mongotest extends CI_Controller{

    const ENVIRMENT = "product";

    public function __construct()
    {
        parent::__construct();
        $this->load->library('kdb');
        $this->db_driver = kdb::getInstance();
        if($this->db_driver == false){
            $this->db_driver = null;
        }else{
            $this->m_company = $this->db_driver->selectDB('m')->selectCollection("company");
            $this->m_host = $this->db_driver->selectDB('m')->selectCollection("hoststatus");
        }
    }

    public function clear_online_time(){
        if(self::ENVIRMENT == "debug"){
            return $this->m_host->update(array('uuid'=>'AC68AFE8CADDFE4E19AA62D879187D4A'),array('$set'=>array('f_online_time'=>new MongoInt32(0))));
        }else{
            return $this->m_host->update(array('uuid'=>array('$exists'=>true)),array('$set'=>array('f_online_time'=>new MongoInt32(0))),array('multiple'=>true));
        }
    }


    $sql = "SELECT
                ut.id,
                ut.domain,
                ut.num_times,
                ut.num_people,
                ut.len_time,
                if(LENGTH(ut.title), ut.title, ut.domain) AS title,
                ut.category_id,
                site_id
            FROM
                url_total_2016_02_21 AS ut
            WHERE
                ut.userid = '9f8d656b1ed95a835085d42c0286dfd8' and ut.len_time>30";


SELECT
                    pc.id,
                    if(LENGTH(pc.software_name), pc.software_name, pc.process_name) AS name,
                    pc.process_name as title,
                    if(isnull(ss.schema_id), FALSE, TRUE) AS checked,
                    if(pc.type=-1, 0, pc.type) AS category_id
                FROM
                    sw_software_manage AS sm
                INNER JOIN sw_proc_category AS pc ON sm.proc_id = pc.id
                AND pc.installation_program = 0 AND pc.status=1
                LEFT JOIN schema_software AS ss ON pc.id = ss.obj_id
                AND ss.schema_id = 144478
                WHERE
                    sm.userid = '9f8d656b1ed95a835085d42c0286dfd8'



SELECT
                    userid,
                    `domain`,
                    COUNT(openid) AS num_people,
                    COUNT(num_openid) as num_times,
                    SUM(num_time) AS len_time
                FROM
                    (
                        SELECT
                            cc.userid,
                            cc.openid,
                            cc.domain,
                            COUNT(cc.openid) AS num_openid,
                            SUM(cc.time) AS num_time
                       FROM
                         url_calc_2016_02_21 AS cc
                         GROUP BY
                             cc.userid, cc.openid, cc.domain
                             order BY NULL
                     ) AS tmp
                     GROUP BY userid, `domain`
                     order BY NULL
                     "
}