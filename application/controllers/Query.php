<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Query
 *
 * @author Rafael W. Pinheiro
 */
class Query extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        validar_sessao($this->session, array('token', 'perfil'), 'login');
        $this->load->model('query_model', 'query');
    }
    
    public function index()
    {        
        $dados['resp'] = null;
        $query = array('status' => null, 'resp' => null);
        
        if($this->input->post()){
            try{
                $query['resp'] = $this->query->execute_query($this->input->post('query'));
                $query['status'] = 'sucesso';
            } catch (Exception $ex) {
                $query['resp'] = $ex->getMessage();
                $query['status'] = 'erro';
            }
        }
        
        if(isset($query['status'])){
            if($query['status'] == 'sucesso'){
                $this->load->library('table');
                $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));

                $dados['resp'] = $this->table->generate($query['resp']);
            }
            else{
                $dados['resp'] = $query['resp'];
            }
        }
        
        
        $dados['active'] = 'query';
        $dados['msg'] = $this->session->flashdata('msg');
        $this->template->load($this->_template, 'query_view', $dados);
    }    
}