<?php

/**
 * Description of index
 *
 * @author Fi1osof
 */
$root = dirname(__FILE__).'/';

$subcategory = $modx->newObject('modCategory', array(
    'category'  => 'modBlog_Profile',
));


/* add chunks */
/*$chunks = require_once "{$root}chunks/index.php";
if (!is_array($chunks)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in chunks.');
} else {
    $subcategory->addMany($chunks);
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($chunks).' chunks.');
}
unset($chunks);


/* add snippets */
$snippets = include "{$root}snippets/index.php";
 
if (!is_array($snippets)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in snippets.');
} else {
    $subcategory->addMany($snippets);
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($snippets).' snippets.');
}
unset($snippets);
 

/* add templates */
$templates  =  include "{$root}templates/index.php";
if (!is_array($templates)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in templates.');
} else {
    $Templates = array_merge($Templates, $templates);
    $subcategory->addMany($templates,  'Templates');
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($templates).' templates.'); 
}
unset($templates);

return $subcategory;

?>
