<?php

$output = ''; 

$q = $modx->newQuery('SocietyTopic');
$q->innerJoin('SocietyBlogTopic', 'TopicBlogs');
$q->innerJoin('SocietyBlog', 'Blog', 'TopicBlogs.blogid=Blog.id');
$q->innerJoin('modUser', 'CreatedBy',  'SocietyTopic.createdby=CreatedBy.id');

$q->where(array(
    'Blog.id' => $modx->resource->id,
    'SocietyTopic.published' => true,
    'SocietyTopic.deleted' => false,
    'SocietyTopic.hidemenu' => false,
    'Blog.published' => true,
    'Blog.deleted' => false,
    'Blog.hidemenu' => false,
));

$q->select(array(
    'SocietyTopic.*',
    'CreatedBy.username'
));
 
$q->sortby('publishedon', 'DESC');

$docs = $modx->getCollection('SocietyTopic', $q);

foreach($docs as $doc){ 
    $options = array(
        'title'     => $doc->get('pagetitle'),
        'author'    => $doc->get('username'),
        'url'       => $modx->context->makeUrl($doc->get('id')),
    );
    
    $output .= $modx->getChunk('BLOG_blogListTpl', $options);
}
 
return $output;