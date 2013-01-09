<?php

$tvs = array();

$tv = $modx->newObject('modTemplateVar', array(
    'name'      => 'BLOG_blogType',
    'caption'         => 'Тип блога',
    'type'      => 'listbox',
    'elements'  => 'Открытый==0||Закрытый==1',
    'default_text'  => '0',
    'input_properties'  => array(
        'allowBlank'    => true,
        'listWidth'     => '',
        'typeAhead'     => false,
        'typeAheadDelay'=> 250,
        'forceSelection'=> false,
        'listEmptyText' => '',
    ),
));
$tv->set('id', 0);
$tvs['BLOG_blogType'] = $tv;


$tv = $modx->newObject('modTemplateVar', array(
    'name'      => 'BLOG_blogMinRating',
    'caption'         => 'Минимальный рейтинг',
    'type'      => 'number',
    'default_text'  => '0',
    'input_properties'  => array(
        'allowBlank'    => true,
        'allowDecimals' => true,
        'allowNegative' => true,
        'decimalPrecision'  => 4,
        'decimalSeparator'  => '.',
        'maxValue'      => 0,
        'minValue'      => 0,
    ),
));
$tv->set('id', 0);
$tvs['BLOG_blogMinRating'] = $tv;

return $tvs;

?>
