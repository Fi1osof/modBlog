<?php

class modBlog{
    
    public $modx;
    
    public $config;


    function __construct(modX &$modx, $params= array ()) {
        $this->modx= & $modx;
        
        $this->getConfig();
    }
    
    protected function getConfig(){
        $core_path = dirname(dirname(dirname(__FILE__))).'/';
        $processors_path = $core_path."processors/web/";
        $this->config = array(
            'core_path' => $core_path,
            'processors_path'   => $processors_path,
        );
    }


    public function runProcessor($action = '', $scriptProperties = array(), $options = array()){
        $options = array_merge($options, array(
            'processors_path'   => $this->config['processors_path'],
        ));
        return $this->modx->runProcessor($action, $scriptProperties, $options);
    }
}
?>
