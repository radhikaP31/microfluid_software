<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_type_model extends CI_Model
{

	/*id
	mstr_cd
	mstr_nm
	mstr_description
	type_id
	type_cd
	status
	created_on
	updated_on*/

    public function insertType($type_cd='',$title='',$description='',$parent_id=''){

        $data = [
                    'type_cd' => $type_cd,
                    'title' =>  $title,
                    'description' => $description,
                    'parent_id' => $parent_id,
                    'created_on' => date('Y-m-d H:i:s')
                ];

        $this->db->insert('common_type', $data);

        return $this->db->insert_id();
    }


    public function updateType($type_id,$type_cd='',$title='',$description='',$parent_id=''){

        $data = [
                    'type_cd' => $type_cd,
                    'title' =>  $title,
                    'description' => $description,
                    'parent_id' => $parent_id,
                    'updated_on' => date('Y-m-d H:i:s')
                ];

        $this->db->where('id', $type_id);
        $this->db->update('common_type', $data);

        return $type_id;
    }

    public function getTypeIDByTypeCode($type_cd = 0){

        $this->db->where('type_cd', $type_cd);

        $id = $this->db->get('common_type')->first_row()->id;

        return $id;
    }

    public function getTypeCodeByTypeID($type_id = 0){

        $this->db->where('id', $type_id);

        $id = $this->db->get('common_type')->first_row()->type_cd;

        return $id;
    }

}
