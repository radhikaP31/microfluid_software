<?php 
class About_us_m extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    public function getTabName($id=0){
    	return $this->getColumnData('id',$id,'web_about_info','tab_name');
    }
    public function getName($id=0){
        return $this->getColumnData('id',$id,'web_about_info','name');
    }
    public function getDescription($id=0){
        return $this->getColumnData('id',$id,'web_about_info','description');
    }
    public function getImage($id=0){
        return $this->getColumnData('id',$id,'web_about_info','image');
    }
    public function getVideoPath($id=0){
        return $this->getColumnData('id',$id,'web_about_info','video_path');
    }

    public function getTableDetails(){

        $this->db->select('id,tab_name,name,image,video_path');
        $this->db->order_by("id", "desc");
        return $this->db->get('web_about_info')->result_array();
    }


     /* Start of Insert Data */
    public function insert($gvn_tab_name, $gvn_name, $gvn_description, $gvn_image, $gvn_video_path){
        
        $data = array(
            'tab_name' => $gvn_tab_name,
            'name' => $gvn_name,
            'description' => $gvn_description,
            'image' => $gvn_image,
            'video_path' => $gvn_video_path,
            'created_on' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('web_about_info', $data);
        return $this->db->insert_id();
    }
    /* End of Insert Data */

    /* Start of Update Data */
    public function update($gvn_id, $gvn_tab_name, $gvn_name, $gvn_description, $gvn_image, $gvn_video_path)
    {
      
        $data = array(
            'tab_name' => $gvn_tab_name,
            'name' => $gvn_name,
            'description' => $gvn_description,
            'image' => $gvn_image,
            'video_path' => $gvn_video_path,
            'updated_on' => date('Y-m-d H:i:s'),
        );
        $this->db->where('id', $gvn_id);
        $this->db->update('web_about_info', $data);
    }
    /* End of Update Data */

    public function delete($id=0){
 
        $this->db->where('id', $id);
        $this->db->update('web_about_info',['is_deleted'=>1]);
    }
    public function getEditEmployeeData($id=0){
       
        $this->db->select('emp_name, emp_position, emp_email, emp_contact_no, emp_department,tab_name');
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
