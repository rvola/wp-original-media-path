=== WP Original Media Path ===
Contributors: rvola
Donate link: https://www.paypal.me/rvola
Tags: media, upload, path, subdomain
Requires PHP: 5.3
Requires at least: 3.5
Tested up to: 4.9
Stable tag: 2.3.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Change the location for the uploads folder for WordPress

== Description ==
WordPress has changed the media page, removing the two fields to define the location and the sub-field of media.
There exists a constant wp-config.php, but it does not include sub-domains.
Once activated, the plugin will add two values ​​in the database, you modify later.
The plugin is not retroactive for images already uploaded.
Follow the [installation instructions](https://wordpress.org/plugins/wp-original-media-path/installation) to migrate your old images.

* **This extension is not compatible with WordPress multisite.**
* **Thank you to try to find the solution by yourself or on the forum.**
* **The author of the plugin is no after-sales service.**
* **Most of the issues have already been addressed.**

[**GitHub**](https://github.com/rvola/wp-original-media-path) | [**Donate**](https://www.paypal.me/rvola)

== Installation ==
First of all, it is important to back up your website before using this extension. I can not be held liable if you lose content. Thank you.

Here is the installation. Normally, it’s pretty simple. Just enter the URL you want for your uploads directory. Be careful if you use a domain other than your domain, pointing your domains (DNS) to the desired folder.

For example, if I want to have `http://media.domain.com` as my URL for my uploads folder, I need to point DNS `media.domain.com` to the root of my WordPress site.
Another example: `http://other-domain.com/images`. I have to point my domain to the `images` folder on my WordPress server.

The easiest way to understand how the extension works and only use your current WordPress domain at first. By default, the URL of the uploads folder of WordPress is `http://domain.com/wp-content/uploads`. Try for example to put this in the field: `http://domain.com/media`, then send an image by the usual WordPress media page and normally by magic, WordPress will create the media folder at the root of your WordPress And upload your image to your server.

If your website is blank, you do not have anything else to do. If your site already has images for a while, read on.

Please note that the URL change is never retroactive. This means that if you change the URL of the media folder, the images called in your article, etc. will still call the old URL. Similarly, templates and extensions that use dynamic functions will call the new URL while the items in the uploads folder will still be in the old folder.

The easiest if you want to migrate the URL is to do it in 3 simple steps:

= Step 1 =
Change the field with the new URL.

= Step 2 =
Move the contents of your old uploads folder to the location of the new URL. For example, my old folder URL is `http://domain.com/wp-content/uploads` and I now want the images to be `http://domain.com/media`; After changing the field in the options like this: `http://domain.com/media`, I move the contents of the `http://domain.com/wp-content/uploads` folder to the `http://domain.com/media`, so I allow dynamic functions to continue to find the media files in your new folder.

= Step 3 =
Now we need to change, the old image calls `http://domain.com/wp-content/uploads/2016/05/test.jpg` for example that is in the content of WordPress articles. First you have to back up your database, because the operation can be damaging and I can not be held responsible. It is necessary to modify in SQL by a simple Search> Replace.
There are extensions on WordPress that do the job very well, I think, especially at [Search & Replace](https://wordpress.org/plugins/search-and-replace/).
Just search for `http://domain.com/wp-content/uploads` and replace it with `http://domain.com/media` which matches the field you entered in step 1.

Normally if you scrupulously follow these steps, you are able to be able to simply change the URL of your uploads folder.

Good continuation and think about adding a review.

== Frequently Asked Questions ==

= The plugin does it work with a real CDN? =
Unfortunately not. Because WordPress is able to handle the file uploads directly.
This plugin is only used to mount a mirror subdomains on Wordpress installation or change the location of file uploads.

= I just set the plugin, but the images are not displayed =
1. Check that the path is correct specify.
2. Check that the file was created on the server with the chmod 777 or 755.

= My site is broken =
1. Do not panic!
2. Refer to the help for configuring media fields.
3. You can always follow the uninstallation procedure if you want to reverse.

= I want to make suggestions =
We’re glad you want to help us improve the WP Original Media Path!
The GIT repository is available here [https://github.com/rvola/wp-original-media-path](https://github.com/rvola/wp-original-media-path)

== Changelog ==

= 2.3.0 | 2017-11-08 =
* NEW / possibility in "Expert" mode to modify the url scheme for the site

= 2.2.0 | 2017-10-31 =
* Minor spaces and clean
* Refactor activation methode with new setter
* Refactor method set value
* Refactor slug link admin options
* Refactor Pear conventions checkMultisite
* Refactor link plugin meta
* Rename method linkSidebar  > addMenu
* Rename method linkPluginPage  > pluginLinkPage
* Rename method loadTextDomain > loadLanguages
* Refactor Fields
* New namespace for class
* New requirement version (PHP, WP)
* Clean licence in php file
* REFACTOR / merge method assets (script, style)
* REFACTOR / change name singleton method
* Link page options printf()
* MOVE / page options in folder

= 2.1.1 | 2017-05-22 =
* MINOR / Explanatory text
* FIX / Load correctly gettext
* FIX / Link donate + I18n
* MINOR / changelog for Wordpress repository
* Bump version Wordpress Repository

= 2.1.0 | 2017-05-21 =
* NEW / Donate link
* MINOR / ajustement readme
* UPDATED / sanitize_url if empty field
* NEW / Expert mode with path custom
* UPDATED / function dynamic field render
* NEW / style in css file
* NEW / constante Version
* NEW / constante SLUG

= 2.0.0 | 2017-05-17 =
* MINOR / order button options
* NEW / Check multisite and kick out
* MINOR / Pear conventions
* MINOR / Add details for field
* NEW / Style for hide field in page media
* NEW / Sanitize field url
* UPDATED / activate() with new function `clean_slash`& `set_uploadPath`
* NEW / set_uploadPath
* NEW / clean_slash
* REMOVE / upload_path field

= 1.6.1 | 2016-08-01 =
* FIX / Install fields

= 1.6.0 | 2016-07-21 =
* NEW / Changelog GitHub
* UPDATED / readme GitHub
* MINOR / space
* MINOR / Update variable name
* UPDATED / i18n
* UPDATED / const NAME
* UPDATED / Pear conventions
* UPDATED / Activate function
* UPDATED / Class become final class
* MINOR / deleted comments
* NEW / Licence GPL V3
* Readme Markdown
* Update Readme

= 1.5.1 | 2015-11-19 =
* Check Wordpress 4.4
* Update readme
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
* Possibility to disable the plugin settings without deleting
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
