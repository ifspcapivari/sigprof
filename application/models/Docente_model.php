<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Docente_model
 *
 * @author Rafael W. Pinheiro
 */
class Docente_model extends CI_Model {
    
    public $iddocente;
    public $nome;
    public $slug;
    public $email;
    public $perfil;
    public $usuario;
    public $senha;
    public $token;
    public $foto;
    public $curriculo;
    public $titulacao;
    public $descricao;
                
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function autenticar()
    {
        return  $this->db
                ->select('nome, perfil, token')
                ->from('docente d')
                ->where('usuario', $this->usuario)
                ->where('senha', $this->senha)
                ->get()
                ->row_object();
    }
    
    public function getByOne($param, $value)
    {
        return  $this->db
                ->select('*')
                ->from('docente d')
                ->where($param, $value)
                ->get()
                ->row_object();
    }
}
