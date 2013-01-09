<?php

/*
 * Add new blog
 */

if(!$modx->user->isAuthenticated($modx->context->key)){
    $modx->sendUnauthorizedPage();
}

$modx->regClientStartupScript($modx->getOption('modblog.template_url').'js/blog/add.js');
$result = '';

$TVsAliases = array(
    'BLOG_blogMinRating'    => 'blog_limit_rating_topic',
    'BLOG_blogType'         => 'blog_type',
);

foreach($TVsAliases as $a => $f){
    $$a = $modx->getObject('modTemplateVar', array(
        'name'  => $a,
    ));
}


$options = array(
    'blog_limit_rating_topic'   => $BLOG_blogMinRating->get('default_text'),
);



if(!empty($_POST['save_blog'])){
    $modx->lexicon->load('ru:core:default');
    
    foreach($_POST as $k => $v){
        if(!is_string($v)){continue;}
        $options["{$k}"] = $v;
    }
     
    $properties = array(
        'syncsite'          => true,
        'published'         => true,
        'isfolder'          => true,
        'parent'            => $modx->getOption('blogs_folder'),
        'context_key'       => $modx->context->key,
        'pagetitle'         => $options['blog_title'],
        'alias'             => $options['blog_url'],
        'content'           => $options['blog_description'],
        'tv'.$BLOG_blogMinRating->get('id') => $options['blog_limit_rating_topic'],
        'tv'.$BLOG_blogType->get('id') => $options['blog_type'],
    );
    
    $response = $modx->modblog->runProcessor('web/blog/create', $properties);
    
    if($response->isError()){
        
        $options['ErrorMessage'] = $response->getMessage();
        if($response->hasFieldErrors()){
            $errors  = '';
            foreach($response->getFieldErrors() as $err){
                 $errors  .=  "<p>Ошибка: ".$err->getMessage()."</p>";
            }
            $options['errors'] = $errors;
        }
    }
    else{
        $object = $response->getObject();
        $modx->context->prepare(true); 
        $url = $modx->context->makeUrl($object['id']);
        $modx->sendRedirect($url);
    }
}


$modx->setPlaceholder('blogData', $_POST);

$result = $modx->getChunk('BLOG_add_blog_tpl',  $options);

return $result;