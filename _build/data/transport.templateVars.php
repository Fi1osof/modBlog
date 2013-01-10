<?php

$TemplateVars = array();

$tv = $modx->newObject('modTemplateVar', array(
    'name'      => 'BLOG_avatar',
    'caption'   => 'Аватарка',
    'type'      => 'image',
));
$tv->set('id', 0);
$tv->addOne($mediaSources['BLOG_uploads'], 'Source');
$TemplateVars['BLOG_avatar'] = $tv;



$tv = $modx->newObject('modTemplateVar', array(
    'name'      => 'Blog_tags',
    'caption'   => 'Теги',
    'type'      => 'text',
    'input_properties'  => array(
        'allowBlank'    => false,
        'maxLength'     => '',
        'minLength' => '',
    ),
));
$tv->set('id', 0);
$TemplateVars['Blog_tags'] = $tv;


// return $TemplateVars;