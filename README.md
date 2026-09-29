# InputfieldTurnstile

A ProcessWire module that adds a [Cloudflare Turnstile](https://www.cloudflare.com/products/turnstile/) input field to your forms, protecting them from bots without showing a CAPTCHA.

This module acts as a wrapper around [MarkupCloudflareTurnstile](https://github.com/nbcommunication/MarkupCloudflareTurnstile), which handles the core API integration.

## Features

- **Smart Protection**: Verifies visitors are real humans without requiring them to solve puzzles.
- **Configurable**: Supports different themes (Auto, Light, Dark) and sizes (Normal, Compact, Flexible).
- **Invisible until needed**: Optionally show the widget only when Cloudflare needs the visitor to interact.
- **Easy Integration**: Works like any other ProcessWire Inputfield.
- **Centralized Config**: Uses API keys from `MarkupCloudflareTurnstile`.

## Requirements

- ProcessWire >= 3.0
- [MarkupCloudflareTurnstile](https://github.com/nbcommunication/MarkupCloudflareTurnstile) module installed.
- A Cloudflare account with a Turnstile Site Key and Secret Key.

## Installation

1. Install **MarkupCloudflareTurnstile**:
   - Download from the [modules directory](https://modules.processwire.com/modules/markup-cloudflare-turnstile/) or GitHub (it is not on Packagist).
   - Install and configure it with your **Site Key** and **Secret Key**.
2. Install **InputfieldTurnstile** with one of these methods:
   - **Composer** (from your ProcessWire root). The package is not on Packagist yet, so add the GitHub repository first, then require it:
     ```bash
     composer config repositories.inputfield-turnstile vcs https://github.com/elabx/InputfieldTurnstile
     composer require elabx/inputfield-turnstile
     ```
     [processwire-composer-installer](https://github.com/wireframe-framework/processwire-composer-installer) puts the module in `site/modules/InputfieldTurnstile`. Composer does not install MarkupCloudflareTurnstile (step 1).
   - **Manually**: copy the `InputfieldTurnstile` directory to `site/modules/`.
3. Go to **Modules > Refresh** and click **Install**.

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
// $turnstile->turnstileAppearance = 'interaction-only';
$form->add($turnstile);

// ... render and process form ...

if($input->post->submit) {
    $form->processInput($input->post);
    if(!$form->getErrors()) {
        // Form is valid and user is verified
    }
}
```

## Appearance

Each field has an **Appearance** option:

- *Use module default*: follow the Appearance set in the module config.
- *Always visible*
- *Only when interaction is needed*: renders
  `data-appearance="interaction-only"`, so the widget stays hidden unless
  Cloudflare needs the visitor to interact.

Both visible modes use the same site key and secret key. Use a Managed widget
in Cloudflare; this setting does not switch the widget to Invisible mode.

A field that was saved with *Always visible* or *Only when interaction is
needed* keeps that choice when the module default changes. Switch it to *Use
module default* to make it follow the module config.

Via API: `$turnstile->turnstileAppearance = 'interaction-only';`

## Per-field keys

By default the field uses the keys from MarkupCloudflareTurnstile. To use a
different Turnstile widget for one field, set both of its keys via API:

```php
$turnstile->turnstileSiteKey = '...';
$turnstile->turnstileSecretKey = '...';
```

## Missing keys

Until both a site key and a secret key are configured, the field shows nothing
to visitors and skips validation, even when the field is required. This lets
you add it to forms before a site's Cloudflare keys are entered.

While keys are missing the form is **not protected**. Superusers see a notice
in place of the widget, and each submission accepted without verification is
recorded in the `turnstile` log (Setup > Logs).

## License

This module is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
