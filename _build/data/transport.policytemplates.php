<?php

$templates = array();

/* administrator template/policy */
$template = $modx->newObject('modAccessPolicyTemplate');
$template->fromArray(array(
    'name' => 'Blog Policy Template',
    'description' => 'Шаблон политик безопасности для компонента modBlog',
    'lexicon' => 'modblog:permissions',
    'template_group' => 1,
));
//  $template->set('id', 1);
$permissions = include dirname(__FILE__).'/permissions/modblog.policy.php';
if (is_array($permissions)) {
    $template->addMany($permissions);
} else { $modx->log(modX::LOG_LEVEL_ERROR,'Could not load Blog Policy Template.'); }

$perms = array(
    'add_children',
    'list',
    'moderate_blogs',
    'new_document_in_root',
    'publish_document',
    'save',
    'view',
);

$data = array();

foreach($perms as $k){
    $data = array(
        $k => true,
    );
}

/*
 * Add policies
 */
$policies = array();

// Admin
$policy = $modx->newObject('modAccessPolicy');
$policy->fromArray(array (
  'id' => 1,
  'name' => 'Blog Administrator',
  'description' => 'Политики доступов администраторов Блога',
  'parent' => 0,
  'class' => '',
  'lexicon' =>'modblog:permissions',
  'data' => $data,
), '', true, true);
$policies[] = $policy;


// Moderator
$policy = $modx->newObject('modAccessPolicy');
$policy->fromArray(array (
  'id' => 1,
  'name' => 'Blog Moderator',
  'description' => 'Политики доступов модераторов Блога',
  'parent' => 0,
  'class' => '',
  'lexicon' =>'modblog:permissions',
  'data' => $data,
), '', true, true);
$policies[] = $policy;


// Moderator
$policy = $modx->newObject('modAccessPolicy');
$policy->fromArray(array (
  'id' => 1,
  'name' => 'Blog Member',
  'description' => 'Политики доступов пользователей Блога',
  'parent' => 0,
  'class' => '',
  'lexicon' =>'modblog:permissions',
  'data' => $data,
), '', true, true);
$policies[] = $policy;


$template->addMany($policies, 'Policies');

$templates[] = $template;


return $templates;
