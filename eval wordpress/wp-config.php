<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'formations_osonrel' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'formations.osonrel' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '6pKOkgA3hF2vadNNgvDK' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'nBP4`m. r9k&PJ*Cj#`Yq yo}j% 7mpCUs,Q.^E%8TX97p+m{r:!{>hB(],4l=3v' );
define( 'SECURE_AUTH_KEY',  'O,K*=, t,4sS@v/!tez4w5,>A.i!iDUe!.eO]a&=Or|(;pQ338df:@ra[iW?iS3u' );
define( 'LOGGED_IN_KEY',    'b-#`.>q@GEQWy.1I>Vb5`nkW.P{vat)`I,l^>8E1#D{`Nz-GX|$bEt0W%RzbzV;1' );
define( 'NONCE_KEY',        'ru4`e7UF7vRr(;R%yP*.M!4p+ HxLQlY[m^Ft`PDlGd3 Y|*4Y&dfQf rbi>|<-s' );
define( 'AUTH_SALT',        'YoyQ<:l]}?&,{Qg.c6d@I)Byw 2H1;hf7%H$SfNmQb)u1}IkR~q}M*IF{5w5ly.W' );
define( 'SECURE_AUTH_SALT', 'ifSpsde7HxO&~C*#LUX-HWEgz? ;Er/,Ee6]t%8&f;6yVOQ6~nML9]mF1#a#Kvz=' );
define( 'LOGGED_IN_SALT',   '>A!DMU`m( Hako$Uk?/m!RxhRGud9TyTTtPL/U6;Le:i~miA?93wg-QQ O>Mdfd8' );
define( 'NONCE_SALT',       '15D]*Ndf0D=+$d1A0K;=: W[a]hN7unZ5VphFq0VDEc^!8Z-8 BYK8bmv$~G9$:}' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
