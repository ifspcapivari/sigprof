<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 *
 * @author Rafael W. Pinheiro
 */
class Login extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('docente_model', 'docente');
        $this->load->library('curlib');
        $this->template->set('desabilitarmenu', true);
    }
    
    public function index()
    {
        if($this->input->post()){
            $this->curlib->setUrl('http://localhost/ifcpv-auth-center/api/auth/' . TOKEN_APP);
            $this->curlib->setType('post');
              
            $this->curlib->setPostParams($this->input->post());
            $retorno = $this->curlib->execute();
            
            if($retorno->code == 200){
                $user_data = array(
                    'nome'    => $retorno->data->nome,
                    'email'   => $retorno->data->email,
                    'usuario' => $retorno->data->usuario,
                    'token'   => $retorno->data->token,
                    'perfil'  => $retorno->data->perfil
                );
                $this->session->set_userdata($user_data);
                redirect('home');
            }            
            else{
                $this->session->set_flashdata('msg', 'Usuário e/ou senha incorretos');
                redirect('login');
            }
        }
        $dados['msg'] = $this->session->flashdata('msg');
        $this->template->load($this->_template, 'login_view', $dados);
    }
}
