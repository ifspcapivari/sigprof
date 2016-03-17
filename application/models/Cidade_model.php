<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Cidade_model
 *
 * @author Rafael Wendel Pinheiro
 */
class Cidade_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_cidade($param, $value)
    {
        $query = $this->db
                ->select('*')
                ->from('cidade c');
        
        if($param != NULL){
            $query = $query->where($param, $value);
        }
        
        return $query->get()->result_array();
    }
}
