<?php

/**
 * Plugin Name: WP Gogo Essentials
 * Plugin URI: https://github.com/cinghie/wordpress-gogo-bootstrap
 * Description: Manage Essentials settings on your Wordpress site
 * Author: Gogodigital S.r.l.s.
 * Version: 1.1.0
 * Author URI: http://www.gogodigital.it
 **/

class EssentialsSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    private $google_fonts;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        add_options_page(
            'Essentials Settings Admin',
            'WP Essentials',
            'manage_options',
            'essentials-settings',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        $this->options = get_option( 'essentials_options' );
        ?>
        <div class="wrap">
            <div style="border-right: 1px solid #ddd; float: left; padding-right: 2%;  width: 50%">
                <h1>WP Gogo Essentials Settings</h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields( 'framework_group' );
                    do_settings_sections( 'template-settings' );
                    submit_button();
                    ?>
                </form>
            </div>
            <div style="float: left; margin-left: 2%; width: 40%">
                <h3 style="margin-top: 2em;">Donate $5, $10 or $20</h3>
                <p>If you like this plugin, consider supporting us donating the time to develop it.</p>
                <div>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="TNGRD94CRZLVU">
                        <input type="image" src="https://www.paypalobjects.com/en_US/IT/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>
                <p>Some other ways to support this plugin</p>
                <ul>
                    <li><a href="http://wordpress.org/support/view/plugin-reviews/wp-gogo-essentials?rate=5#postform" target="_blank">Leave a ????? review on WordPress.org</a></li>
                    <li><a href="https://twitter.com/intent/tweet/?text=I+am+using+Wordpress+%22WP+GoGo+Essentials%22+plugin+to+manage+essentials+setings+on+my+WordPress+site.&amp" target="_blank">Tweet about this plugin</a></li>
                    <li><a href="http://wordpress.org/plugins/wp-gogo-essentials/#compatibility" target="_blank">Vote "works" on the WordPress.org plugin page</a></li>
                </ul>
                <h3>Looking for support?</h3>
                <p>Please use the <a href="#">plugin support forums</a> on WordPress.org.</p>
                <h3>Who are Us?</h3>
                <p><a href="http://www.gogodigital.it" target="_blank" title="Gogodigital Srls">Gogodigital Srls</a> is a young and innovative Web Agency that deals with Professional Web Sites for Companies and Persons, Responsive Web Sites, CMS Sites and Ecommerce Portals, Applications for Apple devices like iPhone, iPad, iPod, Applications for all Android devices like Samsung Smartphone and Pads, SEO Optimization, Web Marketing, Email Marketing and Social Media Marketing.</p>
                <h3 style="border-top: 1px solid #ddd; padding-top: 12px">Widget Settings</h3>
                <p>Remember to add manually the Widget Code on your Wordpress Theme</p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    if ( is_active_sidebar( 'footer-copyright' ) ) { dynamic_sidebar( 'footer-copyright' ); }
                </p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    if ( is_active_sidebar( 'social-icons' ) ) { dynamic_sidebar( 'social-icons' ); }
                </p>
                <p class="description" id="tagline-description" style="background-color: #fcf8e3; border-color: #faebcc; border-radius: 4px; color: #8a6d3b; padding: 10px">
                    <a href="https://github.com/cinghie/wordpress-gogo-essentials/blob/master/docs/footer_top_position.md" target="_blank">Footer Top Example</a>
                </p>
                <div style="clear: both"></div>
            </div>
            <div style="clear: both"></div>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'framework_group', // Option group
            'essentials_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'template_settings_id', // ID
            'Template Settings', // Title
            array( $this, 'print_framework_info' ), // Callback
            'template-settings' // Page
        );

        add_settings_field(
            'bootstrap',
            'Load Bootstrap',
            array( $this, 'bootstrap_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_field(
            'fontawesome',
            'Load Fontawesome',
            array( $this, 'fontawesome_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_field(
            'jqueryui',
            'Load jQuery UI',
            array( $this, 'jqueryui_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_field(
            'jquerymobile',
            'Load jQuery Mobile',
            array( $this, 'jquerymobile_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_field(
            'googlefonts',
            'Load Google Fonts',
            array( $this, 'googlefonts_callback' ),
            'template-settings',
            'template_settings_id'
        );

        add_settings_section(
            'widget_settings_id', // ID
            'Widget Settings', // Title
            array( $this, 'print_widget_info' ), // Callback
            'template-settings' // Page
        );

        add_settings_field(
            'widgetcopyright',
            'Copyright Widget Position',
            array( $this, 'widgetcopyright_callback' ),
            'template-settings',
            'widget_settings_id'
        );

        add_settings_field(
            'widgetcopyrighttop',
            'Copyright Top Widget Position',
            array( $this, 'widgetcopyrighttop_callback' ),
            'template-settings',
            'widget_settings_id'
        );

        add_settings_field(
            'widgetsocialicons',
            'Social Icons Widget Position',
            array( $this, 'widgetsocialicons_callback' ),
            'template-settings',
            'widget_settings_id'
        );
    }

    /**
     * Sanitize each setting field as needed
     * @param array $input Contains all settings fields as array keys
     * @return array
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['bootstrap'] ) )
            $new_input['bootstrap'] = sanitize_text_field( $input['bootstrap'] );

        if( isset( $input['fontawesome'] ) )
            $new_input['fontawesome'] = sanitize_text_field( $input['fontawesome'] );

        if( isset( $input['jqueryui'] ) )
            $new_input['jqueryui'] = sanitize_text_field( $input['jqueryui'] );

        if( isset( $input['jquerymobile'] ) )
            $new_input['jquerymobile'] = sanitize_text_field( $input['jquerymobile'] );

        if( isset( $input['googlefonts'] ) )
            $new_input['googlefonts'] = sanitize_text_field( $input['googlefonts'] );

        if( isset( $input['widgetcopyright'] ) )
            $new_input['widgetcopyright'] = sanitize_text_field( $input['widgetcopyright'] );

        if( isset( $input['widgetcopyrighttop'] ) )
            $new_input['widgetcopyrighttop'] = sanitize_text_field( $input['widgetcopyrighttop'] );

        if( isset( $input['widgetsocialicons'] ) )
            $new_input['widgetsocialicons'] = sanitize_text_field( $input['widgetsocialicons'] );

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_framework_info()
    {
        print 'Select which <strong>Framework</strong> do you wanna load on your Wordpress Theme';
    }

    /**
     * Print the Section text
     */
    public function print_widget_info()
    {
        print 'Select which <strong>Widget Position</strong> do you wanna register on your Wordpress Theme Widget';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function bootstrap_callback()
    {
        $select  = '<select id="bootstrap" name="essentials_options[bootstrap]" aria-describedby="timezone-description">';

        if($this->options['bootstrap'] == "not-load") {
            $select .= '<option value="not-load" selected="selected">Not Load Bootstrap</option>';
        } else {
            $select .= '<option value="not-load">Not Load Bootstrap</option>';
        }

        if($this->options['bootstrap'] == "load-local") {
            $select .= '<option value="load-local" selected="selected">Load Bootstrap Local</option>';
        } else {
            $select .= '<option value="load-local">Load Bootstrap Local</option>';
        }

        if($this->options['bootstrap'] == "load-cdn") {
            $select .= '<option value="load-cdn" selected="selected">Load Bootstrap CDN</option>';
        } else {
            $select .= '<option value="load-cdn">Load Bootstrap CDN</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['bootstrap'] ) ? esc_attr( $this->options['bootstrap']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function fontawesome_callback()
    {
        $select  = '<select id="fontawesome" name="essentials_options[fontawesome]" aria-describedby="timezone-description">';

        if($this->options['fontawesome'] == "not-load") {
            $select .= '<option value="not-load" selected="selected">Not Load Fontawesome</option>';
        } else {
            $select .= '<option value="not-load">Not Load</option>';
        }

        if($this->options['fontawesome'] == "load-local") {
            $select .= '<option value="load-local" selected="selected">Load Fontawesome Local</option>';
        } else {
            $select .= '<option value="load-local">Load Bootstrap Local</option>';
        }

        if($this->options['fontawesome'] == "load-cdn") {
            $select .= '<option value="load-cdn" selected="selected">Load Fontawesome CDN</option>';
        } else {
            $select .= '<option value="load-cdn">Load Bootstrap CDN</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['fontawesome'] ) ? esc_attr( $this->options['fontawesome']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function jquerymobile_callback()
    {
        $select  = '<select id="jquerymobile" name="essentials_options[jquerymobile]" aria-describedby="timezone-description">';

        if($this->options['jquerymobile'] == "not-load") {
            $select .= '<option value="not-load" selected="selected">Not Load jQuery Mobile</option>';
        } else {
            $select .= '<option value="not-load">Not Load jQuery Mobile</option>';
        }

        if($this->options['jquerymobile'] == "load-local") {
            $select .= '<option value="load-local" selected="selected">Load jQuery Mobile Local</option>';
        } else {
            $select .= '<option value="load-local">Load jQuery Mobile Local</option>';
        }

        if($this->options['jquerymobile'] == "load-cdn") {
            $select .= '<option value="load-cdn" selected="selected">Load jQuery Mobile CDN</option>';
        } else {
            $select .= '<option value="load-cdn">Load jQuery Mobile CDN</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['jquerymobile'] ) ? esc_attr( $this->options['jquerymobile']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function jqueryui_callback()
    {
        $select  = '<select id="jqueryui" name="essentials_options[jqueryui]" aria-describedby="timezone-description">';

        if($this->options['jqueryui'] == "not-load") {
            $select .= '<option value="not-load" selected="selected">Not Load jQuery UI</option>';
        } else {
            $select .= '<option value="not-load">Not Load jQuery UI</option>';
        }

        if($this->options['jqueryui'] == "load-local") {
            $select .= '<option value="load-local" selected="selected">Load jQuery UI Local</option>';
        } else {
            $select .= '<option value="load-local">Load jQuery UI Local</option>';
        }

        if($this->options['jqueryui'] == "load-cdn") {
            $select .= '<option value="load-cdn" selected="selected">Load jQuery UI CDN</option>';
        } else {
            $select .= '<option value="load-cdn">Load jQuery UI CDN</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['jqueryui'] ) ? esc_attr( $this->options['jqueryui']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function googlefonts_callback()
    {
        printf(
            '<input type="text" class="widefat" id="googlefonts" name="essentials_options[googlefonts]" value="%s" />
             <p class="description" id="tagline-description">Comma separated Fonts like "Open Sans,Roboto"</p>',
            isset( $this->options['googlefonts'] ) ? esc_attr( $this->options['googlefonts']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function widgetcopyright_callback()
    {
        $select  = '<select id="widgetcopyright" name="essentials_options[widgetcopyright]" aria-describedby="widget-copyright">';

        if($this->options['widgetcopyright'] == "not-active") {
            $select .= '<option value="not-active" selected="selected">Not Active</option>';
        } else {
            $select .= '<option value="not-active">Not Active</option>';
        }

        if($this->options['widgetcopyright'] == "active") {
            $select .= '<option value="active" selected="selected">Active</option>';
        } else {
            $select .= '<option value="active">Active</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['widgetcopyright'] ) ? esc_attr( $this->options['widgetcopyright']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function widgetcopyrighttop_callback()
    {
        $select  = '<select id="widgetcopyrighttop" name="essentials_options[widgetcopyrighttop]" aria-describedby="widget-copyright-top">';

        if($this->options['widgetcopyrighttop'] == "not-active") {
            $select .= '<option value="not-active" selected="selected">Not Active</option>';
        } else {
            $select .= '<option value="not-active">Not Active</option>';
        }

        if($this->options['widgetcopyrighttop'] == "active") {
            $select .= '<option value="active" selected="selected">Active</option>';
        } else {
            $select .= '<option value="active">Active</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['widgetcopyrighttop'] ) ? esc_attr( $this->options['widgetcopyrighttop']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function widgetsocialicons_callback()
    {
        $select  = '<select id="widgetsocialicons" name="essentials_options[widgetsocialicons]" aria-describedby="widget-social-icons">';

        if($this->options['widgetsocialicons'] == "not-active") {
            $select .= '<option value="not-active" selected="selected">Not Active</option>';
        } else {
            $select .= '<option value="not-active">Not Active</option>';
        }

        if($this->options['widgetsocialicons'] == "active") {
            $select .= '<option value="active" selected="selected">Active</option>';
        } else {
            $select .= '<option value="active">Active</option>';
        }

        $select .= '</select>';

        printf(
            $select,
            isset( $this->options['widgetsocialicons'] ) ? esc_attr( $this->options['widgetsocialicons']) : ''
        );
    }
}

/*
 * Create WP Gogo Essentials Page
 */
if( is_admin() )  {
    $my_settings_page = new EssentialsSettingsPage();
}

/*
 * Implementing Params
 */

$essentials_options = get_option('essentials_options');

$googlefonts = str_replace(array(" ",","), array("+","|"), $essentials_options['googlefonts']);
$googlefonts = "https://fonts.googleapis.com/css?family=".$googlefonts;

// Load Bootstrap
if( isset( $essentials_options['bootstrap'] ) ) {
    if ($essentials_options["bootstrap"] === "load-local") {
        add_action('wp_enqueue_scripts', 'theme_add_bootstrap');
    } elseif($essentials_options["bootstrap"] === "load-cdn") {
        add_action('wp_enqueue_scripts', 'theme_add_bootstrap_cdn');
    }
}

// Load Fontawesome
if( isset( $essentials_options['fontawesome'] ) ) {
    if ($essentials_options["fontawesome"] === "load-local") {
        add_action('wp_enqueue_scripts', 'theme_add_fontawesome');
    } elseif($essentials_options["fontawesome"] === "load-cdn") {
        add_action('wp_enqueue_scripts', 'theme_add_fontawesome_cdn');
    }
}

// Load jQuery UI
if( isset( $essentials_options['jqueryui'] ) ) {
    if ($essentials_options["jqueryui"] === "load-local") {
        add_action('wp_enqueue_scripts', 'theme_add_jqueryui');
    } elseif($essentials_options["jqueryui"] === "load-cdn") {
        add_action('wp_enqueue_scripts', 'theme_add_jqueryui_cdn');
    }
}

// Load jQuery Mobile
if( isset( $essentials_options['jquerymobile'] ) ) {
    if ($essentials_options["jquerymobile"] === "load-local") {
        add_action('wp_enqueue_scripts', 'theme_add_jquerymobile');
    } elseif($essentials_options["jquerymobile"] === "load-cdn") {
        add_action('wp_enqueue_scripts', 'theme_add_jquerymobile_cdn');
    }
}

// Load Google Fonts
if( isset( $essentials_options['googlefonts'] ) ) {
    if ($essentials_options['googlefonts'] != "" ) {
        add_action('wp_enqueue_scripts', 'theme_add_googlefonts');
    }
}

// Load Copyright Widget Position
if( isset( $essentials_options['widgetcopyright'] ) ) {
    if ($essentials_options["widgetcopyright"] === "active") {
        add_action( 'widgets_init', 'footer_copyright_widgets_init' );
    }
}

// Load Copyright Top Widget Position
if( isset( $essentials_options['widgetcopyrighttop'] ) ) {
    if ($essentials_options["widgetcopyrighttop"] === "active") {
        add_action( 'widgets_init', 'footer_copyright_top1_widgets_init' );
        add_action( 'widgets_init', 'footer_copyright_top2_widgets_init' );
        add_action( 'widgets_init', 'footer_copyright_top3_widgets_init' );
        add_action( 'widgets_init', 'footer_copyright_top4_widgets_init' );
    }
}

// Load Social Icons Widget Position
if( isset( $essentials_options['widgetsocialicons'] ) ) {
    if ($essentials_options["widgetsocialicons"] === "active") {
        add_action( 'widgets_init', 'socialicons_widgets_init' );
    }
}

/**
 * Adding Bootstrap css and js
 */
function theme_add_jquerymobile()
{
    wp_enqueue_style( 'jquerymobile', wp_gogo_essentials_get_plugin_url() . '/css/jquery.mobile-1.4.5.min.css', array(), '1.4.5', 'all');
    wp_enqueue_script( 'jquerymobile', wp_gogo_essentials_get_plugin_url(). '/js/jquery.mobile-1.4.5.min.js', array(), '1.4.5', true );
}

/**
 * Adding Bootstrap css and js from CDN
 */
function theme_add_jquerymobile_cdn()
{
    wp_enqueue_style( 'jquerymobile', 'https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css', array(), '1.4.5', 'all');
    wp_enqueue_script( 'jquerymobile', 'https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js', array(), '1.4.5', true );
}

/**
 * Adding jQuery UI css and js
 */
function theme_add_jqueryui()
{
    wp_enqueue_style( 'jqueryui', wp_gogo_essentials_get_plugin_url() . '/css/jquery-ui.min.css', array(), '1.12.1', 'all');
    wp_enqueue_script( 'jqueryui', wp_gogo_essentials_get_plugin_url(). '/js/jquery-ui.min.js', array(), '1.12.1', true );
}

/**
 * Adding jQuery UI css and js from CDN
 */
function theme_add_jqueryui_cdn()
{
    wp_enqueue_style( 'jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css', array(), '1.12.1', 'all');
    wp_enqueue_script( 'jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array(), '1.12.1', true );
}

/**
 * Adding Bootstrap css and js
 */
function theme_add_bootstrap()
{
    wp_enqueue_style( 'bootstrap', wp_gogo_essentials_get_plugin_url() . '/css/bootstrap.min.css', array(), '3.3.7', 'all');
    wp_enqueue_script( 'bootstrap', wp_gogo_essentials_get_plugin_url(). '/js/bootstrap.min.js', array(), '3.3.7', true );
}

/**
 * Adding Bootstrap css and js from CDN
 */
function theme_add_bootstrap_cdn()
{
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all');
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '3.3.7', true );
}

/**
 * Adding Fontawesome css and js
 */
function theme_add_googlefonts()
{
    global $googlefonts;
    wp_enqueue_style( 'googlefonts', $googlefonts, false);
}


/**
 * Adding Fontawesome css and js
 */
function theme_add_fontawesome()
{
    wp_enqueue_style( 'fontawesome', wp_gogo_essentials_get_plugin_url() . '/css/font-awesome.min.css', array(), '4.7.0', 'all');
}

/**
 * Adding Fontawesome css and js from CDN
 */
function theme_add_fontawesome_cdn()
{
    wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all');
}

/*
 * Adding Copyright Widget Position
 */
function footer_copyright_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright',
        'id'            => 'footer-copyright',
        'before_widget' => '<div class="widget-copyright">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
}

/*
 * Adding Copyright Top1 Widget Position
 */
function footer_copyright_top1_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright Top1',
        'id'            => 'footer-copyright-top1',
        'before_widget' => '<div class="widget-copyright-top1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rounded">',
        'after_title'   => '</h3>',
    ) );
}

/*
 * Adding Copyright Top2 Widget Position
 */
function footer_copyright_top2_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright Top2',
        'id'            => 'footer-copyright-top2',
        'before_widget' => '<div class="widget-copyright-top2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rounded">',
        'after_title'   => '</h3>',
    ) );
}

/*
 * Adding Copyright Top3 Widget Position
 */
function footer_copyright_top3_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright Top3',
        'id'            => 'footer-copyright-top3',
        'before_widget' => '<div class="widget-copyright-top3">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rounded">',
        'after_title'   => '</h3>',
    ) );
}

/*
 * Adding Copyright Top4 Widget Position
 */
function footer_copyright_top4_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Footer Copyright Top4',
        'id'            => 'footer-copyright-top4',
        'before_widget' => '<div class="widget-copyright-top4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rounded">',
        'after_title'   => '</h3>',
    ) );
}

/*
 * Adding Social Icons Widget Position
 */
function socialicons_widgets_init()
{
    register_sidebar( array(
        'name'          => 'Social Icons',
        'id'            => 'social-icons',
        'before_widget' => '<div class="widget-social-icons">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
}

/**
 * Get Plugin URL
 * @return string
 */
function wp_gogo_essentials_get_plugin_url()
{
    if ( !function_exists('plugins_url') )
        return get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));
    return plugins_url(plugin_basename(dirname(__FILE__)));
}
