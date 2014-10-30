<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2014 Heimrich & Hannot GmbH
 * @package conditionalfields
 * @author Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


$dc = &$GLOBALS['TL_DCA']['tl_form_field'];

/**
 * Palettes
 */
$dc['palettes']['condition_radio'] = '{type_legend},type,name,label;{fconfig_legend},mandatory;{options_legend},options;{expert_legend:hide},class;{template_legend:hide},customTpl;{submit_legend},addSubmit';
$dc['palettes']['condition_select'] = '{type_legend},type,name,label;{fconfig_legend},mandatory;{options_legend},options;{expert_legend:hide},class;{template_legend:hide},customTpl;{submit_legend},addSubmit';

/**
 * Fields
 */
$dc['fields']['value']['eval']['decodeEntities'] = true;


foreach($dc['palettes'] as $name => $palette)
{
	if(in_array($name, array('__selector__', 'condition_radio', 'condition_select'))) continue;
	
	$dc['palettes'][$name] .= ';{condition_legend},cond';
}

// condition is occupied by mysql, contao does not escape column names --> condition name = cond
$dc['fields']['cond'] = array(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['cond'],
		'exclude'                 => true,
		'inputType'               => 'select',
		'options_callback'        => array('tl_form_field_condition', 'getConditions'),
		'eval'					  => array('includeBlankOption' => true),
		'sql'                     => "varchar(255) NOT NULL default ''"
);

class tl_form_field_condition extends Backend
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getConditions(DataContainer $dc)
	{
		$objForm = \FormModel::findByPk($dc->activeRecord->pid);

		if($objForm === null) return array();

		return HeimrichHannot\ConditionalFields\ConditionalField::getConditions($objForm->row());
	}



}
