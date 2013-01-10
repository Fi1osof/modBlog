<?php

$templates = array();

$template= $modx->newObject('modTemplate');
$template->fromArray(array(
    'id' => 0,
    'templatename' => 'BLOG_Topic',
    'description' => '',
    'content' => file_get_contents($sources['source_core'].'/elements/templates/modBlog_Topic/BLOG_Topic.php'),
    'properties' => '',
),'',true,true);
$templates['BLOG_Topic'] = $template;
return $templates;
