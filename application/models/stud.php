<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Stud extends CI_Model
{
   
     function __construct()
    {
        parent::__construct();
       // $this->load->database();
    }

     function loginuser($data)
    {
    //    $email=$data["email"];
    //    $password=$data["password"];

      $this->db->select('email, password,roleId');
      $this->db->from('tbl_users');
      $this->db->where($data);
     // $this->db->where('password=', $password);
      $query = $this->db->get();

     return $query->result();
      
    //   if(!empty($user)){
    //       if($user[0]->password){
    //           return $user;
    //       } else {
    //           return array();
    //       }
    //   } else {
    //       return array();
    //   }
    }

    function add($request)
    {
          $this->db->set($request);
         $filter= $this->db->insert('tbl_users',$request);
           return $filter;
    }
    function totaluser()
    {
         $this->db->select('name, email, password,userId,mobile,roleId');
        $this->db->from('tbl_users');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
    function removeuser($userId)
    {
        $this -> db -> where('userId', $userId);
        $this -> db -> delete('tbl_users');
    }
      function addNewStudent($post_data)
	{
		 $this->db->set($post_data);
         $filter= $this->db->insert('student',$post_data);
           return $filter;
	}
     function totalstudent()
    {
       $sql ='select * from student ';
          $query = $this->db->query($sql);
          $result = $query->result();
          return $result;
    }
     function removestudent($stud_id)
    {
        $this -> db -> where('stud_id', $stud_id);
        $this -> db -> delete('student');
    }
    function updateuser($id)
    {            
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('userId =', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

 function edituser($userId,$data)
    {
         $this -> db -> where('userId',$userId);
       return  $this -> db -> update('tbl_users',$data);
    }
    function updatestudent($stud_id)
    {            
        $this->db->select('*');
        $this->db->from('student');
        $this->db->where('stud_id =', $stud_id);
        $query = $this->db->get();
        
        return $query->result();
    }

 function editstudent($stud_id,$data)
    {
         $this -> db -> where('stud_id',$stud_id);
         $this -> db -> update('student',$data);
    }

function password($data)
{
    $userId=$data["userId"];

    $this->db->select('password');
    $this->db->from('tbl_users');  
    $this -> db -> where('userId=',1);
    $query= $this->db->get();
    return $query->result_array();
}
function updatepass($newpassword,$data)
{  $userId=$data["userId"];
  // $newpassword=$data["password"];
   $this -> db -> where('userId=',1);
   return $this -> db -> update('tbl_users',$newpassword);
}

function admid()
{
    $this->db->select('*');
    $this->db->from('tbl_users');
    $this->db->where('roleId=',1);
    $query= $this->db->get();
    return $query->result_array();
}
  function admin($post_data)
	{
		 $this->db->set($post_data);
         $this->db->where('roleId=',1);
         $query= $this->db->update('tbl_users',$post_data);
         return $query;
	}
   
}
?>