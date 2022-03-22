<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_model extends CI_Model
{

    public function insertOrder($title='',$description='',$subscription='',$date='',$next_due_date='',$status=''){

        $random_order_id = mt_rand(100000,999999);

        $data = [
                    'random_order_id' => $random_order_id,
                    'title' =>  $title,
                    'description' => $description,
                    'subscription' => $subscription,
                    'date' => $date,
                    'next_due_date' => $next_due_date,
                    'status' => $status,
                    'created_on' => date('Y-m-d H:i:s')
                ];

        $this->db->insert('orders', $data);

        return $this->db->insert_id();
    }


    public function updateOrder($order_id,$title='',$description='',$subscription='',$date='',$next_due_date='',$status=''){

        $data = [
                    'title' =>  $title,
                    'description' => $description,
                    'subscription' => $subscription,
                    'date' => $date,
                    'next_due_date' => $next_due_date,
                    'status' => $status,
                    'updated_on' => date('Y-m-d H:i:s')
                ];

        $this->db->where('id', $order_id);
        $this->db->update('orders', $data);

        return $order_id;
    }

}
