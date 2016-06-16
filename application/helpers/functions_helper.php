<?php

//Converte um array de objetos para array
function convertDocenteToArr($arr_obj)
{
    if(!is_array($arr_obj) || !$arr_obj){
        return false;
    }
    
    //Requer o slug_helper
    $ci =& get_instance();
    $ci->load->helper('slug');
    
    $list = array();
    
    foreach ($arr_obj as $obj)
    {
        $reg = array(
            'token' => $obj->token,
            'slug'  => url_slug($obj->nome)            
        );
        $list[] = $reg;
    }
    
    return $list;
}