<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['llms_blockquote'] = '{type_legend},type,llmsHeadline;{text_legend},llmsText;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['llms_codeblock'] = '{type_legend},type,llmsHeadline;{text_legend},highlight,code;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['llms_hr'] = '{type_legend},type;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['llms_image'] = '{type_legend},type,llmsHeadline;{image_legend},singleSRC,overwriteMeta;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['llms_linklist'] = '{type_legend},type,llmsHeadline;{content_legend},llmsLinklist;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['llms_list'] = '{type_legend},type,llmsHeadline;{text_legend},listitems;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['llms_paragraph'] = '{type_legend},type,llmsHeadline;{text_legend},llmsText;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['llmsHeadline'] = [
	'inputType' => 'text',
	'eval' => ['maxlength' => 255, 'tl_class' => 'w50 clr'],
	'sql' => "varchar(255) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['llmsText'] = [
	'inputType' => 'textarea',
	'eval' => ['tl_class' => 'clr'],
	'sql' => 'text NULL',
];
$GLOBALS['TL_DCA']['tl_content']['fields']['llmsLinklist'] = [
	'inputType' => 'group',
	'palette' => ['linkTitle', 'linkURL', 'linkDetails'],
	'fields' => [
		'linkTitle' => [
			'inputType' => 'text',
			'eval' => [
                'decodeEntities' => true,
				'tl_class' => 'w50 clr',
			],
		],
		'linkURL' => [
			'inputType' => 'text',
			'eval' => [
				'rgxp' => 'url',
				'decodeEntities' => true,
				'maxlength' => 2048,
				'dcaPicker' => true,
				'tl_class' => 'w50',
			],
		],
		'linkDetails' => [
			'inputType' => 'text',
			'eval' => [
                'decodeEntities' => true,
				'tl_class' => 'clr',
			],
		],
	],
	'sql' => 'blob NULL',
];
