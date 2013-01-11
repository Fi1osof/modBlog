<?php 

$snippets = array();
    

$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_profile_info',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/modBlog_Profile/BLOG_profile_info.php'),
),'',true,true);
/*$snippet->setProperties(array(
    'blog_id'   => array(
        'name'  => 'user',
        'desc'  => '',
        'options'   => array(),
        'type'  => 'textfield',
        'value' => '',
        'lexic' => '',
        'area'  => '',
    )
));*/
$snippets[]  = $snippet;
unset($snippet);

$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_profile_topicsList',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/modBlog_Profile/BLOG_profile_topicsList.php'),
),'',true,true);
/*$snippet->setProperties(array(
    'blog_id'   => array(
        'name'  => 'user',
        'desc'  => '',
        'options'   => array(),
        'type'  => 'textfield',
        'value' => '',
        'lexic' => '',
        'area'  => '',
    )
));*/
$snippets[]  = $snippet;
unset($snippet);
 

return $snippets;

?>
