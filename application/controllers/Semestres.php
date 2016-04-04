<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Semestes
 *
 * @author Rafael W. Pinheiro
 */
class Semestres extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        validar_sessao($this->session, array('token', 'perfil'), 'login');
        $this->load->model('semestre_model', 'semestre');
    }
    
    public function index()
    {
        $result = $this->semestre->getAll();
        
        $this->load->library('table');
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
        $this->table->set_heading(array('Semestre', 'Status', ''));
        
        if(count($result)){
            foreach ($result as $res){
                $this->table->add_row($res->descricao, $res->status, '<a href="'. base_url('semestres/excluir/' . $res->idsemestre) .'" class="btn btn-primary btn-sm excluir">Excluir</a>');
            }
        }
        
        $dados['tabela'] = $this->table->generate();
        $dados['active'] = 'semestres';
        $dados['msg'] = $this->session->flashdata('msg');
        $this->template->load($this->_template, 'semestres_view', $dados);
    }
    
    public function adicionar()
    {
        if($this->input->post()){
            $this->semestre->descricao = $this->input->post('descricao');
            $this->semestre->status    = $this->input->post('status');
            
            if($this->semestre->insert()){
                $this->session->set_flashdata('msg', 'Semestre <strong>' . $this->semestre->descricao . '</strong> inserido com sucesso');
            }
            else{
                $this->session->set_flashdata('msg', 'Erro ao inserir semestre');
            }
        }
        redirect('semestres');
    }
    
    public function excluir($id = null)
    {
        if(!is_null($id)){
            try{
                $this->semestre->delete($id);
                $this->session->set_flashdata('msg', "Semestre excluído com sucesso");
            } catch (Exception $ex) {
                $this->session->set_flashdata('msg', $ex->getMessage());
            }
        }
        redirect('semestres');
    }
}