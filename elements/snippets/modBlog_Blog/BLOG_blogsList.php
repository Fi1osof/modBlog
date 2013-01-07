<?php

$output = ''; 

$parent = $modx->getOption('blogs_folder');

$q = $modx->newQuery('modResource', array(
    'parent'    => $parent,
));
$q->innerJoin('modUser', 'CreatedBy');

$q->select(array(
    'modResource.*',
    'CreatedBy.username'
));

$docs = $modx->getCollection('modResource', $q);

foreach($docs as $doc){ 
    $options = array(
        'title'     => $doc->get('pagetitle'),
        'author'    => $doc->get('username'),
        'url'       => $modx->context->makeUrl($doc->get('id')),
    );
    
    $output .= $modx->getChunk('BLOG_blogListTpl', $options);
}
 
return $output;