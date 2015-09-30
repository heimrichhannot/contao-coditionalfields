<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package Conditionalfields
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'HeimrichHannot',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'HeimrichHannot\ConditionalFields\ConditionalField'         => 'system/modules/conditionalfields/classes/ConditionalField.php',

	// Forms
	'HeimrichHannot\ConditionalFields\FormConditionSelectMenu'  => 'system/modules/conditionalfields/forms/FormConditionSelectMenu.php',
	'HeimrichHannot\ConditionalFields\FormConditionCheckBox'    => 'system/modules/conditionalfields/forms/FormConditionCheckBox.php',
	'HeimrichHannot\ConditionalFields\FormConditionRadioButton' => 'system/modules/conditionalfields/forms/FormConditionRadioButton.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'form_condition_select'   => 'system/modules/conditionalfields/templates/forms',
	'form_condition_radio'    => 'system/modules/conditionalfields/templates/forms',
	'form_condition_checkbox' => 'system/modules/conditionalfields/templates/forms',
));
