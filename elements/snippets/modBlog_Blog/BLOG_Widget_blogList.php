<?php

$output = '';
$options = '';

$q = $modx->newQuery('SocietyBlog');
$q->select(array(
    'SocietyBlog.id',
    'SocietyBlog.pagetitle'
));
$q->sortby('pagetitle');

$options .= $modx->getChunk($rowTpl, array(
    'id'    => 0,
    'title' => 'Мой персональный блог',
));

if($blogs = $modx->modblog->getBlogs($q)){
    foreach($blogs as $blog){
        $params = array_merge($scriptProperties, array(
            'id'    =>$blog->get('id'),
            'title' => $blog->get('pagetitle'),
        ));
        $options .= $modx->getChunk($rowTpl, $params);
    }
}

$output = $modx->getChunk($outerTpl, array_merge(
    $scriptProperties, array(
        'options'   =>  $options,
    ))
);

return  $output;
