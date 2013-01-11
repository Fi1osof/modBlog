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
            $this->sendErrorPage();
            return;
        }
        // $this->modx->resource = $this->getTopic(array(
        if(!$this->modx->resource = $this->modx->getObject('modResource',array(
            'id'    => $idInt,
            'published' => true,
            'deleted'   => false,
        ))){
            $this->sendErrorPage();
            return;
        }
        
        return $this->prepareResponse();
    }
    
    /*
     * Show profile
     */
    public function showProfile($username){
        if(!$page_id = intval($this->modx->getOption('profile_resource', null))
                OR !$resource = & $this->getProfilePage($username, $page_id)){
            $this->sendErrorPage();
            return;
        }
        
        $resource->set('pagetitle', "Профиль ". $username);
        return $this->prepareResponse();
    }
    
    
    /*
     * Show profile topics
     */
    public function showProfileTopics($username){
        if(!$page_id = intval($this->modx->getOption('profile_topics_resource', null))
                OR !$resource = & $this->getProfilePage($username, $page_id)){
            $this->sendErrorPage();
            return;
        }
        
        $resource->set('pagetitle', "Все топики ". $username);
        return $this->prepareResponse();
    }
    
    
    public function getProfilePage($username, $page_id){
        if(!$username || !$page_id){
            return false;
        }
        
        if(!$user = $this->modx->getObject('modUser',array(
            'username'  => $username,
        ))){
            return false;
        }
        
        // $this->modx->resource = $this->getTopic(array(
        if(!$this->modx->resource = $this->modx->getObject('modResource',array(
            'id'    => $page_id,
            'published' => true,
            'deleted'   => false,
        ))){
            return false;
        }
        
        $this->modx->resource->set('user', $user);
        
        return $this->modx->resource;
    }
}
?>
