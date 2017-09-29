        <?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Student extends CI_Controller
{
   
     function __construct()
    {
        parent::__construct();
          $this->load->database();
          $this->load->model('stud');
    }

     function index()
    {  $var['msg']="index page";
        echo json_encode($var);
         $this->load->view('index');
    }
    
    function login()
    {
        $data = json_decode(file_get_contents('php://input'), TRUE);
       // $data=$this->input->post();
        $result = $this->stud->loginuser($data);
        if($result == true)
        {
              echo json_encode($result);
            
        }
        else
        {    
            $var['msg']="Email or password mismatch";
            echo json_encode ($var);
        }  
    }

    function adduser()
    { 
       $request=json_decode(file_get_contents('php://input'), TRUE);
       $studdata =$this->stud->add($request);  
         if($studdata=FALSE)
         {
             $var['msg']="failed"; 
              echo json_encode($var);
         } 
        else {
           $var['msg']="success";
              echo json_encode($var);
        }
        
    }

    function userlist()
    {
        $user=$this->stud->totaluser();
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($user));
    }
    function deleteuser() 
    {   
            $userId=json_decode(file_get_contents('php://input'), TRUE);
            $userinfo=$this->stud->removeuser($userId);
            if($userinfo=FALSE)
         {
             $var['msg']="failed"; 
              echo json_encode($var);
         } 
        
           else {
           $var['msg']="success";
              echo json_encode($var);
        }
    }
 
    function upuser(){
         $id =json_decode(file_get_contents('php://input'), TRUE);
           
         $msg = $this->stud->updateuser($id);
        if($msg == false)
        {
             $var['msg']="invalid id"; 
              echo json_encode($var);
        }
        else{ 
              echo json_encode($msg);}
       // update($id);
    }
    function update($userId)
    { 
         $data =json_decode(file_get_contents('php://input'), TRUE);
      //   $id=$data["userId"];

            $msg = $this->stud->edituser($userId,$data);
         if($msg == false)
        {
             $var['msg']="invalid id"; 
              echo json_encode($var);
        }
        else{ 
             $var['msg']="successfully updated"; 
              echo json_encode($var);}
    }
    

 function addstudent()
{  $post_data=json_decode(file_get_contents('php://input'),true);
  // $post_data=$this->input->post();
    $name=$post_data["first_name"];
    $add_no=$post_data["add_no"];
    $id=$post_data[""];
    $this->db->set($post_data);
    $insert_student=$this->stud->addNewStudent($post_data);
    
    extract($_FILES);
    $resized_image1="";
    $resized_image2="";
    $resized_image3="";
   if($_FILES['file1']['id']!='')
 {
   $config['upload_path'] = './uploads/';
   $config['allowed_types'] = 'gif|jpg|png|jpeg';
   $this->load->library('upload', $config);
     if ( ! $this->upload->do_upload('file1'))
   {
       $error = array('error' => $this->upload->display_errors());    
       echo "<pre>";
      echo json_encode($error);

       //$this->load->view('admin/admin/upload_form', $error);
   }
   else
   {
       $data = array('upload_data' => $this->upload->data());
       //$random_name=rand();
       $config['image_library'] = 'gd2';
       $dd= $config['source_image'] = $data['upload_data']['full_path'];
       $cc= $config['new_image'] = './uploads/'.$add_no."_".$name."_birth".'.jpg';
       $config['maintain_ratio'] = FALSE;
    //    $config['width'] = 464;
    //    $config['height'] = 326;

       $this->load->library('image_lib', $config);

       $this->image_lib->resize();
       
       
       $resized_image1=$name.'.jpg';
       
       unlink($data['upload_data']['full_path']);

    }
}
if($_FILES['file2']['id']!='')
{
   
   $config['upload_path'] = './uploads/';
   $config['allowed_types'] = 'gif|jpg|png|jpeg';
   $this->upload->initialize($config);

   if ( ! $this->upload->do_upload('file2'))
   {
       $error = array('error' => $this->upload->display_errors());
       
       
       echo "<pre>";
       echo json_encode($error);
   

       //$this->load->view('admin/admin/upload_form', $error);
   }
   else
   {
       $data = array('upload_data' => $this->upload->data());
     //  $random_name=rand();

       $config['image_library'] = 'gd2';
       $aa= $config['source_image'] = $data['upload_data']['full_path'];
       $bb= $config['new_image'] = './uploads/'.$add_no."_".$name."_leaving".'.jpg';
       $config['maintain_ratio'] = FALSE;
    //    $config['width'] = 464;
    //    $config['height'] = 326;

       $this->image_lib->initialize($config);

       $this->image_lib->resize();
       
       
       $resized_image2=$name.'.jpg';
       
       unlink($data['upload_data']['full_path']);

    }
   
}

 if($_FILES['file3']['id']!='')
 {
   $config['upload_path'] = './uploads/';
   $config['allowed_types'] = 'gif|jpg|png|jpeg';
   $this->load->library('upload', $config);
     if ( ! $this->upload->do_upload('file3'))
   {
       $error = array('error' => $this->upload->display_errors());    
       echo "<pre>";
      echo json_encode($error);

       //$this->load->view('admin/admin/upload_form', $error);
   }
   else
   {
       $data = array('upload_data' => $this->upload->data());
       //$random_name=rand();
       $config['image_library'] = 'gd2';
       $ee= $config['source_image'] = $data['upload_data']['full_path'];
       $ff= $config['new_image'] = './uploads/'.$add_no."_".$name."_birth".'.jpg';
       $config['maintain_ratio'] = FALSE;
    //    $config['width'] = 464;
    //    $config['height'] = 326;

       $this->load->library('image_lib', $config);

       $this->image_lib->resize();
       
       
       $resized_image3=$name.'.jpg';
       
       unlink($data['upload_data']['full_path']);

    }
}
$insert_array=array
(
    'file_name'=>$cc,
    'file_name_sec'=>$bb,
    'file_name_third'=>$ff,

    // 'doc_birth'=>$aa,
    // 'doc_leaving'=>$dd,
    // 'doc_leaving'=>$dd,
    'created'=>date("Y-m-d H:i:s"),
);
$success=$this->db->insert('files',$insert_array);
//redirect('user/newstudent');
 if($success == true)
 {
     $var['msg']="file uploaded successfully";
     echo json_encode($var);
 }
 else
 {
    $var['msg']="file uploaded failed";
    echo json_encode($var);
 }
       
} 

    function studentlist()
    {
        $user=$this->stud->totalstudent();
        echo json_encode($user);
    }
 function deletestudent() 
        {   
            $stud_id=json_decode(file_get_contents('php://input'), TRUE);
            $userinfo=$this->stud->removestudent($stud_id);
            if($userinfo=FALSE)
         {$var['msg']="failed"; 
              echo json_encode($var);
         } 
        
           else {
           $var['msg']="success";
              echo json_encode($var);
        }
        }
    
 function upstudent(){
         $stud_id =json_decode(file_get_contents('php://input'), TRUE);
           
         $msg = $this->stud->updateuser($stud_id);
        if($msg == false)
        {
             $var['msg']="invalid id"; 
              echo json_encode($var);
        }
        else{ 
              echo json_encode($msg);}
       // update($id);
    }
    function updatestud($stud_id)
    { 
         $data =json_decode(file_get_contents('php://input'), TRUE);
      //   $id=$data["userId"];

            $msg = $this->stud->edituser($stud_id,$data);
         if($msg == false)
        {
             $var['msg']="invalid id"; 
              echo json_encode($var);
        }
        else{ 
             $var['msg']="successfully updated"; 
              echo json_encode($var);}
    }

 function changepassword()
 { // $data=$this->input->post();
    $data=json_decode(file_get_contents('php://input'), TRUE);
    $userId=$data["userId"];
    $opassword=$data["opassword"];
    $npass=$data["cpassword"];
      $oldpassword=$this->stud->password($data);
      $oldpass=$oldpassword[0]["password"];
      if( $oldpass == $opassword){
          $newpassword=array('password'=>($npass));
          $user=$this->stud->updatepass($newpassword,$data);
          if($user == true){
               $var['msg']="password updated successfully"; 
              echo json_encode($var);
          }
          else{
               $var['msg']="password not updated"; 
              echo json_encode($var);
          }
      }
      else {
           $var['msg']="OLD PASSWORD DID NOT MATCH"; 
              echo json_encode($var);
      }
     
    //   if($oldpassword == $userinfo){
           
    //      $this -> db -> update('tbl_users',$password);
    // }
    
    //   if($userinfo=FALSE)
    //      {$var['msg']="failed"; 
    //           echo json_encode($var);
    //      } 
        
    //        else {
    //        $var['msg']="success";
    //           echo json_encode($var);
    //     }
 }
 function adminid()
 {
       $user=$this->stud->admid();
        echo json_encode($user);
 }

  function profile()
{    // $post_data=$this->input->post();
     $post_data=json_decode(file_get_contents('php://input'), TRUE);
    
     extract($_FILES);
     $config['upload_path']= 'admin/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 10240;
                $config['max_height']           = 7680;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                       $var['msg']="Image not changed"; 
                       echo json_encode($var);
                }
                else
                {
                    $image_info = $this->upload->data();
                   // $image=$this->upload->data('upload_path');                  
                    
               
                
             //  $image_info=$this->stud->admin($data1);
                    if($image_info == true)
                        {
                            $var['msg']="file updated successfully";
                            echo json_encode($var);
                        }
                        else
                        {
                            $var['msg']="file updated failed";
                            echo json_encode($var);
                        }
                    
                }
          $insert_student=$this->stud->admin($post_data);
} 



    function role()
    {
         $data=array(
            'role_name'=>$this->input->post('role_name'),
            'role_id'=>$this->input->post('role_id')
        );
    }
}

?>