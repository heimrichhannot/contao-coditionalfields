<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2014 Heimrich & Hannot GmbH
 * @package conditionalfields
 * @author Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


/**
 * Frontend form fields
 */
$GLOBALS['TL_FFL']['condition_radio'] = 'HeimrichHannot\ConditionalFields\FormConditionRadioButton';
$GLOBALS['TL_FFL']['condition_select'] = 'HeimrichHannot\ConditionalFields\FormConditionSelectMenu';

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['loadFormField'][] = array('HeimrichHannot\ConditionalFields\ConditionalField', 'loadFormFieldHook');
$GLOBALS['TL_HOOKS']['validateFormField'][] = array('HeimrichHannot\ConditionalFields\ConditionalField', 'validateFormFieldHook');

/**
 * EFG
 */
$GLOBALS['EFG']['storable_fields'][] = 'condition_radio';
$GLOBALS['EFG']['storable_fields'][] = 'condition_select';