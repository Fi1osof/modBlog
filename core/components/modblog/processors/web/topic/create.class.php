<?php

require_once dirname(dirname(dirname(__FILE__))).'/mgr/modsociety/societytopic/create.class.php';

class modBlogTopicCreateProcessor extends modBlogMgrTopicCreateProcessor{
    public $permission = '';
    public $languageTopics = array('resource', 'default');
    public $classKey = 'SocietyTopic';
    public $blogs;
    public $blogtopics;
    
    public static function getInstance(modX &$modx,$className,$properties = array()) {
        $properties['class_key'] = 'SocietyTopic';
        $processor = new modBlogTopicCreateProcessor($modx,$properties);
        return $processor;
    }
    
    public function checkPermissions(){
        return parent::checkPermissions();
    }
    
    function beforeSet(){
        // Проверяем Теги
        $this->setTags();
        
        // Проверяем блог
        $this->setBlogs();
        
        $content = $this->getProperty('content');
        $this->setProperty('content', preg_replace('/\n/', '<br />',  $content));
        
        $this->setProperty('template', 
                $this->modx->getOption('modblog.topic_default_template', null, 
                        $this->modx->getOption('default_template'))
        );
        return parent::beforeSet();
    }
    
    function setTags(){
        if(!$tv = $this->modx->getObject('modTemplateVar', array(
            'name'  => 'Blog_tags',
        ))){
            $this->addFieldError('tags', 'Не был получен TV теги');
            return false;
        }
        
        if(!$this->getProperty('tv'.$tv->get('id'))){
            $this->addFieldError('tags', 'Не заполнены теги');
            return false;
        }
        
        return true;
    }
    
    function setBlogs(){
        if(!$topic_blog = trim($this->getProperty('topic_blog'))){
            // $this->addFieldError('topic_blog', 'Не указан блог');
            return true;
        }
        
        if(!$this->blogs = $this->modx->modblog->getBlogs(array(
            'id:IN' => explode(",", $topic_blog),
            'published' => true,
            'deleted'   => false,
        ))){
            return true;
        }
        
        $this->blogtopics = array();

        foreach($this->blogs as $blog){
            $tb = $this->modx->newObject('SocietyBlogTopic');
            $tb->addOne($blog);
            $this->blogtopics[] = $tb;
        }

        $this->object->addMany($this->blogtopics);
        
        return true;
    }
    
    /*function beforeSave(){
        $this->addFieldError('', 'Debug');
        return false;
    }*/
}

return 'modBlogTopicCreateProcessor';

?>
