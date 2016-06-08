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
        $url  = 'http://localhost/ifcpv-auth-center/api/auth/34d8e18e40e2ec285bc6083fba31ceb1';
        $data = ['usuario' => '130266', 'senha' => '123456'];
        
        $ch   = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_PROXY, 'http://130266:05071986@192.168.254.254:3128');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);

        curl_close($ch);
        
        echo $result;
    }
}
