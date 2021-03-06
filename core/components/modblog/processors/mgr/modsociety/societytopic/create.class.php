<?php

require_once MODX_PROCESSORS_PATH.'resource/create.class.php';
require_once (dirname(__FILE__).'/_validation.php');
 
class modBlogMgrTopicCreateProcessor extends modResourceCreateProcessor{
    public $classKey = 'SocietyTopic';
    protected $attributes;
    
    
    public static function getInstance(modX &$modx,$className,$properties = array()) {
        $properties['class_key'] = 'SocietyTopic';
        $processor = new modBlogMgrTopicCreateProcessor($modx,$properties);
        return $processor;
    }
    
    function beforeSet(){
        
        // Проверяем заголовок
        $pagetitle = $this->getProperty('pagetitle');
        $len = strlen($pagetitle);
        if($len < 2 || $len > 200){
            $this->addFieldError('pagetitle', "Название топика должно быть от 2 до 200 символов");
        }
        
        // Проверяем описание
        $content = $this->getProperty('content');
        $len = strlen($content);
        if($len < 50 || $len > 30000){
            $this->addFieldError('ta', "Текст топика должен быть от 50 до 30000 символов");
        }
        
        // Проверяем уникальностье текста
        if($content && $this->modx->getObject('SocietyTopicAttributes', array(
            'content_hash'  => md5($content),
        ))){
            $this->addFieldError('ta', "Текст топика не уникальный");
        }
        
        if($this->hasErrors()){
            return "Ошибка сохранения документа";
        }
        
        return parent::beforeSet();
    }
    
    public function beforeSave(){
        $this->addAttributes();
        return parent::beforeSave();
    }
    
    public function addAttributes(){
        $this->attributes = $this->modx->newObject('SocietyTopicAttributes');
        $this->attributes->set('content_hash', md5($this->object->get('content')));
        $this->object->addOne($this->attributes);
    }
}

return 'modBlogMgrTopicCreateProcessor';