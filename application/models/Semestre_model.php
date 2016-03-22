<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Semestre_model
 *
 * @author Rafael W. Pinheiro
 */
class Semestre_model extends CI_Model {
    
    public $idsemestre;
    public $descricao;
    public $status;
                
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function insert()
    {
        return $this->db->insert('semestre', $this);
    }
    
    public function delete($idsemestre)
    {
        return $this->db->delete('semestre', array('idsemestre' => $idsemestre));
    }
    
    public function getAll()
    {
        return $this->db->get('semestre')->result();
    }
}
