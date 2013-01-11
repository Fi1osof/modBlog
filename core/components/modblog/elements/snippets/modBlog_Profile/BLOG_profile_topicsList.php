<?php
if((!isset($user) && (!isset($modx->resource->user) || !$user = $modx->resource->user)) || !is_object($user)){
    return $modx->modblog->sendErrorPage();
}

$output = $modx->runSnippet('BLOG_topicsList', array(
    'user_id'   => $user->get('id'),
));

return $output;