<?php 
class Customer_details_m extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    public function getCustName($id){
    	return $this->getColumnData('customer_id',$id,'customer_details','customer_name');
    }
    public function getComanyName($id){
        return $this->getColumnData('customer_id',$id,'customer_details','customer_company');
    }
    public function getAddress1($id){
        return $this->getColumnData('customer_id',$id,'customer_details','address1');
    }
    public function getAddress2($id){
        return $this->getColumnData('customer_id',$id,'customer_details','address2');
    }
    public function getWebsite($id){
        return $this->getColumnData('customer_id',$id,'customer_details','website');
    }
    public function getContact($id){
        return $this->getColumnData('customer_id',$id,'customer_details','contact_no');
    }
    public function getCompanyCode($id){
        return $this->getColumnData('customer_id',$id,'customer_details','customer_cd');
    }

    public function getTableDetails(){

        $this->db->select('customer_id, customer_cd, customer_company, address1, address2, website, contact_no');
        $this->db->order_by("customer_id", "desc");
        return $this->db->get('customer_details_vw')->result_array();
    }

    public function getEmployeeTableDetails($id=0){

        $this->db->select('employee_id,emp_name, emp_email, emp_contact_no, emp_position, emp_department');
        $this->db->where('customer_cd', $id);
        $this->db->order_by("employee_id", "desc");
        return $this->db->get('employee_details_vw')->result_array();
    }

     /* Start of Insert Data */
    public function insert($gvn_company, $gvn_address1, $gvn_address2, $gvn_website, $gvn_contact){
        
        $c_name = date('d').str_replace(' ', '', strtoupper(substr($gvn_company,0,2)));
        $company_cd = rand(1000,9999);
        $data = array(
            'customer_cd' => $c_name.$company_cd,
            'customer_company' => $gvn_company,
            'address1' => $gvn_address1,
            'address2' => $gvn_address2,
            'website' => $gvn_website,
            'contact_no' => $gvn_contact,
            'created_on' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('customer_details', $data);
        return $this->db->insert_id();
    }
    /* End of Insert Data */

    /* Start of Update Data */
    public function update($gvn_id, $gvn_company, $gvn_address1, $gvn_address2, $gvn_website, $gvn_contact)
    {
      
        $data = array(
            'customer_company' => $gvn_company,
            'address1' => $gvn_address1,
            'address2' => $gvn_address2,
            'website' => $gvn_website,
            'contact_no' => $gvn_contact,
            'updated_on' => date('Y-m-d H:i:s'),
        );
        $this->db->where('customer_id', $gvn_id);
        $this->db->update('customer_details', $data);
    }
    /* End of Update Data */

    public function delete($id=0){
 
        $this->db->where('customer_id', $id);
        $this->db->update('customer_details',['is_deleted'=>1]);
    }
    public function getEditEmployeeData($id=0){
       
        $this->db->select('emp_name, emp_position, emp_email, emp_contact_no, emp_department,customer_cd');
        $this->db->where('employee_id', $id);
        return $this->db->get('employee_details_vw')->result_array();
    }

    public function insertEmployee($emp_name, $emp_contact, $emp_email, $emp_position, $emp_department, $emp_cd){

        $data = [
            'emp_cd' => $emp_cd,
            'emp_name' => $emp_name,
            'emp_position' => $emp_position,
            'emp_email' => $emp_email,
            'emp_contact_no' => $emp_contact,
            'emp_department' => $emp_department,
            'created_on' => date('Y-m-d H:i:s'),
            ];
        $this->db->insert('employee_details', $data);
        return $this->db->insert_id();
    }
}

?>
