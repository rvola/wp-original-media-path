=== WP Original Media Path ===
Contributors: rvola
Tags: media, upload, path, subdomain
Requires at least: 3.5
Tested up to: 4.4
Stable tag: 1.5.1
License: GPLv2 or later

Displays the fields to change the url and file upload

== Description ==
Wordpress has changed the media page, removing the two fields to define the location and the sub-field of media.
There exists a constant wp-config.php, but it does not include sub-domains.
Once activated, the plugin will add two values ​​in the database, you modify later.
The plugin is not retroactive for images already uploaded

**Thank you to try to find the solution by yourself or on the forum.**
**The author of the plug-in is no after-sales service.**
**Most of the issues have already been addressed.**

*end of support 2015-12-28*

= [i18n] =
* German by <a href="http://www.feuerwehrmuseum-sh.de" rel="nofollow" target="_blank">Dr. Hajo Brandenburg - Feuerwehrmuseum</a>

== Installation ==
* Activate the plugin
* Go to the option page of the plugin to complete the configuration
* Modify the desired values ​​'Store uploaded files in this folder' and 'full web address for the'.
* That's it!

== Frequently Asked Questions ==

= How to set my plugin? =
The first is your file uploads without the domain.
For example, if your upload folder is at the root of the site and it is called 'my-images' the first field must be filled 'my-images'

The second field is the full URL to the file uploads.
In the previous example, the field looks like this: 'http://www.siteweb.com/my-images'

= The plugin does it work with a real CDN? =
Unfortunately not. Because WordPress is able to handle the file uploads directly.
This plug-in is only used to mount a mirror subdomains on Wordpress installation or change the location of file uploads

= I just set the plug-in, but the images are not displayed =
1. Check that the path is correct specify
2. Check that the file was created on the server with the chmod 777 or 755
3. Visit this page : https://wordpress.org/support/topic/images-not-getting-uploaded-to-subdomain-or-anywhere

= My site is broken =
* Do not panic!
* Refer to the help for configuring media fields.
* You can always follow the uninstallation procedure if you want to reverse

= I want to make suggestions =
We're glad you want to help us improve the WP Original Media Path!
To help us, go directly into the form of http://wordpress.org/support/plugin/wp-original-media-path plugin and mail us your suggestions.

== Changelog ==

= 1.5.1 | 2015-11-19 =
* Check Wordpress 4.4
* Update readme

= 1.5.1 | 2015-10-14 =
* New File POT
* Github link

= 1.5.0 | 2015-08-28 =
* Settings API
* uninstall.php file
* recode

= 1.4.1 | 2014-09-22 =
* German Translation by <a href="http://www.feuerwehrmuseum-sh.de" rel="nofollow" target="_blank">Dr. Hajo Brandenburg - Feuerwehrmuseum</a>

= 1.4.0 | 2014-09-03 =
* Correct classname responsive
* Check compatibility WordPress 4.0
* Update readme
* Update assets Repository
* Update and clean files PO & MO

= 1.3.0 | 2013-07-18 =
* Page options
* Possibility to disable the plug-in settings without deleting
* Established translations
* Update Installation and FAQ

= 1.2.0 | 2013-05-01 =
* Bug link setting
* uninstalling the plugin with the deactivation
* Update FAQ

= 1.1.0 | 2013-03-29 =
* FAQ
* Auto fill fields

= 1.0.1. | 2013-01-06 =
* Contributors list
* Text fields

= 1.0.0. | 2012-12-28 =
* Launch Plugin