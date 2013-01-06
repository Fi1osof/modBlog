<?php

/*
 * @package modxRepository
 * @subpackage build
 * @author Fi1osof
 * http://community.modx-cms.ru/profile/Fi1osof/
 * http://modxstore.ru
 */
global  $modx, $sources;
$settings = array();

$settings['modblog.assets_url'] = $modx->newObject('modSystemSetting');
$settings['modblog.assets_url']->fromArray(array(
    'key' => 'modblog.assets_url',
    'value' => '{assets_url}components/modblog/',
    'xtype' => 'textfield',
    'namespace' => NAMESPACE_NAME,
    'area' => 'site',
),'',true,true);


$settings['modblog.template'] = $modx->newObject('modSystemSetting');
$settings['modblog.template']->fromArray(array(
    'key' => 'modblog.template',
    'value' => 'default',
    'xtype' => 'textfield',
    'namespace' => NAMESPACE_NAME,
    'area' => 'site',
),'',true,true);


$settings['modblog.template_url'] = $modx->newObject('modSystemSetting');
$settings['modblog.template_url']->fromArray(array(
    'key' => 'modblog.template_url',
    'value' => '{modblog.assets_url}templates/{modblog.template}/',
    'xtype' => 'textfield',
    'namespace' => NAMESPACE_NAME,
    'area' => 'site',
),'',true,true);


$settings['modsociety.controller_path'] = $modx->newObject('modSystemSetting');
$settings['modsociety.controller_path']->fromArray(array(
    'key' => 'modsociety.controller_path',
    'value' => '{core_path}components/modblog/controllers/mgr/modsociety/',
    'xtype' => 'textfield',
    'namespace' => NAMESPACE_NAME,
    'area' => 'site',
),'',true,true);

 
return $settings;