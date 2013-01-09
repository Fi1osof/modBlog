<?php

$chunks = array();

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_FOOTER',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/BLOG_FOOTER.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 1,
    'name' => 'BLOG_HEAD',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/BLOG_HEAD.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;


$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 2,
    'name' => 'BLOG_HEADER',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/BLOG_HEADER.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_LOGIN',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/BLOG_LOGIN.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_LgnLoginTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/BLOG_LgnLoginTpl.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_LgnLogoutTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/BLOG_LgnLogoutTpl.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;

$chunk= $modx->newObject('modChunk');
$chunk->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_MODAL_WINDOWS',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/BLOG_MODAL_WINDOWS.tpl'),
    'properties' => '',
),'',true,true);
$chunks[] = $chunk;


return $chunks;