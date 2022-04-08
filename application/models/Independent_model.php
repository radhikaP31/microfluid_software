<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Independent_model extends CI_Model
{

	/*id
	mstr_cd
	mstr_nm
	mstr_desc
	type_id
	type_cd
	status
	created_on
	updated_on*/

    public function insertMaster($mstr_cd='',$mstr_nm='',$mstr_desc='',$type_id='',$type_cd='',$status=''){

        $data = [
                    'mstr_cd' => $mstr_cd,
                    'mstr_nm' =>  $mstr_nm,
                    'mstr_desc' => $mstr_desc,
                    'type_id' => $type_id,
                    'type_cd' => $type_cd,
                    'status' => $status,
                    'created_on' => date('Y-m-d H:i:s')
                ];

        $this->db->insert('independent_mst', $data);

        return $this->db->insert_id();
    }


    public function updateMaster($mstr_id,$mstr_cd='',$mstr_nm='',$mstr_desc='',$type_id='',$type_cd='',$status=''){

        $data = [
                    'mstr_cd' => $mstr_cd,
                    'mstr_nm' =>  $mstr_nm,
                    'mstr_desc' => $mstr_desc,
                    'type_id' => $type_id,
                    'type_cd' => $type_cd,
                    'status' => $status,
                    'updated_on' => date('Y-m-d H:i:s')
                ];

        $this->db->where('id', $mstr_id);
        $this->db->update('independent_mst', $data);

        return $mstr_id;
    }

}
