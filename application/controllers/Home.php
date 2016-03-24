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
        $dados['msg'] = $this->session->flashdata('msg');
        $this->template->load($this->_template, 'home_view', $dados);
    }
    
    public function complementar()
    {
        $dados['active'] = 'complementar';
        $this->template->load($this->_template, 'complementar_view', $dados);
    }
    
    public function changepass()
    {
        if($this->input->post()){
            if($this->input->post('senha') == $this->input->post('confirmarsenha')){
                $docente = $this->docente->getByOne('token', $this->session->token);
                $docente->senha = md5($this->input->post('senha'));

                if($this->docente->update($docente)){
                    $this->session->set_flashdata('msg', 'Sua senha foi alterada com sucesso');
                }
                else{
                    $this->session->set_flashdata('msg', 'Erro ao alterar a sua senha');
                }
            }
            else{
                $this->session->set_flashdata('msg', 'Erro: Incompatibilidade de senhas informadas');
            }
        }
        redirect('home');
    }
}
