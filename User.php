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
    
    public function userRegistration(){
        $data = array("uname"=>$this->input->post('uname'),
            "upassword"=>md5($this->input->post('upassword')),
            "uemail"=>$this->input->post('uemail'),
            "umobile"=>$this->input->post('umobile'));
        if(!empty($_FILES['user_image']['name'])){
              $config['upload_path'] = "./uploads/users/images";
              $config['allowed_types'] = 'gif|jpg|png|jpeg';//image extensions
              $config['max_size'] = '5120';//image size
              $config['max_width'] = '1024';
              $config['max_height'] = '768';
              $config['overwrite'] = false;
              $this->load->library('upload', $config);//loading upload library of codeigniter
              $this->upload->initialize($config);  
              if($this->upload->do_upload('user_image')){ // picture is name of your input filed in view  
                  $imageData = $this->upload->data();//getting image details
                 $data['upicture'] = '' . base_url() . 'uploads/users/images/' . $imageData['raw_name'] . $imageData['file_ext'];

        }else{
            echo $this->upload->display_errors();
            $data['upicture'] =  "";
        }
        }
        //print_r(json_encode($data));exit;
        $res = $this->operation->userRegistration($data);
        echo $res;
        
    }
    
    public function login_page(){
         $this->load->view('login');
    }
    
    public function userLogin(){
        $emailcolumn = "uemail";
        $passwordcolumn = "upassword";
        $data = array( "uemail"=>$this->input->post('uemail'),
            "upassword"=>md5($this->input->post('upassword')));
        // print_r($data);exit;
       $res['userdetails'] = $this->operation->userLogin($emailcolumn,$passwordcolumn,$data);
       $this->load->view('update',$res);
       // echo $res;
    }
    
    public function userUpdateDetails(){
        $idcloumnname = "uid";
        $uid = $this->input->post('user_id');
        $data = array("uname"=>$this->input->post('uname'),
            "upassword"=>$this->input->post('upassword'),
            "uemail"=>$this->input->post('uemail'),
            "umobile"=>$this->input->post('umobile'));
       // print_r($data);exit;
     
       $res = $this->operation->userUpdateDetails($idcloumnname,$uid,$data);
       echo  $res;
    }
    
    public function userDelete(){
        $idcloumnname = "uid";
        $uid = $this->input->post('user_id');
        $res = $this->operation->userDelete($idcloumnname,$uid);
        echo $res;
    }
}
