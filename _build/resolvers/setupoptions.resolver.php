<?php

$success= false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        
        $modx = & $object->xpdo;
        
        // Add  extension Package
        $name = 'modBlog';
        $params = array(
            'serviceName'   => 'modblog',
            'serviceClass'  =>  'modBlog',
        );
        $path = '[[++core_path]]components/modblog/model/';
        $modx->addExtensionPackage($name,$path,$params);
        unset($name, $path,$params);
        
        
        
        
        /* Check for creating context */
        if(!isset($options['contextAction']) || !$options['contextAction'] || $options['contextAction'] == 'none'){
            return true;
        }
        
        $context_key = null;
        $ctx = null;
        $ctx_for_topics = null;
        
        switch($options['contextAction']){
            case 'new':
                if(!empty($options['newContextName'])){
                    $context_key = $options['newContextName'];
                }
                
                if(!$context_key){
                    $modx->log(xPDO::LOG_LEVEL_ERROR, "ContextName is not set");
                    return false;
                }
                
                /* Check is context exists */
                if($modx->getObject('modContext',  $context_key)){
                    $modx->log(xPDO::LOG_LEVEL_ERROR, "Context with key {$context_key} already exists");
                    return false;
                }
                
                /* Create new context */
                $ctx = $modx->newObject('modContext');
                $ctx->set('key', $context_key);
                if(!$ctx->save()){
                    $modx->log(xPDO::LOG_LEVEL_ERROR, "Can not save context with key '{$context_key}'");
                    return false;
                }
                
                break;
            
            case 'exists':
                
                if(!empty($options['context'])){
                    $context_key = $options['context'];
                }
                
                if(!$context_key){
                    $modx->log(xPDO::LOG_LEVEL_ERROR, "ContextName is not set");
                    return false;
                }
                
                if(!$ctx = $modx->getObject('modContext',  $context_key)){
                    $modx->log(xPDO::LOG_LEVEL_ERROR, "Context with key {$context_key} not exists");
                    return false;
                }
                
                break;
            
            default:;
        }
        
        
        if(!$ctx){
            $modx->log(xPDO::LOG_LEVEL_ERROR, "Context not set");
            return false;
        }
        $ctx->prepare(true);
        
        $modx->log(xPDO::LOG_LEVEL_WARN, "Update context ". $ctx->get('key'));
        
        
        // Get Templates
        $tplNames = array(
            'BLOG_MainPage',
            'BLOG_DEFAULT',
        );
        $tplVarPrefix = "tpl_";
        foreach($tplNames as $tplName){
            $varName = $tplVarPrefix.$tplName;
            if(!$$varName  = $modx->getObject('modTemplate', array('templatename'  => $tplName)   ) ){
                $modx->log(xPDO::LOG_LEVEL_ERROR, "Could not get Template with name '{$tplName}'");
                return false;
            } 
        }
        
        
        /*
         * Create documents
         */
        function _create_docs(&$modx, $context_key, $node, $doc = null){
            $base_params = array(
                'update'    => true,    // if set True, document will be updated
                'published' => true,
                'hidemenu'  => false,
                'deleted'   => false,
                'isfolder'  => true,
                'searchable'    => false,
                'context_key'   => $context_key,
                'class_key'     => 'modDocument',
                'cacheable'     => false,
            );
            if(isset($node['childs'])){
                $menuindex = 0;
                foreach($node['childs'] as $n){
                    $menuindex++;
                    $pid = ($doc ? $doc->id : 0);
                    $params = array_merge($base_params, $n);
                    $params['parent']    =  $pid;
                    if(!$doc__ = $modx->getObject('modResource', array(
                        'context_key' => $context_key,
                        'parent'    =>  $pid,
                        'alias'     =>  $n['alias'],
                    ))){
                        $params['menuindex'] = $menuindex;
                        $doc__ = $modx->newObject($params['class_key'], $params);
                        if(!$doc__->save()){
                            $modx->log(xPDO::LOG_LEVEL_ERROR, "Can not save {$n['pagetitle']} document");
                            return false;
                        }
                    }
                    else if($params['update'] === true){
                        $doc__->fromArray($params);
                        if(!$doc__->save()){
                            $modx->log(xPDO::LOG_LEVEL_ERROR, "Can not update {$n['pagetitle']} document");
                            return false;
                        }
                    }
                    _create_docs($modx, $context_key, $n, $doc__);
                }
            }
        }
        
        $root = array(
            'childs'   => array(
                array(
                    'pagetitle' => 'Home',
                    'alias'     => 'index',
                    'template'  => $tpl_BLOG_MainPage->get('id'),
                    'searchable'    => true,
                    'isfolder'  => false,
                ),
                array(
                    'pagetitle' => 'Common',
                    'alias'     => 'common',
                    'template'  => 0,
                    'published' => false,
                    'childs'   => array(
                        array(
                            'pagetitle' => '404',
                            'alias'     => '404',
                            'template'  => $tpl_BLOG_DEFAULT->get('id'),
                            'content'   => '<h2>Страница не найдена</h2>',
                        ),
                        array(
                            'pagetitle' => 'Нет доступа',
                            'alias'     => '403',
                            'template'  => $tpl_BLOG_DEFAULT->get('id'),
                            'content'   => '<h2>У вас нет доступа к этой странице.</h2>',
                        ),
                        array(
                            'pagetitle' => 'Пожалуйста, авторизуйтесь',
                            'alias'     => '401',
                            'template'  => $tpl_BLOG_DEFAULT->get('id'),
                            'content'   => '<h2>Пожалуйста, авторизуйтесь.</h2>',
                        ),
                    ),
                ),
                array(
                    'pagetitle' => 'Блог',
                    'alias'     => 'blog',
                    'template'  => $tpl_BLOG_DEFAULT->get('id'),
                    'published' => false,
                    'childs'   => array(
                        array(
                            'pagetitle' => 'Создать блог',
                            'alias'     => 'add',
                            'template'  => $tpl_BLOG_DEFAULT->get('id'),
                            'content'   => '[[!BLOG_blog_add]]'
                        ),
                    ),
                ),
                array(
                    'pagetitle' => 'Топик',
                    'alias'     => 'topic',
                    'template'  => $tpl_BLOG_DEFAULT->get('id'),
                    'published' => false,
                    'childs'   => array(
                        array(
                            'pagetitle' => 'Создать топик',
                            'alias'     => 'add',
                            'template'  => $tpl_BLOG_DEFAULT->get('id'),
                            'content'   => '[[!BLOG_topic_add]]',
                        ),
                    ),
                ),
                array(
                    'pagetitle' => 'Сообщения',
                    'alias'     => 'talk',
                    'template'  => $tpl_BLOG_DEFAULT->get('id'),
                    'published' => false,
                    'childs'   => array(
                        array(
                            'pagetitle' => 'Создать сообщение',
                            'alias'     => 'add',
                            'template'  => $tpl_BLOG_DEFAULT->get('id'),
                            'content'   => '<p>[[*pagetitle]]</p>'
                        ),
                    ),
                ),
                array(
                    'pagetitle' => 'Блоги',
                    'alias'     => 'blogs',
                    'template'  => $tpl_BLOG_DEFAULT->get('id'),
                    'published' => true,
                ),
            )
        );
        
        _create_docs($modx, $ctx->get('key'), $root, null);
        
        
        /* Create Home document */
        /*if(!$doc = $modx->getObject('modResource', array(
            'context_key' => $ctx->get('key'),
            'parent'    =>  0,
            'alias'     =>  'index',
        ))){
            $doc = $modx->newObject('modResource', array_merge($base_params,array(
                'pagetitle' => 'Home',
                'alias'     => 'index',
                'parent'    =>  0,
                'template'  => $tpl_BLOG_MainPage->get('id'),
            )));
            if(!$doc->save()){
                $modx->log(xPDO::LOG_LEVEL_ERROR, "Can not save Home document");
                return false;
            }
        }*/
        
        /* Set context options */
        $settings = array();
        
        if(empty($ctx->config['site_start'])){
            if($doc = $modx->getObject('modResource', array(
                'parent'    => 0,
                'alias'     => 'index',
                'context_key' => $ctx->get('key'),
            ))){
               $setting = $modx->newObject('modContextSetting', array(
                    'xtype' => 'numberfield',
                    'value' => $doc->get('id'),
                    'area'  => 'site',
                ));
                $setting->set('key', 'site_start');
                $settings[] = $setting; 
            }
        }
        
        if(empty($ctx->config['error_page'])){
            if($doc = $modx->getObject('modResource', array(
                'alias'     => '404',
                'context_key' => $ctx->get('key'),
            ))){
               $setting = $modx->newObject('modContextSetting', array(
                    'xtype' => 'numberfield',
                    'value' => $doc->get('id'),
                    'area'  => 'site',
                ));
                $setting->set('key', 'error_page');
                $settings[] = $setting; 
            }
        }
        
        // Check for context for topics
        if(empty($ctx->config['topics_context_key'])){
            $topics_context_key = $ctx->get('key').'-topics';
            if(!$ctx_for_topics = $modx->getObject('modContext', $topics_context_key)){
                $ctx_for_topics = $modx->newObject('modContext');
                $ctx_for_topics->set('key', $topics_context_key);
                if(!$ctx_for_topics->save()){
                    $modx->log(xPDO::LOG_LEVEL_ERROR, "Can not save context with key '{$topics_context_key}'");
                }
            }
            if($ctx_for_topics && !$ctx_for_topics->isNew()){
                $setting = $modx->newObject('modContextSetting', array(
                    'xtype' => 'textfield',
                    'value' => $topics_context_key,
                    'area'  => 'site',
                ));
                $setting->set('key', 'topics_context_key');
                $settings[] = $setting; 
            }
        }
        
        
        
        if(empty($ctx->config['blogs_folder'])){
            if($doc = $modx->getObject('modResource', array(
                'alias'     => 'blogs',
                'context_key' => $ctx->get('key'),
            ))){
               $setting = $modx->newObject('modContextSetting', array(
                    'xtype' => 'numberfield',
                    'value' => $doc->get('id'),
                    'area'  => 'site',
                ));
                $setting->set('key', 'blogs_folder');
                $settings[] = $setting; 
            }
        }
        
        
        // Save context settings
        if($settings){
            $ctx->addMany($settings);
            $ctx->save();
        }
        unset($settings);
         
        
        /* Create context access policies */
        //  Add administrator access
        $policies = array(
            'Administrator' => array(
                'modUserGroup' => 'Administrator',
                'modUserGroupRole'  => 'Super User'
            ),
            'Blog Administrator' => array(
                'modUserGroup' => 'Blog Administrators',
                'modUserGroupRole'  => 'Blog Administrator'
            ),
            'Blog Moderator' => array(
                'modUserGroup' => 'Blog Moderators',
                'modUserGroupRole'  => 'Blog Moderator'
            ),
            'Load, List and View' => array(
                'modUserGroup' => 'Blog Members',
                'modUserGroupRole'  => 'Member'
            ),
        );

        foreach($policies as $name => $p){
            $modUserGroupRole = $modx->getObject('modUserGroupRole', array('name' => $p['modUserGroupRole']));
            $modUserGroup = $modx->getObject('modUserGroup', array('name' => $p['modUserGroup']));
            $policy = $modx->getObject('modAccessPolicy', array('name'  => $name, )); 

            if($modUserGroupRole && $modUserGroup && $policy){
                if(!$modx->getObject('modAccessContext', array(
                    'principal' => $modUserGroup->get('id'),
                    'policy'    => $policy->get('id'),
                    'target'    =>  $ctx->get('key'),
                ))){
                    $modAccessContext = $modx->newObject('modAccessContext', array(
                        'authority' => $modUserGroupRole->get('authority'),
                    ));
                    $modAccessContext->addOne($modUserGroup, 'GroupPrincipal');
                    $modAccessContext->addOne($ctx, 'Target');
                    $modAccessContext->addOne($policy, 'Policy'); 
                    $modAccessContext->save();
                }
            }
        }
        
        
        /* Update topics context */
        if($ctx_for_topics && !$ctx_for_topics->isNew() && $ctx_for_topics->prepare()){
            $settings = array();
        
            if(empty($ctx->config['site_start'])){
                if($doc = $modx->getObject('modResource', array(
                    'parent'    => 0,
                    'alias'     => 'index',
                    'context_key' => $ctx->get('key'),
                ))){
                $setting = $modx->newObject('modContextSetting', array(
                        'xtype' => 'numberfield',
                        'value' => $doc->get('id'),
                        'area'  => 'site',
                    ));
                    $setting->set('key', 'site_start');
                    $settings[] = $setting; 
                }
            }
        }
        
        
        /*
         * Create system settings
         */
        
        if(!$modx->getObject('modSystemSetting', array(
            'key'   => 'modblog.blog_default_template'
        )) && $tpl = $modx->getObject('modTemplate', array(
            'templatename'  => 'BLOG_Blog',
        ))){
            $setting = $modx->newObject('modSystemSetting', array(
                'xtype' => 'textfield',
                'area'  => 'site',
            ));
            $setting->set('key', 'modblog.blog_default_template');
            $setting->set('namespace', 'modblog');
            $setting->set('value', $tpl->get('id'));
            
            $setting->save();
        }
        
        
        if(!$modx->getObject('modSystemSetting', array(
            'key'   => 'modblog.topic_default_template'
        )) && $tpl = $modx->getObject('modTemplate', array(
            'templatename'  => 'BLOG_Topic',
        ))){
            $setting = $modx->newObject('modSystemSetting', array(
                'xtype' => 'textfield',
                'area'  => 'site',
            ));
            $setting->set('key', 'modblog.topic_default_template');
            $setting->set('namespace', 'modblog');
            $setting->set('value', $tpl->get('id'));
            
            $setting->save();
        }
        
        
        $success= true;
        break;
    case xPDOTransport::ACTION_UNINSTALL:
        $success= true;
        break;
}
return $success;