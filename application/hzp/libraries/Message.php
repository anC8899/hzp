<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message {

    public function __construct($params='')
    {
        // Do something with $params
    }
    
    //������ʾ
    function message_error($msg,$mod='error')
    {
        $mag = "<span class=\"label label-important\">{$msg}</span>";
        $msg = array( 'msg'=>$mag,'mod'=>$mod );            
        die(json_encode($msg));        
    }
    
    //�ɹ���ʾ
    function message_success($msg,$mod='success')
    {
        $mag = "<span class=\"label label-success\">{$msg}</span>";
        $msg = array( 'msg'=>$mag,'mod'=>$mod );            
        die(json_encode($msg));   
    }
    
    //��ͨ��ʾ
    function message_info($msg,$mod='info')
    {
        $mag = "<span class=\"label label-info\">{$msg}</span>";
        $msg = array( 'msg'=>$mag,'mod'=>$mod );            
        die(json_encode($msg));        
    }
}

?>