<?php 

$snippets = array();
   
$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_topic_add',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/modBlog_Topic/BLOG_topic_add.php'),
),'',true,true);
// $snippet->setProperties($properties);
$snippets[]  = $snippet;
unset($snippet);


$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_topicsList',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/modBlog_Topic/BLOG_topicsList.php'),
),'',true,true);
$snippet->setProperties(array(
    'blog_id'   => array(
        'name'  => 'blog_id',
        'desc'  => '',
        'options'   => array(),
        'type'  => 'textfield',
        'value' => '',
        'lexic' => '',
        'area'  => '',
    ),
    'user_id'   => array(
        'name'  => 'user_id',
        'desc'  => '',
        'options'   => array(),
        'type'  => 'textfield',
        'value' => '',
        'lexic' => '',
        'area'  => '',
    ),
));
$snippets[]  = $snippet;
unset($snippet);
 

return $snippets;

?>
