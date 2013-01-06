<?php


$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tstart = $mtime;

ini_set('display_errors', 1);
print '<pre>';
require_once dirname(__FILE__). '/build.config.php';


$modx= new modX();


$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO'); echo '<pre>'; flush();

$modx->loadClass('transport.modPackageBuilder','',false, true);
$builder = new modPackageBuilder($modx);
$builder->createPackage(PKG_NAME_LOWER,PKG_VERSION,PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER,false,true,'{core_path}components/'.PKG_NAME_LOWER.'/');
$modx->getService('lexicon','modLexicon');
$modx->lexicon->load(PKG_NAME_LOWER.':properties');

/* load action/menu */
$attributes = array (
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::UNIQUE_KEY => 'text',
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Action' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => array ('namespace','controller'),
        ),
    ),
); 


/* add namespace */
$namespace = $modx->newObject('modNamespace');
$namespace->set('name', NAMESPACE_NAME);
$namespace->set('path',"{core_path}components/".PKG_NAME_LOWER."/");
$namespace->set('assets_path',"{assets_path}components/".PKG_NAME_LOWER."/");
$vehicle = $builder->createVehicle($namespace,array(
    xPDOTransport::UNIQUE_KEY => 'name',
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
));


$builder->putVehicle($vehicle);
$modx->log(modX::LOG_LEVEL_INFO,"Packaged in ".NAMESPACE_NAME." namespace."); flush();
unset($vehicle,$namespace);


/* load system settings */
$settings = include_once $sources['data'].'transport.settings.php';
$attributes= array(
    xPDOTransport::UNIQUE_KEY => 'key',
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => false,
);
if (!is_array($settings)) { $modx->log(modX::LOG_LEVEL_ERROR,'Adding settings failed.'); }
foreach ($settings as $setting) {
    $vehicle = $builder->createVehicle($setting,$attributes);
    $builder->putVehicle($vehicle);
}
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($settings).' system settings.'); flush();
unset($settings,$setting,$attributes);


/* package in default access roles */
$attributes = array (
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UNIQUE_KEY => array('name'),
    xPDOTransport::UPDATE_OBJECT => false,
);

$roles = include $sources['data'].'transport.roles.php';
if (!is_array($roles)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding roles failed.'); }
foreach ($roles as $role) {
    $vehicle = $builder->createVehicle($role,$attributes);
    $builder->putVehicle($vehicle);
}
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($roles).' Access Policies.'); flush();
unset($roles,$attributes);



/* package in default access policy template */
$attributes = array (
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UNIQUE_KEY => array('name'),
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Permissions' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => array ('template','name'),
        ),
        'Policies' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => array ('template','name'),
        ),
    )
);

$policytemplates = include dirname(__FILE__).'/data/transport.policytemplates.php';
if (is_array($policytemplates)) {
    foreach ($policytemplates as $template) {
        $vehicle = $builder->createVehicle($template,$attributes);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($policytemplates).' Access Policy Templates.'); flush();
} else {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in Access Policy Templates.');
}
unset ($attributes);

/* package in default access policy */
/*$attributes = array (
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UNIQUE_KEY => array('name'),
    xPDOTransport::UPDATE_OBJECT => false,
);
$policies = include $sources['data'].'transport.policies.php';
if (!is_array($policies)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding policies failed.'); }
foreach ($policies as $policy) {
    $vehicle = $builder->createVehicle($policy,$attributes);
    $builder->putVehicle($vehicle);
}
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($policies).' Access Policies.'); flush();
unset($policies,$policy,$attributes);


/* package in user groups */
$attributes = array (
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UNIQUE_KEY => array('name'),
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'modUserGroup' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => array ('name'),
        ),
    )
);
$groups = include $sources['data'].'transport.member_groups.php';
if (!is_array($groups)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding member groups failed.'); }
foreach ($groups as $group) {
    $vehicle = $builder->createVehicle($group,$attributes);
    $builder->putVehicle($vehicle);
}
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($groups).' member groups Policies.'); flush();
unset($groups,$group,$attributes);


/* load MediaSources */
include $sources['data'].'transport.mediasources.php';
/* load Templates */
include $sources['data'].'transport.templates.php';
/* load TemplateVars */
include $sources['data'].'transport.templateVars.php';


/* Create mediaSources */
if (!is_array($mediaSources)) { $modx->log(modX::LOG_LEVEL_ERROR,'Adding MediaSources failed.'); } 
else{
    $vehicleParams = array(
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UPDATE_OBJECT => false,
        xPDOTransport::UNIQUE_KEY => 'name',
    );

    foreach($mediaSources as & $mediaSource){
        $vehicle = $builder->createVehicle($mediaSource, $vehicleParams);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($mediaSources).' MediaSources.'); flush();
}


/* create category */
$category= $modx->newObject('modCategory');
$category->set('id',1);
$category->set('category',PKG_NAME);
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in category.'); flush();
  

/* create category vehicle */
$attr = array(
    xPDOTransport::UNIQUE_KEY => 'category',
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::ABORT_INSTALL_ON_VEHICLE_FAIL => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Snippets' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
        'Chunks' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
        'Plugins' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
        'PluginEvents' => array(
            xPDOTransport::PRESERVE_KEYS => true,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => array('pluginid','event'),
        ),
        'Templates' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => 'templatename',
        ),
        'TemplateVars' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
            xPDOTransport::RELATED_OBJECTS => true,
            xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
                'Source' => array(
                    xPDOTransport::PRESERVE_KEYS => false,
                    xPDOTransport::UPDATE_OBJECT => false,
                    xPDOTransport::UNIQUE_KEY => 'name',
                ),
            ),
        ),
    )
);


/* add plugins */
$plugins = include $sources['data'].'transport.plugins.php';
if (!is_array($plugins)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding plugins failed.'); } 
else{
    $category->addMany($plugins);
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($plugins).' plugins.'); flush();
}

unset($plugins,$plugin);


/* add snippets */
$snippets = include $sources['data'].'transport.snippets.php';
if (!is_array($snippets)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in snippets.');
} else {
    $category->addMany($snippets);
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($snippets).' snippets.');
}
unset($snippets);

/* add chunks */
$chunks = include $sources['data'].'transport.chunks.php';
if (!is_array($chunks)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in chunks.');
} else {
    $category->addMany($chunks);
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($chunks).' chunks.');
}
unset($chunks);

/* add templates */

if (!is_array($Templates)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in templates.');
} else {
    $category->addMany($Templates,  'Templates');
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($Templates).' templates.');
}

/* add TemplateVars */

if (!is_array($TemplateVars)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in templateVars.');
} else {
    $category->addMany($TemplateVars, 'TemplateVars');
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($TemplateVars).' templateVars.');
}


/* Package in Category*/
$vehicle = $builder->createVehicle($category,$attr);


/* Resolvers */

$vehicle->resolve('file',array(
    'source' => $sources['source_core'],
    'target' => "return MODX_CORE_PATH . 'components/';",
));
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in CorePath'); flush();

$vehicle->resolve('file',array(
    'source' => $sources['source_assets'],
    'target' => "return MODX_ASSETS_PATH . 'components/';",
));
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in AssetsPath'); flush();

$vehicle->resolve('file',array(
    'source' => $sources['source_manager'],
    'target' => "return MODX_MANAGER_PATH . 'components/';",
));
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in ManagerPath'); flush();


$vehicle->resolve('php',array(
    'source' => $sources['resolvers'] . 'setupoptions.resolver.php',
));


$vehicle->resolve('php',array(
    'source' => $sources['resolvers'] . 'resolve.uninstall.php',
));

$modx->log(modX::LOG_LEVEL_INFO,'Packaged in resolvers.'); 
flush();
$builder->putVehicle($vehicle);

$modx->log(modX::LOG_LEVEL_INFO,'Putted  Category Vehicle');


$attributes = array(
    xPDOTransport::UNIQUE_KEY => array('tmplvarid','templateid'),
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::ABORT_INSTALL_ON_VEHICLE_FAIL => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'TemplateVar' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
        'Template' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => 'templatename',
        ),
    )
);

/* add templates */
include $sources['data'].'transport.templateVarTemplates.php';
if (!is_array($modTemplateVarTemplates)) {
    $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in modTemplateVarTemplates.');
} else {
    //$category->addMany($modTemplateVarTemplates);
    foreach($modTemplateVarTemplates as $tt){
        $vehicle = $builder->createVehicle($tt,$attributes);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($modTemplateVarTemplates).' modTemplateVarTemplates.');
}
unset($attributes, $modTemplateVarTemplates, $vehicle,  $tt);


/* now pack in the license file, readme and setup options */
$builder->setPackageAttributes(array(
    'license' => file_get_contents($sources['docs'] . 'license.txt'),
    'readme' => file_get_contents($sources['docs'] . 'readme.txt'),
    'changelog' => file_get_contents($sources['docs'] . 'changelog.txt'),
    'setup-options' => array(
        'source' => $sources['build'].'setup.options.php',
    ), 
));
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in package attributes.'); flush();

$modx->log(modX::LOG_LEVEL_INFO,'Packing...'); flush();
$builder->pack();

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);

$modx->log(modX::LOG_LEVEL_INFO,"\n<br />Package Built.<br />\nExecution time: {$totalTime}\n");

exit ();

?>
