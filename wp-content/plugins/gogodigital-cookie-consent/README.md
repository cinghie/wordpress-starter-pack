# Gogodigital Cookie Consent for Wordpress

Gogodigital Cookie Consent is a Wordpress Plugin to add Cookie Consent script to your Website: Cookie Consent is a wonderful script, allowing to show a warning for cookie policy. 

The original script is here: https://silktide.com/tools/cookie-consent/

As the script from silktide.com, also the plugin is very simple to use

## Copy folder with git from Terminal

Go to folder wp-content/plugins/

```
git clone https://github.com/cinghie/wordpress-gogo-cookieconsent.git gogodigital-cookie-consent
```

## Parameters

### theme

The theme you wish to use. Can be any of the themes from the select

    Dark => Bottom, Floating and Top
    Light => Bottom, Floating and Top

Default: ‘dark-bottom’

### message

The message shown by the plugin.
Default: ‘This website uses cookies to ensure you get the best experience on our website’

### dismiss

The text used on the dismiss button.
Default: ‘Got it!’

### learnMore

The text shown on the link to the cookie policy (requires the link option to also be set)
Default: ‘More info’

### link

The url of your cookie policy. If it’s set to null, the link is hidden.
Default: null
