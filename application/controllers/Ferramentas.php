<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Semestes
 *
 * @author Rafael W. Pinheiro
 */
class Ferramentas extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        validar_sessao($this->session, array('token', 'perfil'), 'login');
        $this->load->model('semestre_model', 'semestre');
    }
    
    public function index()
    {        
        $dados['active'] = 'ferramentas';
        $dados['msg'] = $this->session->flashdata('msg');
        $this->template->load($this->_template, 'ferramentas_view', $dados);
    }
    
    public function importar_lista()
    {
        $config['upload_path'] = './assets/imports/';
        $config['file_name'] = 'CSV_' . date('YmdHis');
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'csv';
        
        $this->load->library('upload', $config);
        if($this->upload->do_upload('arquivo')){
            //Fez o upload
            $dados_up = $this->upload->data();
            
            $this->load->helper('importardocente');
            $list = importar($dados_up['full_path']);
            
            $this->load->model('docente_model', 'docente');
            if($this->docente->insertBatch($list)){
                $this->session->set_flashdata('msg', 'Lista importada com sucesso');
            }
            else{
                $this->session->set_flashdata('msg', 'Erro ao imporar lista');
            }
            
            //Excluir o arquivo CSV
            unlink($dados_up['full_path']);
        }
        else{
            $this->session->set_flashdata('msg', 'Erro ao fazer o upload do arquivo');
        }
        redirect('ferramentas');
    }
    
    public function teste()
    {
        $this->load->helper('importardocente');
        $array = importar('./assets/imports/CSV_20160405025558.csv');
        print_r($array);
        $this->load->model('docente_model', 'docente');
        
        try{
            $this->docente->verificarDuplicidade($array, array('nome', 'email'));
            echo 'Nenhuma duplicidade';
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}