<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 *
 * @author Rafael W. Pinheiro
 */
class Home extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        validar_sessao($this->session, array('token', 'perfil'), 'login');
        $this->load->model('docente_model', 'docente');
    }
    
    public function index()
    {
        $dados['docente'] = $this->docente->getByOne('token', $this->session->token);
        $dados['active'] = 'home';
        $this->template->load($this->_template, 'home_view', $dados);
    }
    
    public function complementar()
    {
        $dados['active'] = 'complementar';
        $this->template->load($this->_template, 'complementar_view', $dados);
    }
    
}
