<?php

/**
 * Description of index
 *
 * @author Fi1osof
 */
$root = dirname(__FILE__).'/';

$subcategory = $modx->newObject('modCategory', array(
    'category'  => 'modBlog_Blog',
));


/* add chunks */
$chunks = require_once "{$root}chunks/index.php";
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

/* add TemplateVars */
$tvs = include "{$root}tvs/index.php";
if (!is_array($tvs)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in templateVars.');
} else {
    $subcategory->addMany($tvs, 'TemplateVars');
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($tvs).' templateVars.');
}


$TemplateVars = array_merge($TemplateVars, $tvs);

unset($tvs);

return $subcategory;

?>
