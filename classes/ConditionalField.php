<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2014 Heimrich & Hannot GmbH
 * @package conditionalfields
 * @author Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\ConditionalFields;

class ConditionalField extends \Frontend
{

	private static $changed;
	
	protected static $objInstance;

	/**
	 * Instantiate the conditional form object (Factory)
	 *
	 * @return \ConditionalForms The conditional form instance
	 *
	 */
	public static function getInstance()
	{
		if (static::$objInstance === null)
		{
			static::$objInstance = new static();
		}

		return static::$objInstance;
	}

	/**
	 * Prevent direct instantiation (Singleton)
	 */
	public function __construct() {}

	/**
	 * Prevent cloning of the object (Singleton)
	 */
	final public function __clone() {}


	public static function getConditions($arrForm, $selected=false)
	{
		$arrConditions = array();

		$arrColumns = array("pid=? AND type IN('condition_radio', 'condition_select')");

		$arrValues = array($arrForm['id']);
		
		$objConditions = \FormFieldModel::findBy($arrColumns, $arrValues);

		if($objConditions === null) return $arrConditions;

		while($objConditions->next())
		{
			$arrCond = deserialize($objConditions->options);

			foreach ($arrCond as $cond)
			{
				$arrConditions[$objConditions->label][$cond['value']] = $cond['label'];
			}
		}

		return $arrConditions;
	}

	public static function getSelectedConditions($arrForm)
	{
		$arrConditions = array();

		$arrColumns = array("pid=? AND type IN('condition_radio', 'condition_select')");

		$arrValues = array($arrForm['id']);
		
		$objConditions = \FormFieldModel::findBy($arrColumns, $arrValues);
		
		if($objConditions === null) return $arrConditions;

		while($objConditions->next())
		{
			$arrCond = deserialize($objConditions->options);

			$inputCond = \Input::post($objConditions->name);

			$lastValue = $_SESSION['FORM_DATA'][$objConditions->name];

			$submitted = \Input::post('FORM_SUBMIT') == $arrForm['Template']->formSubmit;

			
			if($inputCond && $submitted)
			{
				$arrConditions[$objConditions->name] = $inputCond;

				if($lastValue != $inputCond)
				{
					static::$changed = true;
					$_SESSION['FORM_DATA'][$objConditions->name] = $inputCond;
				}

				continue;
			}

			foreach ($arrCond as $cond)
			{
				if($cond['default'] == 1)
				{
					// store default value initially in session for self::$changed
					$_SESSION['FORM_DATA'][$objConditions->name] = $cond['value'];
					$arrConditions[$objConditions->name] = $cond['value'];
					break;
				}
			}
		}

		return $arrConditions;
	}
	
	
	public function validateFormFieldHook($objWidget, &$formId, $arrForm)
	{
		if(static::$changed)
		{
			// change the form id, processFormData wont be triggered
			$formId = $formId . '_changed';

			// restore mandotory fields & rgxp from default configuration
			$objDefault = \FormFieldModel::findByPk($objWidget->id);
			
			if($objDefault === null) return $objWidget;
			
			$objWidget->required = $objDefault->mandatory ? true : false;
			$objWidget->rgxp = $objDefault->rgxp;
			
			// validate the field
			$objWidget->validate();
		}
		
		return $objWidget;
	}
	
	public function loadFormFieldHook($objWidget, $formId, $arrForm)
	{
		$arrConditions = static::getSelectedConditions($arrForm);

		if($objWidget->cond && !in_array($objWidget->cond, $arrConditions))
		{
			$objWidget = new \FormHidden(array('name' => $objWidget->name, 'value' => ''));
			$objWidget->mandatory = false;
			$objWidget->rgxp = '';
			$objWidget->value = $_POST[$objWidget->name];
		}
		
		if(static::$changed)
		{
			// disable validation
			$objWidget->required = false;
			$objWidget->rgxp = '';
			$objWidget->value = $_POST[$objWidget->name];
		}

		return $objWidget;
	}
	
}

