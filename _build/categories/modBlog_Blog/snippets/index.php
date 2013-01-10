<?php 

$snippets = array();
   
$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_blog_add',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/modBlog_Blog/BLOG_blog_add.php'),
),'',true,true);
// $snippet->setProperties($properties);
$snippets[]  = $snippet;
unset($snippet);


$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_blogsList',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/modBlog_Blog/BLOG_blogsList.php'),
),'',true,true);
// $snippet->setProperties($properties);
$snippets[]  = $snippet;
unset($snippet);



$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_Widget_blogList',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/modBlog_Blog/BLOG_Widget_blogList.php'),
),'',true,true);
$snippet->setProperties(array(
    'outerTpl'  => 'BLOG_Widget_blogList_OuterTpl',
    'rowTpl'    => 'BLOG_Widget_blogList_RowTpl',
));
$snippets[]  = $snippet;
unset($snippet);
 

return $snippets;

?>
