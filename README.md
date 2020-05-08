# Wordpress Starter Pack
Wordpress Starter Pack is a ready-to-use Wordpress site with:

- Shapely Theme: https://colorlib.com/wp/themes/shapely
- Shapely Theme Child, just created with style.css and functions.php
- WP Bootstrap Starter: https://wordpress.org/themes/wp-bootstrap-starter/
- WP Bootstrap Starter Child, just created with style.css and functions.php
- Aqua Resizer in Child Theme: https://github.com/syamilmj/Aqua-Resizer

# Install

## 1) Copy folder with git from Terminal

```
git clone https://github.com/cinghie/wordpress-starter-pack.git wordpress
```

## 2) Download and insert Wordpress last version in the some folder:

https://it.wordpress.org/

## 3) Edit wordpress.sql, replacing:

```
"http://localhost/wordpress" with your site url
```

## 4) Import wordpress.sql to your database and login with:

username: admin  
password: password

## 5) Copy wp-config-sample.php as wp-config.php  

Set database connection params and add define debug:

```
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true );
define('WP_DEBUG_DISPLAY', false);
```

## 6) What to do

 - On Permalink Settings regenerate permalink  
 - Create new user and delete the old one with username "admin"  
 - On General Settings set Site Title  
 - On Reading Settings remove flag from "Discourage search engines to index this site"  
 - Generate and set Akismet Anti-Spam https://akismet.com/  
 - Activate and set Google Analytics for WordPress  
 - Activate and set Yoast SEO 
 - Activate and set Wordfence Security  
 - Activate and set WP Super Cache
 - Activate and set WPS Hide Login
 - Disallow file editing adding to wp-config.php
 ```
 define('DISALLOW_FILE_EDIT', true);
 ```
 - Secure folder wp-admin with .htaccess and .htpasswd (http://www.htaccesstools.com/articles/password-protection)
 - Edit Prevent Hot Linking and Prevent Spam Bot mysite.com in .htaccess
 - Remove unused plugins for update security   
 
## 7) If you want use another theme 

 - Generate a child theme and select it as your theme:  https://childtheme-generator.com/create-child-theme  

 - Add to child theme last version of Acqua Resizer  https://github.com/syamilmj/Aqua-Resizer  
 
 - Add to function.php this code  
 
 ```
require_once 'aq_resizer.php';

function hide_wordpress_version() {
	return '';
}
 ```
 
## 8) All plugins used

 - Advanced Custom Fields + ACF Yoast Plugin  
 - Akismet Anti-Spam  
 - All-in-One WP Migration  
 - Autoptimize  
 - BJ Lazy Load  
 - Classic Editor  
 - Coming Soon Page & Maintenance Mode by SeedProd 
 - Contact Form 7   
 - Custom Facebook Feed  
 - Custom Twitter Feeds  
 - Disable Comments  
 - Disable REST API  
 - FancyBox for WordPress  
 - Gogodigital Cookie Consent  
 - Google Analytics for WordPress by MonsterInsights  
 - Gutenberg  
 - Health Check & Troubleshooting  
 - Instagram Feed  
 - Jetpack by WordPress.com  
 - MetaSlider  
 - Post Types Order  
 - Redirection  
 - Regenerate Thumbnails  
 - Shapely Companion  
 - Smush  
 - Social Media and Share Icons (Ultimate Social Media)  
 - TinyMCE Advanced  
 - Widget Importer & Exporter  
 - Wordfence Security  
 - WordPress Popular Posts  
 - WP Instagram Widget  
 - WP Mail Logging  
 - WP Optimize  
 - WP Pagenavi  
 - WP Super Cache  
 - WPS Hide Login  
 - Yoast SEO  