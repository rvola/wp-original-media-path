# WP Original Media Path
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/rvola)

Change the location for the uploads folder for WordPress

## Description
WordPress has changed the media page, removing the two fields to define the location and the sub-field of media.
There exists a constant wp-config.php, but it does not include sub-domains.
Once activated, the plugin will add two values ​​in the database, you modify later.
The plugin is not retroactive for images already uploaded.
Follow the [installation instructions](#installation) to migrate your old images.

* **This extension is not compatible with WordPress multisite.**
* **Thank you to try to find the solution by yourself or on the forum.**
* **The author of the plugin is no after-sales service.**
* **Most of the issues have already been addressed.**

## Requirement

* PHP minimal: **5.3**
* WordPress minimal: **3.5**

## Installation
First of all, it is important to back up your website before using this extension. I can not be held liable if you lose content. Thank you.

Here is the installation. Normally, it’s pretty simple. Just enter the URL you want for your uploads directory. Be careful if you use a domain other than your domain, pointing your domains (DNS) to the desired folder.

For example, if I want to have `http://media.domain.com` as my URL for my uploads folder, I need to point DNS `media.domain.com` to the root of my WordPress site.
Another example: `http://other-domain.com/images`. I have to point my domain to the `images` folder on my WordPress server.

The easiest way to understand how the extension works and only use your current WordPress domain at first. By default, the URL of the uploads folder of WordPress is `http://domain.com/wp-content/uploads`. Try for example to put this in the field: `http://domain.com/media`, then send an image by the usual WordPress media page and normally by magic, WordPress will create the media folder at the root of your WordPress And upload your image to your server.

If your website is blank, you do not have anything else to do. If your site already has images for a while, read on.

Please note that the URL change is never retroactive. This means that if you change the URL of the media folder, the images called in your article, etc. will still call the old URL. Similarly, templates and extensions that use dynamic functions will call the new URL while the items in the uploads folder will still be in the old folder.

The easiest if you want to migrate the URL is to do it in **3 simple steps**:

#### Step 1
Change the field with the new URL.

#### Step 2
Move the contents of your old uploads folder to the location of the new URL. For example, my old folder URL is `http://domain.com/wp-content/uploads` and I now want the images to be `http://domain.com/media`; After changing the field in the options like this: `http://domain.com/media`, I move the contents of the `http://domain.com/wp-content/uploads` folder to the `http://domain.com/media`, so I allow dynamic functions to continue to find the media files in your new folder.

#### Step 3
Now we need to change, the old image calls `http://domain.com/wp-content/uploads/2016/05/test.jpg` for example that is in the content of WordPress articles. First you have to back up your database, because the operation can be damaging and I can not be held responsible. It is necessary to modify in SQL by a simple Search> Replace.
There are extensions on WordPress that do the job very well, I think, especially at [Search & Replace](https://wordpress.org/plugins/search-and-replace/).
Just search for `http://domain.com/wp-content/uploads` and replace it with `http://domain.com/media` which matches the field you entered in step 1.

Normally if you scrupulously follow these steps, you are able to be able to simply change the URL of your uploads folder.

Good continuation and think about adding a review.

## Frequently Asked Questions

#### The plugin does it work with a real CDN?
Unfortunately not. Because WordPress is able to handle the file uploads directly.
This plugin is only used to mount a mirror subdomains on Wordpress installation or change the location of file uploads.

#### I just set the plugin, but the images are not displayed
1. Check that the path is correct specify.
2. Check that the file was created on the server with the chmod 777 or 755.

#### My site is broken
1. Do not panic!
2. Refer to the help for configuring media fields.
3. You can always follow the uninstallation procedure if you want to reverse.

## Links

* [**Changelog**](https://github.com/rvola/wp-original-media-path/blob/master/CHANGELOG.md)
* [**Download on WordPress**](https://wordpress.org/plugins/wp-original-media-path/)

