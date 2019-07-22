<?php

class operation extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function userRegistration($payload){
        $res = $this->db->insert('user_details',$payload);
        if($res){
            return 1;
        }else{
            return 0 ;
        }
    }
    
    public function userLogin($email,$password,$payload){
        $res = $this->db->where($email,$payload['uemail'])->where($password,$payload['upassword'])->get('user_details')->row();  
        //print_r($res);exit;
        if($res){
            return $res;
        }else{
            return 0 ;
        }
    }
    
    public function userUpdateDetails($filter,$id,$payload){
        $res = $this->db->where($filter,$id)->update('user_details',$payload);    
        if($res){
            return 1;
        }else{
            return 0 ;
        }
    }
    
    public function userDelete($filter,$id){
        $res = $this->db->where($filter,$id)->delete('user_details');    
        if($res){
            return 1;
        }else{
            return 0 ;
        }
    }
}
