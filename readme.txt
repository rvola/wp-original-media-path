=== WP Original Media Path ===
Contributors: rvola
Tags: media, upload, path, subdomain
Requires at least: 3.5
Tested up to: 4.4
Stable tag: 1.5.1
License: GPLv2 or later

Displays the fields to change the url and file upload

== Description ==
= [EN] =
Wordpress has changed the media page, removing the two fields to define the location and the sub-field of media.
There exists a constant wp-config.php, but it does not include sub-domains.
Once activated, the plugin will add two values ​​in the database, you modify later.
The plugin is not retroactive for images already uploaded

**Thank you to try to find the solution by yourself or on the forum.**
**The author of the plug-in is no after-sales service.**
**Most of the issues have already been addressed.**

*end of support 2015-12-28*

= [FR] =
Wordpress a changé la page des médias, en supprimant les deux champs permettant de définir l'emplacement et le sous-champ des médias.
Il y existe une constante wp-config.php, mais elle ne prend pas en compte les sous-domaines.
Une fois activé, le plugin va ajouter deux valeurs dans la base de données, vous les modifierez par la suite.
Le plug-in n'est pas rétroactif pour les images déjà uploadées.

**Merci d'essayer de trouver la solution par vous-même ou sur le forum.**
**L’auteur du plug-in ne fait pas de SAV.**
**La plupart des questions ont déjà été abordées.**

*fin du support 28/12/2015*

= [i18n] =
* German by <a href="http://www.feuerwehrmuseum-sh.de" rel="nofollow" target="_blank">Dr. Hajo Brandenburg - Feuerwehrmuseum</a>

== Installation ==
= [EN] =
* Activate the plugin
* Go to the option page of the plugin to complete the configuration
* Modify the desired values ​​'Store uploaded files in this folder' and 'full web address for the'.
* That's it!

= [FR] =
* Activer le plugin
* Rendez-vous à la page option du plugin pour terminer la configuration
* Modifiez les valeurs souhaitées 'Stocker les fichiers envoyés dans ce dossier' et 'Adresse web complète pour les fichiers'.
* C'est fini!

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

=########################=

= Comment configurer mon plugin ? =
Le premier correspond à votre dossier d'uploads sans le domaine.
Par exemple si votre dossier d'upload se trouve à la racine du site et qu'il se nomme 'mes-images' le premier champ dois être remplis 'mes-images'

Le deuxième champ représente l'URL complète vers le dossier d'uploads.
Dans l'exemple précédent, le champ ressemble à ceci : 'http://www.siteweb.com/mes-images'

= Le plugin fonctionne-t-il avec un vrai CDN ? =
Non malheureusement. Car WordPress doit pouvoir gérer le dossier d’uploads directement.
Ce plug-in sert uniquement à monter un miroir de sous-domaines sur l’installation de Wordpress ou à modifier l’emplacement du dossier uploads

= Je viens de régler le plug-in, mais les images ne s’affichent pas =
1. Verifier que le chemin specifier est correct
2. Vérifier que le dossier a été créé sur le serveur avec le chmod 777 ou 755
3. Consultez cette page : https://wordpress.org/support/topic/images-not-getting-uploaded-to-subdomain-or-anywhere

= Mon site est cassé =
* Ne paniquez pas!
* Reportez-vous à l'aide pour la configuration des champs médias.
* Vous pouvez toujours suivre la procédure de désinstallation si vous souhaitez revenir à l'origine

= Je souhaite apporter des suggestions =
Nous sommes heureux que vous souhaitiez nous aider à améliorer le WP Original Media Path !
Pour nous aider, rendez-vous directement dans le formulaire du plugin http://wordpress.org/support/plugin/wp-original-media-path et postez-nous vos suggestions.

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