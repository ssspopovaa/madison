<?php

class models extends Controller {
    
    public function getDiscountPrice($prod_id,$date){
                       
        $sql = $this->db->query('SELECT `price` FROM `discount` WHERE prod_id = '.$prod_id
         .' and ('.$date.' between first_date and last_date) ORDER BY `period` LIMIT 1');
        
        return $sql;
        
    }
    public function getPrice($prod_id) {
     $sql = $this->db->query('SELECT * FROM `products` WHERE `id` = '.$prod_id);
     return $sql;
    }
    
    public function getDiscountPrice2($prod_id,$date){
                       
        $sql = $this->db->query('SELECT `price` FROM `discount` WHERE prod_id = '.$prod_id
         .' and ('.$date.' between first_date and last_date) ORDER BY `date_added` DESC LIMIT 1');
        
        return $sql;
        
    }
    
}