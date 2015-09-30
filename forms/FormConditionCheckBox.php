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

class FormConditionCheckBox extends \FormCheckBox
{

	/**
	 * Template
	 *
	 * @var string
	 */
	protected $strTemplate = 'form_condition_checkbox';

	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		$strOptions = '';

		foreach ($this->arrOptions as $i=>$arrOption)
		{
			$strOptions .= sprintf('<span><input type="checkbox" name="%s" onclick="this.form.submit();" id="opt_%s" class="checkbox" value="%s"%s%s%s <label id="lbl_%s" for="opt_%s">%s</label></span> ',
					$this->strName,
					$this->strId.'_'.$i,
					$arrOption['value'],
					$this->isChecked($arrOption),
					$this->getAttributes(),
					$this->strTagEnding,
					$this->strId.'_'.$i,
					$this->strId.'_'.$i,
					$arrOption['label']);
		}

		if ($this->strLabel != '')
		{
			return sprintf('<fieldset id="ctrl_%s" class="checkbox_container%s"><legend>%s%s%s</legend>%s<input type="hidden" name="%s" value=""%s%s</fieldset>',
					$this->strId,
					(($this->strClass != '') ? ' ' . $this->strClass : ''),
					($this->required ? '<span class="invisible">'.$GLOBALS['TL_LANG']['MSC']['mandatory'].'</span> ' : ''),
					$this->strLabel,
					($this->required ? '<span class="mandatory">*</span>' : ''),
					$this->strError,
					$this->strName,
					$this->strTagEnding,
					$strOptions) . $this->addSubmit();
		}
		else
		{
			return sprintf('<fieldset id="ctrl_%s" class="checkbox_container%s">%s<input type="hidden" name="%s" value=""%s%s</fieldset>',
					$this->strId,
					(($this->strClass != '') ? ' ' . $this->strClass : ''),
					$this->strError,
					$this->strName,
					$this->strTagEnding,
					$strOptions) . $this->addSubmit();
		}
	}

}

