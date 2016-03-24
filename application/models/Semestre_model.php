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
    
    /**
      * Faz uma busca por param/value e retorna a query para ser utilizada como obj, array, etc.      
    */
    public function getQueryBy($param, $value)
    {
        return  $this->db
                ->select('*')
                ->from('semestre s')
                ->where($param, $value)
                ->get();
    }
}
