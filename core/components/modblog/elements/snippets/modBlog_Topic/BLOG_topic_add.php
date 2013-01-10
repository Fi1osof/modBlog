<?php

/*
 * Add new blog
 */


if(!$modx->user->isAuthenticated($modx->context->key)){
    $modx->sendUnauthorizedPage();
}

$modx->regClientStartupScript($modx->getOption('modblog.template_url').'js/topic/add.js');
$result = '';

$TVsAliases = array(
    'Blog_tags'    => 'topic_tags',
);

foreach($TVsAliases as $a => $f){
    $$a = $modx->getObject('modTemplateVar', array(
        'name'  => $a,
    ));
}


$options = array(
    // 'blog_limit_rating_topic'   => $BLOG_blogMinRating->get('default_text'),
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
        'isfolder'          => false,
        'parent'            => 0,
        'context_key'       => $modx->getOption('topics_context_key', null, $modx->context->get('key')),
        'pagetitle'         => $options['topic_title'],
        'content'           => $options['topic_text'],
        'topic_blog'           => $options['topic_blog'],
        'tv'.$Blog_tags->get('id') => $options['topic_tags'],
    );
    
    $response = $modx->modblog->runProcessor('web/topic/create', $properties);
    
    if($response->isError()){
        
        $options['ErrorMessage'] = $response->getMessage();
        if(!$options['ErrorMessage']){
            $options['ErrorMessage'] = 'Не удалось сохранить топик';
        }
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
        $url = $modx->getOption('base_url'). 'topics/'.$object['id'];
        $modx->sendRedirect($url);
    }
}


$modx->setPlaceholder('blogData', $_POST);

$result = $modx->getChunk('BLOG_add_topic_tpl', $options);

return $result;