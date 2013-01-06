<?php

$mediaSources = array(); 

$params = array(
    "basePath" => array(
        "name" => "basePath",
        "desc" => "prop_file.basePath_desc",
        "type" => "textfield",
        "options" => Array(),
        "value" => "assets/components/modblog/uploads/",
        "lexicon" => "core:source",
    ),
    "baseUrl" => Array
    (
        "name" => "baseUrl",
        "desc" => "prop_file.baseUrl_desc",
        "type" => "textfield",
        "options" => Array(),
        "value" => "assets/components/modblog/uploads/",
        "lexicon" => "core:source",
    )
);
$mediaSource = $modx->newObject('sources.modMediaSource', array(
    'name' => 'BLOG_uploads',
    'class_key' => 'sources.modFileMediaSource',
    'description'   => '',
    'properties' => $params,
));
$mediaSource->set('id', 0);
$mediaSources['BLOG_uploads'] = $mediaSource;

