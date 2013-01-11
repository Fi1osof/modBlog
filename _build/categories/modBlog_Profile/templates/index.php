<?php

$templates = array();

$template= $modx->newObject('modTemplate');
$template->fromArray(array(
    'id' => 0,
    'templatename' => 'BLOG_Profile',
    'description' => '',
    'content' => file_get_contents($sources['source_core'].'/elements/templates/modBlog_Profile/BLOG_Profile.php'),
    'properties' => '',
),'',true,true);
$templates['BLOG_Profile'] = $template;
return $templates;
