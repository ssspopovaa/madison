<?php

class models{
    
    public function getDiscountPrice($prod_id,$date){
                       
        $sql = $this->db->query('SELECT `price` FROM `discount` WHERE prod_id = '.$prod_id
         .' and ('.$date.' between first_date and last_date)');
        
        return $sql;
        
    }
    public function getPrice($prod_id) {
     $sql = $this->db->query('SELECT * FROM `products` WHERE `id` = '.$prod_id);
     return $sql;
    }
    
}