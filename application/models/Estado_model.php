<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Estado_model
 *
 * @author Rafael Wendel Pinheiro
 */
class Estado_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_estado($param, $value)
    {
        $query = $this->db
                ->select('*')
                ->from('estado e');
        
        if($param != NULL){
            $query = $query->where($param, $value);
        }
                
        return $query->get()->result_array();   
    }    
}
