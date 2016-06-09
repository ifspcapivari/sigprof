<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Disciplina_model
 *
 * @author Rafael W. Pinheiro
 */
class Disciplina_model extends CI_Model {
    
    public $iddisciplina;
    public $nomedisciplina;
    public $curso;
    public $anomodulo;
    public $token_docente;
    public $idsemestre;
                
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function insert()
    {
        return $this->db->insert('disciplina', $this);
    }
    
    public function delete($idsemestre)
    {
        return $this->db->delete('semestre', array('idsemestre' => $idsemestre));
    }
    
    public function getDisciplinasByDocente($token_docente)
    {
        return  $this->db
                ->select('*')
                ->from('disciplina d')
                ->join('semestre s', 'd.idsemestre = s.idsemestre')
                ->where('d.token_docente', $token_docente)
                ->where('s.status', 'Ativo')
                ->get()
                ->result();
    }
    
    public function getDisciplinasBySemestre($idsemestre)
    {
        return  $this->db
                ->select('*')
                ->from('disciplina d')
                ->join('semestre s', 'd.idsemestre = s.idsemestre')
                ->where('d.idsemestre', $idsemestre)
                ->get()
                ->result();
    }
}
