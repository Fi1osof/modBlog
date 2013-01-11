<?php

if((!isset($user) && (!isset($modx->resource->user) || !$user = $modx->resource->user)) || !is_object($user)){
    return $modx->modblog->sendErrorPage();
}

$output = '';

$profile = $user->getOne('Profile');

$output .= $profile->get('fullname');

return $output;