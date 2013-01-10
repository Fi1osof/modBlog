<?php

$templates = array();

$template= $modx->newObject('modTemplate');
$template->fromArray(array(
    'id' => 0,
    'templatename' => 'BLOG_Blog',
    'description' => '',
    'content' => file_get_contents($sources['source_core'].'/elements/templates/modBlog_Blog/BLOG_Blog.php'),
    'properties' => '',
),'',true,true);
$templates['BLOG_Blog'] = $template;
return $templates;
