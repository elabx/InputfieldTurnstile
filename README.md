# InputfieldTurnstile

A ProcessWire module that adds a [Cloudflare Turnstile](https://www.cloudflare.com/products/turnstile/) input field to your forms, protecting them from bots without showing a CAPTCHA.

This module acts as a wrapper around [MarkupCloudflareTurnstile](https://github.com/nbcommunication/MarkupCloudflareTurnstile), which handles the core API integration.

## Features

- **Smart Protection**: Verifies visitors are real humans without requiring them to solve puzzles.
- **Configurable**: Supports different themes (Auto, Light, Dark) and sizes (Normal, Compact, Flexible).
- **Easy Integration**: Works like any other ProcessWire Inputfield.
- **Centralized Config**: Uses API keys from `MarkupCloudflareTurnstile`.

## Requirements

- ProcessWire >= 3.0
- [MarkupCloudflareTurnstile](https://github.com/nbcommunication/MarkupCloudflareTurnstile) module installed.
- A Cloudflare account with a Turnstile Site Key and Secret Key.

## Installation

1. Install **MarkupCloudflareTurnstile**:
   - Download from the [modules directory](https://modules.processwire.com/modules/markup-cloudflare-turnstile/) or GitHub.
   - Install and configure it with your **Site Key** and **Secret Key**.
2. Install **InputfieldTurnstile**:
   - Copy the `InputfieldTurnstile` directory to `site/modules/`.
   - Go to **Modules > Refresh** and click **Install**.

## Usage

### In Form Builder or Custom Forms

You can add this field to any ProcessWire form.

#### Via API

```php
$form = $modules->get("InputfieldForm");

// ... add other fields ...

// Add Turnstile field
$turnstile = $modules->get("InputfieldTurnstile");
$turnstile->name = "turnstile";
$turnstile->label = "Security Check";
// Optional: Override settings
// $turnstile->turnstileTheme = 'dark'; 
$form->add($turnstile);

// ... render and process form ...

if($input->post->submit) {
    $form->processInput($input->post);
    if(!$form->getErrors()) {
        // Form is valid and user is verified
    }
}
```

## License

This module is licensed under the same terms as ProcessWire.