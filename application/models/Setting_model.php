<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{

    public function replaceSettings($setting_id,$website_title='',$approved_client='',$approved_coach=''){

        $data = [
                    'website_title' =>  $website_title,
                    'approved_client' => $approved_client,
                    'approved_coach' =>  $approved_coach,
                ];

        $this->db->where('id', $setting_id);
        $this->db->update('settings', $data);

        return $setting_id;
    }

}
