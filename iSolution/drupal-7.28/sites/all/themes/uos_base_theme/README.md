# UoS Base Theme
This is the base theme for Drupal 7 for the University of Southampton.
It is based on Omega 4 and follows the practises that will be applied in Drupal 8.
It's a responsive layout based on [Sass](http://sass-lang.com/), [Compass](http://compass-style.org/) and [Susy 1.09](http://susy.oddbird.net/).

## Usage
1. Download first the [Omega 4 theme](https://drupal.org/project/omega), and extract it in /sites/all/themes/
2. Then [download](https://gitlab.com/uos-drupal/uos-base-theme/repository/archive.zip?ref=master) and extract the UoS Base Theme in /sites/all/themes/uos_base_theme (you must have permissions to GitLab repository)
3. The downloaded file contains a folder with the name uos_base_theme.git, you must rename the folder from *uos_base_theme.git ->  uos_base_theme* (if you are using git, just clone it)

The final file structure must look like:
    /sites/all/themes
    /sites/all/themes/omega
    /sites/all/themes/omega/ohm
    /sites/all/themes/omega/omega
    /sites/all/themes/uos_base_theme

## Development
Always write your styles in scss and then compile them is css.

For more info about how to develop a front end stack for Omega and Sass read: [link](https://drupal.org/node/1936970), [link](https://drupal.org/node/2052955), [link](https://drupal.org/node/2204227), [link](https://drupal.org/node/2138087)
