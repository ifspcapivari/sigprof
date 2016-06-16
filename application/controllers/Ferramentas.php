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
        $dados['importados'] = $this->session->flashdata('importados');
        $dados['duplicados'] = $this->session->flashdata('duplicados');
        $this->template->load($this->_template, 'ferramentas_view', $dados);
    }
    
    public function importar_lista()
    {
        //Importa a lista de Docentes a partir da API IFCV-Auth
        $this->load->library('curlib');
        $this->curlib->setUrl('http://localhost/ifcpv-auth-center/api/users/' . TOKEN_APP);
        
        $result = $this->curlib->execute();
        
        $this->load->helper('functions');
        
        $lista_docentes = convertDocenteToArr($result->data);
        
        $this->load->model('docente_model', 'docente');
        
        try{
            $res = $this->docente->insertBatch($lista_docentes); 
            $this->session->set_flashdata('msg', 'Lista importada com sucesso');
            $this->session->set_flashdata('importados', $res['validos']);
            $this->session->set_flashdata('duplicados', $res['duplicados']);
        } catch (Exception $ex) {
            $this->session->set_flashdata('msg', $ex->getMessage());
        }
        
        redirect('ferramentas');
    }
    
    public function teste()
    {
        $this->load->helper('importardocente');
        $array = importar('./assets/imports/CSV_20160405025558.csv');
        print_r($array);
        $this->load->model('docente_model', 'docente');
        
        $retorno = $this->docente->verificarDuplicidade($array, array('email'));
        $importados = $retorno['validos'];
        $duplicados = $retorno['duplicados'];
        
        echo '<hr /> <br />';
        echo 'Contatos Importados <br />';
        foreach ($importados as $i){
            echo $i['nome'] . '<br />';
        }
        echo '<hr />';
        
        echo 'Contatos Duplicados <br />';
        foreach ($duplicados as $d){
            echo $d['nome'] . '<br />';
        }
    }
}