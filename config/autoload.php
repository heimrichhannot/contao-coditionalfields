<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
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
	'HeimrichHannot\ConditionalFields\FormConditionRadioButton' => 'system/modules/conditionalfields/forms/FormConditionRadioButton.php',
	'HeimrichHannot\ConditionalFields\FormConditionSelectMenu'  => 'system/modules/conditionalfields/forms/FormConditionSelectMenu.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'form_condition' => 'system/modules/conditionalfields/templates',
));
