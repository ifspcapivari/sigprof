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
        $this->load->library('curlib');
    }
    
    public function index()
    {
        $this->curlib->setUrl('http://localhost/ifcpv-auth-center/api/users/' . TOKEN_APP);
        
        $result = $this->curlib->execute();
        
        $this->load->library('table');
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
        $this->table->set_heading(array('#', 'Nome', 'Email', ''));
        
        if(count($result->data)){
            foreach ($result->data as $res){
                $this->table->add_row($res->usuario, $res->nome, $res->email, '<a href="'. base_url('docentes/detalhes/' . $res->token) .'" class="btn btn-primary btn-sm">+Detalhes</a>');
            }
        }
        
        $dados['tabela'] = $this->table->generate();
        
        $dados['active'] = 'docentes';
        $dados['msg'] = $this->session->flashdata('msg');
        $this->template->load($this->_template, 'docentes_view', $dados);
    }
    
    public function detalhes($token_user = null)
    {
        if($token_user == null){
            $this->session->set_flashdata('msg', 'Docente não encontrado');
            redirect('docentes');
        }
        $this->curlib->setUrl('http://localhost/ifcpv-auth-center/api/users/' . TOKEN_APP . '/' . $token_user);
        
        $result = $this->curlib->execute();
        
        $docente = $this->docente->getByOne('token', $token_user);
        $docente->nome = $result->data[0]->nome;
        $docente->email = $result->data[0]->email;
        
        $dados['docente'] = $docente;
        $dados['foto_docente'] = (!is_null($dados['docente']->foto) && file_exists('./assets/fotos/' . $dados['docente']->foto) ? 'assets/fotos/' . $dados['docente']->foto : 'assets/img/profile-default.png');
        
        $this->load->model('disciplina_model', 'disciplina');
        $dados['disciplinas'] = $this->disciplina->getDisciplinasByDocente($token_user, date('Y') . '/' . (date('m') > 7 ? '2' : '1'));
        
        $dados['active'] = 'docentes';
        $this->template->load($this->_template, 'docentes_detalhes_view', $dados);
    }
}
