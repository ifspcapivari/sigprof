<?php
/**
 * Description of Docentes
 *
 * @author Rafael Wendel Pinheiro
 */
class Docentes extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        validar_sessao($this->session, array('token', 'perfil'), 'login');
        $this->load->model('docente_model', 'docente');
    }
    
    public function index()
    {
        $result = $this->docente->getAll();
        
        $this->load->library('table');
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
        $this->table->set_heading(array('#', 'Nome', 'Email', 'Página', ''));
        
        if(count($result)){
            foreach ($result as $res){
                $this->table->add_row($res->usuario, $res->nome, $res->email, '<a href="http://www.ifspcapivari.com.br/corpo-docente/'. $res->slug .'" target="blank">http://www.ifspcapivari.com.br/docentes/'. $res->slug .'</a>', '<a href="'. base_url('#') .'" class="btn btn-primary btn-sm">+Detalhes</a>');
            }
        }
        
        $dados['tabela'] = $this->table->generate();
        
        $dados['active'] = 'docentes';
        $dados['msg'] = $this->session->flashdata('msg');
        $this->template->load($this->_template, 'docentes_view', $dados);
    }
}
