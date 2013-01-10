<?php

require_once MODX_PROCESSORS_PATH.'resource/update.class.php';
require_once (dirname(__FILE__).'/_validation.php');



class modBlogMgrBlogUpdateProcessor extends modResourceUpdateProcessor{
    public $classKey = 'SocietyBlog';
    protected $attributes;
    
    
    public static function getInstance(modX &$modx,$className,$properties = array()) {
        $processor = new modBlogMgrBlogUpdateProcessor($modx,$properties);
        return $processor;
    }
}


return 'modBlogMgrBlogUpdateProcessor';
