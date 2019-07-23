<?php

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('operation');
    }
    
    public function index(){
        $this->load->view('register');
    }
    
      //common curl API call
    private function common_curl_call($url, $param, $header, $method) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);//here we have to give our url
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($param != "") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);//checking parameters empty or not empty
        }
        if ($method == "post") {
            curl_setopt($ch, CURLOPT_POST, true);//if method is post
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//here setting header
        $resultcurl = curl_exec($ch);//from API call , result is getting and storing in this variable
      //  print_r($resultcurl);
        curl_close($ch);//closing curl
        return $resultcurl;//returning the data
    }
    
    private function commonImageUpload($imagename,$upload_path){
        if(!empty($_FILES[$imagename]['name'])){
              $config['upload_path'] = "./uploads/users/images";
              $config['allowed_types'] = 'gif|jpg|png|jpeg';//image extensions
              $config['max_size'] = '2000';//image size
              $config['max_width'] = '1500';
              $config['max_height'] = '1500';
              $config['overwrite'] = false;
              $this->load->library('upload', $config);//loading upload library of codeigniter
              $this->upload->initialize($config);  
              if($this->upload->do_upload($imagename)){ // picture is name of your input filed in view  
                  $imageData = $this->upload->data();//getting image details
                  return  $upload_path.$imageData['raw_name'].$imageData['file_ext'];

        }else{
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
        }
    }
    
    private  function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
    
    public function userRegistration(){
        $data = array("uname"=>$this->input->post('uname'),
            "upassword"=>md5($this->input->post('upassword')),
            "uemail"=>$this->input->post('uemail'),
            "umobile"=>$this->input->post('umobile'));
        $upload_path = 'uploads/users/images/';
        $imageres = $this->commonImageUpload("user_image",$upload_path);
        if(is_array($imageres)){
              print_r(strip_tags($imageres['error']));exit;
        }else{
            $data['upicture'] = $imageres;
        }
       
        $res = $this->operation->commonInsert("user_details",$data);
        echo $res;
        //Storing insertion status message.
           /* if($res){
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
            }else{
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }*/
        
    }
    
    public function login_page(){
         $this->load->view('login');
    }
    
    public function userLogin(){
        $where = array( "uemail"=>$this->input->post('uemail'),
            "upassword"=>md5($this->input->post('upassword')));
        // print_r($data);exit;
       $res['userdetails'] = $this->operation->commonGet($where,"user_details","single");
       $this->load->view('update',$res);
       // echo $res;
    }
    
    public function userUpdateDetails(){
        $where = array( "uid"=>$this->input->post('user_id'));
        $set = array("uname"=>$this->input->post('uname'),
            "upassword"=>$this->input->post('upassword'),
            "uemail"=>$this->input->post('uemail'),
            "umobile"=>$this->input->post('umobile'));
       // print_r($data);exit;
     
       $res = $this->operation->commonUpdate($where,$set,'user_details');
       echo  $res;
    }
    
    public function userDelete(){
        $where = array("uid"=>$this->input->post('user_id'));
        $res = $this->operation->commonDelete($where,'user_details');
        echo $res;
    }
}
