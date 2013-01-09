<?php


$chunks  = array();

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_add_blog_tpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/modBlog_Blog/BLOG_add_blog_tpl.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_blogListTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/modBlog_Blog/BLOG_blogListTpl.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;

return $chunks;
?>
