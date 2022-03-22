<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoices_model extends CI_Model
{

    public function insertInvoice($title='',$description='',$subscription='',$date='',$next_due_date='',$status=''){

        $random_invoice_id = mt_rand(100000,999999);

        $data = [
                    'random_invoice_id' => $random_invoice_id,
                    'title' =>  $title,
                    'description' => $description,
                    'subscription' => $subscription,
                    'date' => $date,
                    'next_due_date' => $next_due_date,
                    'status' => $status,
                    'created_on' => date('Y-m-d H:i:s')
                ];

        $this->db->insert('invoices', $data);

        return $this->db->insert_id();
    }


    public function updateInvoice($invoice_id,$title='',$description='',$subscription='',$date='',$next_due_date='',$status=''){

        $data = [
                    'title' =>  $title,
                    'description' => $description,
                    'subscription' => $subscription,
                    'date' => $date,
                    'next_due_date' => $next_due_date,
                    'status' => $status,
                    'updated_on' => date('Y-m-d H:i:s')
                ];

        $this->db->where('id', $invoice_id);
        $this->db->update('invoices', $data);

        return $invoice_id;
    }

}
