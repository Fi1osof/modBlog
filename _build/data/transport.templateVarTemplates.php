<?php


$modTemplateVarTemplates = array();


$tt = $modx->newObject('modTemplateVarTemplate');
$tt->addOne($Templates['BLOG_Blog'], 'Template');
$tt->addOne($TemplateVars['BLOG_blogType'], 'TemplateVar');
$modTemplateVarTemplates[] = $tt;


$tt = $modx->newObject('modTemplateVarTemplate');
$tt->addOne($Templates['BLOG_Blog'], 'Template');
$tt->addOne($TemplateVars['BLOG_blogMinRating'], 'TemplateVar');
$modTemplateVarTemplates[] = $tt;


$tt = $modx->newObject('modTemplateVarTemplate');
$tt->addOne($Templates['BLOG_Blog'], 'Template');
$tt->addOne($TemplateVars['BLOG_avatar'], 'TemplateVar');
$modTemplateVarTemplates[] = $tt;



// return $modTemplateVarTemplates;