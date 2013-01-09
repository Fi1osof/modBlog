<?php
 
$path = $this->getOption('modsociety.core_path', null);

if(!$path){
    $path = MODX_CORE_PATH .'components/modsociety/';
}
$path .= 'model/modSociety/';

if(!$this->loadClass('modSociety', $path, false, true)){
    $this->log(self::LOG_LEVEL_ERROR, "Could not load class modSociety");
    exit;
}

class modBlog extends modSociety{
    protected function getCorePath(){
        return dirname(dirname(dirname(__FILE__))).'/';
    }    
}
?>
