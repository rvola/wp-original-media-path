=== WP Original Media Path ===
Contributors: rvola, NicoR
Tags: media, upload, path, subdomain, 3.5
Requires at least: 3.5
Tested up to: 3.6-beta2
Stable tag: 1.2.0
License: GPLv2 or later

Displays the fields to change the url and file upload

== Description ==
= [UK] =
The new version of Wordpress 3.5 has changed the media page, removing the two fields to define the location and the sub-field of media.
There exists a constant wp-config.php, but it does not include sub-domains.
This plug-in is designed for installations virgin WordPress.
Once activated, the plugin will add two values ​​in the database, you modify later.

= [FR] =
La nouvelle version de Wordpress 3.5 a changé la page des médias, en supprimant les deux champs permettant de définir l'emplacement et le sous-champ des médias.
Il y existe une constante wp-config.php, mais elle ne prend pas en compte les sous-domaines.
Ce plug-in est conçu pour les installations vierges de WordPress.
Une fois activé, le plugin va ajouter deux valeurs dans la base de données, vous les modifierez par la suite.

== Installation ==
= [UK] =
* Activate the plugins installed on a new Wordpress 3.5.
* Go to the page: "Media Settings"
* Change the desired values ​​'Store uploaded files in this folder' and 'full web address for the'.
* It is finished!

= [FR] =
* Activer le plugins installé sur un nouveau Wordpress 3.5.
* Rendez-vous à la page : "Réglages des médias"
* Modifiez les valeurs souhaitées 'Stocker les fichiers envoyés dans ce dossier' et 'Adresse web complète pour les fichiers'.
* C'est fini!

== Frequently Asked Questions ==

= How to set my plugin? = 
The first is your file uploads without the domain.
For example, if your upload folder is at the root of the site and it is called 'my-images' the first field must be filled 'my-images'

The second field is the full URL to the file uploads.
In the previous example, the field looks like this: 'http://www.siteweb.com/my-images'

= How to completely uninstall the plugin? =
1. Disable the plugin

= What will happen if I disable the plugin? =
If you disable the plugin, WP Original Media Path resets the settings of your images (path and URL) empty.
Your old settings WP Original Media Path will be deleted.

= My site is broken =
* Do not panic!
* Refer to the help for configuring media fields.
* You can always follow the uninstallation procedure if you want to reverse

=########################=

= Comment configurer mon plugin ? =
Le premier correspond à votre dossier d'uploads sans le domaine.
Par exemple si votre dossier d'upload se trouve à la racine du site et qu'il se nomme 'mes-images' le premier champ dois être remplis 'mes-images'

Le deuxième champ représente l'URL complète vers le dossier d'uploads.
Dans l'exemple précédent, le champ ressemble à ceci : 'http://www.siteweb.com/mes-images'

= Comment désinstaller complètement le plugin? =
1. Désactiver le plugin

= Que se passe-t-il si je désactive le plug-in ? =
Si vous désactivez le plugin, WP Original Media Path remettra les réglages de vos images (chemin du répertoire et URL) vides.
Vos anciens paramètres de WP Original Media Path seront donc supprimés.

= Mon site est cassé =
* Ne paniquez pas!
* Reportez-vous à l'aide pour la configuration des champs médias.
* Vous pouvez toujours suivre la procédure de désinstallation si vous souhaitez revenir à l'origine

== Changelog ==

= 1.2.0 =
* Bug link setting
* uninstalling the plugin with the deactivation
* Update FAQ

= 1.1.0 =
* FAQ
* Auto fill fields

= 1.0.1. =
* Contributors list
* Text fields

= 1.0.0. =
* Launch Plugin