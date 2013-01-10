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

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_Widget_blogList_OuterTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/modBlog_Blog/BLOG_Widget_blogList_OuterTpl.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_Widget_blogList_RowTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/modBlog_Blog/BLOG_Widget_blogList_RowTpl.tpl'),
    /*'properties' => array(
        'current'   => array(
            'name'  => 'current',
            'desc'  => '',
            "type" => "textfield",  
            'options' => array(),
        ),
    ),*/
),'',true,true);

$chunk->set('properties', array(
    'current'   => array(
            'name'  => 'current',
            'desc'  => '',
            "type" => "textfield",  
            'options' => array(),
            'value' => '',
            'lexicon'   => '',
            'area'      => '',
     ),
));

$chunks[] = $chunk;

return $chunks;
?>
