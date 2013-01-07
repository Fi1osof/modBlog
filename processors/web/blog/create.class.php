<?php

require_once dirname(dirname(dirname(__FILE__))).'/mgr/modsociety/societyblog/create.class.php';

class modBlogBlogCreateProcessor extends modBlogMgrBlogCreateProcessor{
    public $permission = '';
    public $languageTopics = array('resource', 'default');
    public $classKey = 'SocietyBlog';
    
    public static function getInstance(modX &$modx,$className,$properties = array()) {
        $properties['class_key'] = 'SocietyBlog';
        $processor = new modBlogBlogCreateProcessor($modx,$properties);
        return $processor;
    }
    
    public function checkPermissions(){
        return parent::checkPermissions();
    }
    
    function beforeSet(){
        // Проверяем алиас
        $alias = $this->getProperty('alias');
        $len = strlen($alias);
        if($len < 2 || $len > 50){
            $this->addFieldError('alias', "URL блога должен быть от 2 до 50 символов");
        }
        
        $this->setProperty('template', 
                $this->modx->getOption('modblog.blog_default_template', null, 
                        $this->modx->getOption('default_template'))
        );
        return parent::beforeSet();
    }
    
    /*function beforeSave(){
        $this->addFieldError('', 'Debug');
        return false;
    }*/
}

return 'modBlogBlogCreateProcessor';

?>
