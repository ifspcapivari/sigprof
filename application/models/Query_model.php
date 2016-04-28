<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Semestre_model
 *
 * @author Rafael W. Pinheiro
 */
class Query_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function execute_query($query)
    {
        $result = $this->db->query($query);
        
        if(!$result){
            $erro = $this->db->error();
            throw new Exception('Erro: ' . $erro['message']);
        }
        
        return $result;
    }
}