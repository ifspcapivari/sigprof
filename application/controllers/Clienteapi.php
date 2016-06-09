<?php
/**
 * Description of ClienteApi
 *
 * @author rafael
 */
class Clienteapi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->library('curlib');
        
        $this->curlib->setUrl('http://localhost/ifcpv-auth-center/api/auth/34d8e18e40e2ec285bc6083fba31ceb1');
        $this->curlib->setType('post');
        
        $data = ['usuario' => '130266', 'senha' => '1234'];        
        $this->curlib->setPostParams($data);
        
        $result = $this->curlib->execute();
        
        print_r($result);
        //echo $result->data->nome;
    }
}
