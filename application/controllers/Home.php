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
        if($this->input->post()){
            $docente = $this->docente->getByOne('token', $this->session->token);
            $docente->curriculo = $this->input->post('curriculo');
            $docente->titulacao = $this->input->post('titulacao');
            $docente->descricao = $this->input->post('descricao');
            $docente->regime    = $this->input->post('regime');
            
            if($this->docente->update($docente)){
                $this->session->set_flashdata('msg', 'Dados atualizados com sucesso');
            }
            else{
                $this->session->set_flashdata('msg', 'Erro ao atualizar os dados');
            }
            redirect('home/complementar');
        }
        else{
            $this->load->helper('form');
            $cursos = array(
                'Técnico em Administração - Modalidade EJA',
                'Técnico Integrado em Informática',
                'Técnico em Manutenção e Suporte em Informática',
                'Tecnólogo em Análise e Desenvolvimento de Sistemas',
                'Técnico Integrado em Química',
                'Técnico Concomitante/Subsequente em Química',
                'Tecnólogo em Processos Químicos',
                'Licenciatura em Química'
            );
            $dados['cursos'] = array_combine($cursos, $cursos);
            
            $regimes = array(
                '20 horas',
                '40 horas',
                'RDE',
                'Substituto',
                'Temporário'
            );
            $dados['regimes'] = array_combine($regimes, $regimes);
            
            $anosmodulos = array(1, 2, 3, 4, 5, 6, 7, 8);
            $dados['anosmodulos'] = array_combine($anosmodulos, $anosmodulos);

            //Combo de Semestres 'Ativos' para o form de cadastro da disciplina
            $this->load->model('semestre_model', 'semestre');
            $result_sem = $this->semestre->getQueryBy('status', 'Ativo')->result_array();
            $dados['semestres'] = array();
            
            if(count($result_sem)){
                foreach ($result_sem as $reg){
                    $semestres[$reg['idsemestre']] = $reg['descricao'];
                }
                $dados['semestres'] = $semestres;
            }
            
            //Combo de Semestres para o form de filtro
            $all_sem = $this->semestre->getAll('s.idsemestre DESC');
            $filtro_sem = array('all' => 'Todos');
            if(count($all_sem)){
                foreach ($all_sem as $sem){
                    $filtro_sem[str_replace('/', '-', $sem->descricao)] = $sem->descricao;
                }
                $dados['filtro_sem'] = $filtro_sem;
            }

            $this->load->model('disciplina_model', 'disciplina');
            //Se houver um filtro por 'semestre' filtra, senão busca todas as disciplinas já ministradas pelo docente
            $aba = 'home';
            $filtro = $this->input->get('s');
            $descricao_semestre = null;
            if(!is_null($filtro)){
                $descricao_semestre = ($filtro == 'all' ? null : str_replace('-', '/', $filtro));
                $aba = 'disciplinas';
            }            
            $res_disc = $this->disciplina->getDisciplinasByDocente($this->session->token, $descricao_semestre);
            
            $this->load->library('table');
            $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
            $this->table->set_heading(array('Disciplina', 'Curso', 'Ano/Módulo', 'Semestre'));
                        
            if(count($res_disc)){
                foreach ($res_disc as $disc){
                    $this->table->add_row($disc->nomedisciplina, $disc->curso, $disc->anomodulo, $disc->descricao);
                }
            }
            $dados['tabela_disciplinas'] = $this->table->generate();

            $dados['docente'] = $this->docente->getByOne('token', $this->session->token);
            //die(var_dump($dados['docente']->foto));
            $dados['foto_docente'] = (!is_null($dados['docente']->foto) && file_exists('./assets/fotos/' . $dados['docente']->foto) ? 'assets/fotos/' . $dados['docente']->foto : 'assets/img/profile-default.png');

            $dados['active'] = 'complementar';
            $dados['msg'] = $this->session->flashdata('msg');
            $dados['aba'] = (!is_null($this->session->flashdata('aba')) ? $this->session->flashdata('aba') : $aba);
            $this->template->load($this->_template, 'complementar_view', $dados);
        }
    }
    
    public function cadastrar_disciplina()
    {
        if($this->input->post()){
            $this->load->model('disciplina_model', 'disciplina');
            $this->disciplina->nomedisciplina = $this->input->post('nomedisciplina');
            $this->disciplina->curso = $this->input->post('curso');
            $this->disciplina->anomodulo = $this->input->post('anomodulo');
            $this->disciplina->token_docente = $this->session->token;
            $this->disciplina->idsemestre = $this->input->post('semestre');
            
            if($this->disciplina->insert()){
                $this->session->set_flashdata('msg', 'Disciplina <strong>' . $this->disciplina->nomedisciplina . '</strong> inserida com sucesso');
            }
            else{
                $this->session->set_flashdata('msg', 'Erro ao inserir disciplina');
            }
            $this->session->set_flashdata('aba', 'disciplinas');
        }
        redirect('home/complementar');
    }
    
    public function changepass()
    {
        if($this->input->post()){
            if($this->input->post('novasenha') == $this->input->post('confirmarsenha')){
                $this->load->library('curlib');
                $this->curlib->setUrl('http://localhost/ifcpv-auth-center/api/changepass/' . TOKEN_APP);
                $this->curlib->setType('post');
                
                $data = array(
                    'usuario'   => $this->session->usuario,
                    'senha'     => $this->input->post('senha'),
                    'novasenha' => $this->input->post('novasenha')
                );
                
                $this->curlib->setPostParams($data);
                
                $retorno = $this->curlib->execute();
                if($retorno->code == 200){
                    $this->session->set_flashdata('msg', 'Sua senha foi alterada com sucesso');
                }
                else{
                    $this->session->set_flashdata('msg', 'Erro ao alterar a sua senha: ' . $retorno->message);
                }
            }
            else{
                $this->session->set_flashdata('msg', 'Erro: Incompatibilidade de senhas informadas');
            }
        }
        redirect('home');
    }
    
    public function alterar_foto()
    {
        $docente = $this->docente->getByOne('token', $this->session->token);
        
        $config['upload_path'] = './assets/fotos/';
        $config['file_name'] = $docente->slug;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        
        $this->load->library('upload', $config);
        if($this->upload->do_upload('foto')){
            $docente->foto = $this->upload->data('file_name');
            if($this->docente->update($docente)){
                $this->session->set_flashdata('msg', 'Foto atualizada');
            }
            else{
                $this->session->set_flashdata('msg', 'Erro ao atualizar foto');
            }
        }
        else{
            $this->session->set_flashdata('msg', 'Erro ao fazer o upload da foto');
        }
        redirect('home/complementar');
    }
}