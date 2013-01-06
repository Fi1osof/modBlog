<?php

$Templates = array();


$template= $modx->newObject('modTemplate');
$template->fromArray(array(
    'id' => 0,
    'templatename' => 'BLOG_Blog',
    'description' => '',
    'content' => file_get_contents($sources['source_core'].'/elements/templates/BLOG_Blog.php'),
    'properties' => '',
),'',true,true);
$Templates['BLOG_Blog'] = $template;


$template= $modx->newObject('modTemplate');
$template->fromArray(array(
    'id' => 0,
    'templatename' => 'BLOG_DEFAULT',
    'description' => '',
    'content' => file_get_contents($sources['source_core'].'/elements/templates/BLOG_DEFAULT.php'),
    'properties' => '',
),'',true,true);
$Templates['BLOG_DEFAULT'] = $template;


$template= $modx->newObject('modTemplate');
$template->fromArray(array(
    'id' => 0,
    'templatename' => 'BLOG_MainPage',
    'description' => '',
    'content' => file_get_contents($sources['source_core'].'/elements/templates/BLOG_MainPage.php'),
    'properties' => '',
),'',true,true);
$Templates['BLOG_MainPage'] = $template;


// return $Templates;