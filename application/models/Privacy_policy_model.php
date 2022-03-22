<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privacy_policy_model extends CI_Model
{

    public function replacePolicy($policy_id,$privacy_policy='',$terms_condition=''){

        $data = [
                    'privacy_policy' =>  $privacy_policy,
                    'terms_condition' => $terms_condition
                ];

        $this->db->where('id', $policy_id);
        $this->db->update('privacy_policy', $data);

        return $policy_id;
    }

}
