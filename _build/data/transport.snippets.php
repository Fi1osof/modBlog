<?php

$snippets = array();

$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'id' => 0,
    'name' => 'BLOG_Profile',
    'description' => '',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/BLOG_Profile.php'),
),'',true,true);
// $snippet->setProperties($properties);
$snippets[]  = $snippet;
unset($snippet);


return $snippets;