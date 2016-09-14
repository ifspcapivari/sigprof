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
    
    public function update($semestre)
    {
        return $this->db->update('semestre', $semestre, array('idsemestre' => $semestre->idsemestre));   
    }
    
    public function delete($idsemestre)
    {
        /* Verificar se não há disciplinas associadas ao semestre */
        $ci =& get_instance();
        $ci->load->model('disciplina_model', 'disciplina');
        
        if(count($ci->disciplina->getDisciplinasBySemestre($idsemestre))){
            throw new Exception("Esse semestre não pode ser excluído pois "
                    . "existem disciplinas associadas a ele");
        }
        
        if(!$this->db->delete('semestre', array('idsemestre' => $idsemestre))){
            throw new Exception("Erro ao excluir semestre");
        }        
    }
    
    public function alterar_status($idsemestre)
    {
        $reg = $this->get($idsemestre);
        if(!$reg->idsemestre){
            throw new Exception('Semestre não encontrado');
        }
        
        $reg->status = ($reg->status == 'Ativo' ? 'Inativo' : 'Ativo');
        if(!$this->update($reg)){
            throw new Exception('Erro ao atualizar status');
        }
        return 'Semestre ' . $reg->descricao . ' ' . ($reg->status == 'Ativo' ? 'ativado' : 'inativado') . ' com sucesso';
    }
    
    public function get($idsemestre)
    {
        return $this->db->get_where('semestre', array('idsemestre' => $idsemestre))->row_object();
    }
    
    public function getAll($orderby = 'idsemestre')
    {
        return $this->db
                ->from('semestre s')
                ->order_by($orderby)
                ->get()
                ->result();
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
