<?php

$GLOBALS['TL_DCA']['tl_page']['fields']['llmsTitle'] = [
    'inputType' => 'text',
    'eval' => [
        'maxlength' => 255,
        'decodeEntities' => true,
        'preserveTags' => true,
        'tl_class' => 'w50',
        'mandatory' => true,
    ],
    'sql' => "varchar(255) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_page']['fields']['llmsDescription'] = [
    'inputType' => 'textarea',
    'eval' => [
        'decodeEntities' => true,
        'preserveTags' => true,
        'tl_class' => 'clr',
    ],
    'sql' => "text NULL",
];

$GLOBALS['TL_DCA']['tl_page']['palettes']['llms'] = '{title_legend},title,type;{routing_legend},alias,routePath,routePriority,routeConflicts;{meta_legend},llmsTitle,llmsDescription;{cache_legend:hide},includeCache;{chmod_legend:hide},includeChmod;{expert_legend:hide},sitemap,hide;{publish_legend},published,start,stop';
$GLOBALS['TL_DCA']['tl_page']['config']['ctable'][] = 'tl_content';
