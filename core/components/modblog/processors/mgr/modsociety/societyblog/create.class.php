<?php

require_once MODX_PROCESSORS_PATH.'resource/create.class.php';
require_once (dirname(__FILE__).'/_validation.php');
 
class modBlogMgrBlogCreateProcessor extends modResourceCreateProcessor{
    public $classKey = 'SocietyBlog';
    protected $attributes;
    
    
    public static function getInstance(modX &$modx,$className,$properties = array()) {
        $properties['class_key'] = 'SocietyBlog';
        $processor = new modBlogMgrBlogCreateProcessor($modx,$properties);
        return $processor;
    }
    
    function beforeSet(){
        
        // Проверяем заголовок
        $pagetitle = $this->getProperty('pagetitle');
        $len = strlen($pagetitle);
        if($len < 2 || $len > 200){
            $this->addFieldError('pagetitle', "Название блога должно быть от 2 до 200 символов");
        }
        
        // Проверяем описание
        $content = $this->getProperty('content');
        $len = strlen($content);
        if($len < 10 || $len > 3000){
            $this->addFieldError('ta', "Текст описания блога должен быть от 10 до 3000 символов");
        }
        
        // Проверяем уникальностье текста
        if($this->modx->getObject('SocietyBlogAttributes', array(
            'content_hash'  => md5($content),
        ))){
            $this->addFieldError('ta', "Текст описания блога не уникальный");
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
        $this->attributes = $this->modx->newObject('SocietyBlogAttributes');
        $this->attributes->set('content_hash', md5($this->object->get('content')));
        $this->object->addOne($this->attributes);
    }
}

return 'modBlogMgrBlogCreateProcessor';