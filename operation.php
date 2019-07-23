<?php

class operation extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function commonInsert($tableName,$data){
        $res = $this->db->insert($tableName,$data);
        return $res;
        
    }
    
    public function commonGet($filter,$tableName,$type){
        if($type == "single"){
            $res = $this->db->where($filter)->get($tableName)->row(); 
        }else{
            $res = $this->db->get($tableName)->result(); 
        }
        return $res; 
       
    }
    
    public function commonUpdate($filter,$set,$tableName){
        $res = $this->db->where($filter)->update($tableName,$set);
        return $res; 
       
    }
    
    public function commonDelete($filter,$tableName){
        $res = $this->db->where($filter)->delete($tableName);
        return $res;
        
    }
}
