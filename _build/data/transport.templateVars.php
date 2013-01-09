<?php

$TemplateVars = array();

$tv = $modx->newObject('modTemplateVar', array(
    'name'      => 'BLOG_avatar',
    'caption'         => 'Аватарка',
    'type'      => 'image',
));
$tv->set('id', 0);
$tv->addOne($mediaSources['BLOG_uploads'], 'Source');
$TemplateVars['BLOG_avatar'] = $tv;





// return $TemplateVars;