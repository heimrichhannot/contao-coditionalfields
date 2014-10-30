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

class FormConditionSelectMenu extends \FormSelectMenu
{

	/**
	 * Template
	 *
	 * @var string
	 */
	protected $strTemplate = 'form_condition_select';


	/**
	 * Generate the widget and return it as string
	 *
	 * @return string The widget markup
	 */
	public function generate()
	{
		$strOptions = '';
		$blnHasGroups = false;

		if ($this->multiple)
		{
			$this->strName .= '[]';
		}

		// Make sure there are no multiple options in single mode
		elseif (is_array($this->varValue))
		{
			$this->varValue = $this->varValue[0];
		}

		// Add empty option (XHTML) if there are none
		if (empty($this->arrOptions))
		{
			$this->arrOptions = array(array('value'=>'', 'label'=>'-'));
		}

		foreach ($this->arrOptions as $arrOption)
		{
			if ($arrOption['group'])
			{
				if ($blnHasGroups)
				{
					$strOptions .= '</optgroup>';
				}

				$strOptions .= sprintf('<optgroup label="%s">',
										specialchars($arrOption['label']));

				$blnHasGroups = true;
				continue;
			}

			$strOptions .= sprintf('<option value="%s"%s>%s</option>',
									$arrOption['value'],
									$this->isSelected($arrOption),
									$arrOption['label']);
		}

		if ($blnHasGroups)
		{
			$strOptions .= '</optgroup>';
		}

		return sprintf('<select onchange="this.form.submit();" name="%s" id="ctrl_%s" class="%s"%s>%s</select>',
						$this->strName,
						$this->strId,
						$this->class,
						$this->getAttributes(),
						$strOptions) . $this->addSubmit();
	}

}

