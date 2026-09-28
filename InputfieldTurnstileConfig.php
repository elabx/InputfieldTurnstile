<?php namespace ProcessWire;

class InputfieldTurnstileConfig extends ModuleConfig {

	public function __construct() {
		$this->add(array(
			// Config fields for defaults that can be overridden per field
			array(
				'type' => 'fieldset',
				'label' => $this->_('Default Field Settings'),
				'description' => $this->_('These settings will be used as defaults for new InputfieldTurnstile fields.'),
				'children' => array(
					array(
						'name' => 'turnstileAppearance',
						'label' => $this->_('Appearance'),
						'description' => $this->_('With a Managed widget, show it always or only when visitor interaction is needed. Both options use the same API keys.'),
						'type' => 'radios',
						'options' => array(
							'always' => $this->_('Always visible'),
							'interaction-only' => $this->_('Only when interaction is needed'),
						),
						'value' => 'always',
						'optionColumns' => 1,
					),
					array(
						'name' => 'turnstileTheme',
						'label' => $this->_('Theme'),
						'type' => 'radios',
						'options' => array(
							'auto' => $this->_('Auto'),
							'light' => $this->_('Light'),
							'dark' => $this->_('Dark'),
						),
						'value' => 'auto',
						'optionColumns' => 1,
					),
					array(
						'name' => 'turnstileSize',
						'label' => $this->_('Size'),
						'type' => 'radios',
						'options' => array(
							'normal' => $this->_('Normal'),
							'compact' => $this->_('Compact'),
							'flexible' => $this->_('Flexible'),
						),
						'value' => 'normal',
						'optionColumns' => 1,
					)
				)
			)
		));
	}
}
