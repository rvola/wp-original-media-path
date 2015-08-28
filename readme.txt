=== WP Original Media Path ===
Contributors: rvola
Tags: media, upload, path, subdomain, 3.5, 3.6, 3.7, 3.8, 3.9, 4.0, 4.1, 4.2
Requires at least: 3.5
Tested up to: 4.2
Stable tag: 1.4.1
License: GPLv2 or later

Displays the fields to change the url and file upload

== Description ==
= [EN] =
The new version of Wordpress 4.2, 4.1, 4.0, 3.9, 3.8, 3.7, 3.6 and 3.5 has changed the media page, removing the two fields to define the location and the sub-field of media.
There exists a constant wp-config.php, but it does not include sub-domains.
This plug-in is designed for installations virgin WordPress.
Once activated, the plugin will add two values ​​in the database, you modify later.

= [FR] =
La nouvelle version de Wordpress 4.2 4.1, 4.0, 3.9, 3.8, 3.7, 3.6 et 3.5 a changé la page des médias, en supprimant les deux champs permettant de définir l'emplacement et le sous-champ des médias.
Il y existe une constante wp-config.php, mais elle ne prend pas en compte les sous-domaines.
Ce plug-in est conçu pour les installations vierges de WordPress.
Une fois activé, le plugin va ajouter deux valeurs dans la base de données, vous les modifierez par la suite.

= [i18n] =
* German by <a href="http://www.feuerwehrmuseum-sh.de" rel="nofollow" target="_blank">Dr. Hajo Brandenburg - Feuerwehrmuseum</a>

== Installation ==
= [EN] =
* Activate the plugin installed on a new Wordpress 4.2, 4.1, 4.0, 3.9, 3.8, 3.7, 3.6 or 3.5.
* Go to the option page of the plugin to complete the configuration
* Modify the desired values ​​'Store uploaded files in this folder' and 'full web address for the'.
* That's it!

= [FR] =
* Activer le plugin installé sur un nouveau Wordpress 4.2, 4.1, 4.0, 3.9, 3.8, 3.7, 3.6 ou 3.5.
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

= My site is broken =
* Do not panic!
* Refer to the help for configuring media fields.
* You can always follow the uninstallation procedure if you want to reverse

= How to completely uninstall the plugin? =
1. Go to the option page of the plugin.
2. Click Uninstall and follow the procedure.
3. You just have to disable the plugin

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

= Mon site est cassé =
* Ne paniquez pas!
* Reportez-vous à l'aide pour la configuration des champs médias.
* Vous pouvez toujours suivre la procédure de désinstallation si vous souhaitez revenir à l'origine

= Comment désinstaller complètement le plugin? =
1. Aller dans la page d’option du plugin.
2. Cliquez sur Désinstaller et suivez la procédure.
3. Vous n’avez plus qu’à désactiver le plugin


= Je souhaite apporter des suggestions =
Nous sommes heureux que vous souhaitiez nous aider à améliorer le WP Original Media Path !
Pour nous aider, rendez-vous directement dans le formulaire du plugin http://wordpress.org/support/plugin/wp-original-media-path et postez-nous vos suggestions.

== Changelog ==

= 1.4.1 | 22/09/2014 =
* German Translation by <a href="http://www.feuerwehrmuseum-sh.de" rel="nofollow" target="_blank">Dr. Hajo Brandenburg - Feuerwehrmuseum</a>

= 1.4.0 | 03/09/2014 =
* Correct classname responsive
* Check compatibility WordPress 4.0
* Update readme
* Update assets Repository
* Update and clean files PO & MO

= 1.3.0 | 18/07/2013 =
* Page options
* Possibility to disable the plug-in settings without deleting
* Established translations
* Update Installation and FAQ

= 1.2.0 | 01/05/2013 =
* Bug link setting
* uninstalling the plugin with the deactivation
* Update FAQ

= 1.1.0 | 29/03/2013 =
* FAQ
* Auto fill fields

= 1.0.1. | 06/01/2013 =
* Contributors list
* Text fields

= 1.0.0. | 28/12/2012 =
* Launch Plugin