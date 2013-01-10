<?php
 
$path = $this->getOption('modsociety.core_path', null);

if(!$path){
    $path = MODX_CORE_PATH .'components/modsociety/';
}
$path .= 'model/modSociety/';

if(!$this->loadClass('modSociety', $path, false, true)){
    $this->log(self::LOG_LEVEL_ERROR, "Could not load class modSociety");
    return false;
}

class modBlog extends modSociety{
    protected function getCorePath(){
        return dirname(dirname(dirname(__FILE__))).'/';
    }   
    
    /*
     * Show topic
     */
    
    public function showTopic($id){
        if(!$idInt = intval($id)){
            return false;
        }
        // $this->modx->resource = $this->getTopic(array(
        $this->modx->resource = $this->modx->getObject('modResource',array(
            'id'    => $idInt,
            'published' => true,
            'deleted'   => false,
        ));
        
        return $this->prepareResponse();
    }
}
?>
