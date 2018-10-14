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
git clone -b woocommerce https://github.com/cinghie/wordpress-starter-pack.git wooocommerce
```

## 2) Download and insert Wordpress last version in the some folder:

https://it.wordpress.org/

## 3) Edit wordpress.sql, replacing:

```
"http://localhost/wooocommerce" with your site url
```

## 4) Import wordpress.sql to your database and login with:

username: admin  
password: password

## 5) Copy wp-config-sample.php as wp-config.php  

Set database connection params

## 6) What to do:

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
 
## 7) All plugins used:

 - Advanced Custom Fields + ACF Yoast Plugin  
 - Autoptimize  
 - BJ Lazy Load  
 - Coming Soon Page & Maintenance Mode by SeedProd 
 - Contact Form 7   
 - Custom Facebook Feed 
 - Custom Twitter Feeds
 - FancyBox for WordPress  
 - Gogodigital Cookie Consent  
 - Gogodigital Essentials  
 - Google Analytics for WordPress by MonsterInsights  
 - Gutenberg  
 - Health Check & Troubleshooting  
 - Instagram Feed  
 - Jetpack by WordPress.com  
 - MailChimp per Wordpress  
 - MetaSlider  
 - Post Types Order  
 - Redirection  
 - Really Simple SSL  
 - Regenerate Thumbnails  
 - Shapely Companion  
 - Social Media and Share Icons (Ultimate Social Media)  
 - Smush  
 - TinyMCE Advanced
 - UpdraftPlus - Backup/Restore  
 - Wordfence Security  
 - WordPress Importer  
 - WordPress Popular Posts  
 - WP Instagram Widget  
 - WP Mail Logging  
 - WP Optimize  
 - WP Pagenavi  
 - WP Super Cache  
 - WPS Hide Login  
 - Yoast SEO  
