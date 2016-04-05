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
    
    public function insertBatch($list)
    {
        return $this->db->insert_batch('docente', $list);
    }

    public function update($docente)
    {
        return $this->db->update('docente', $docente, array('iddocente' => $docente->iddocente));
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
    
    public function getAll()
    {
        return $this->db->get('docente')->result();
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
    
    public function verificarDuplicidade($list, $fields)
    {
        $field = array();
        foreach ($fields as $f){
            $field[$f] = $this->getArrayOf($f);
        }
        
        $validar = true;
        $msg = "";
        foreach ($list as $data){
            foreach ($data as $key => $value){
                if(in_array($key, $fields)){
                    if(in_array($value, $field[$key])){
                        $msg .= "'$key' duplicado: '$value'\n";
                        $validar = false;
                    }
                }            
            }
        }
        
        if($validar === false){
            throw new Exception($msg);
        }
        return true;
    }
    
    protected function getArrayOf($param)
    {
        $result = $this->db->select($param)->from('docente d')->get()->result_array();
        $array = array();
        
        foreach ($result as $res){
            $array[] = $res[$param];
        }
        
        return $array;
    }
}
