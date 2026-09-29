<?php namespace ProcessWire;

if(!class_exists('\\ProcessWire\\InputfieldTurnstile')) require_once(__DIR__ . '/InputfieldTurnstile.module');

class InputfieldTurnstileConfig extends ModuleConfig {

	public function __construct() {
		$children = array();
		foreach(InputfieldTurnstile::getSettings() as $name => $setting) {
			$children[] = array(
				'name' => $name,
				'label' => $setting['label'],
				'description' => $setting['description'],
				'type' => 'radios',
				'options' => $setting['options'],
				'value' => $setting['default'],
				'optionColumns' => 1,
			);
		}
		$this->add(array(
			// Config fields for defaults that can be overridden per field
			array(
				'type' => 'fieldset',
				'label' => $this->_('Default Field Settings'),
				'description' => $this->_('These settings will be used as defaults for new InputfieldTurnstile fields.'),
				'children' => $children,
			)
		));
	}
}
