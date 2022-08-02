<?php

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API

 */
class xooblog_customize
{
    /**
     * This hooks into 'customize_register' (available as of WP 3.4) and allows
     * you to add new sections and controls to the Theme Customize screen.
     * 
     * Note: To enable instant preview, we have to actually write a bit of custom
     * javascript. See live_preview() for more.
     *  
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customize
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 
     */
    public static function register($wp_customize)
    {
        $wp_customize->add_section('xooblog_color_scheme', array(
            'title'    => __('xooblog Theme Options', 'xooblog'),
            'priority' => 35,
        ));


        //  =============================
        //  = Color Picker              =
        //  =============================

        //2. Register new settings to the WP database...
        $wp_customize->add_setting(
            'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
                'default'    => '#B2DF82', //Default setting/value to save
                'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );

        //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
        $wp_customize->add_control(new WP_Customize_Color_Control( //Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'xooblog_link_textcolor', //Set a unique ID for the control
            array(
                'label'      => __('Chnage Link Color', 'xooblog'), //Admin-visible name of the control
                'settings'   => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
                'priority'   => 9, //Determines the order this control appears in for the specified section
                'section'    => 'xooblog_color_scheme', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
        ));

        // Add setting
        $wp_customize->add_setting('footer_text_block', array(
            'default'           => __('Copyright © 2020 XooBlog', 'xooblog'),
            'sanitize_callback' => 'xooblog_sanitize_text'
        ));
        // Add control
        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'custom_footer_text',
            array(
                'label'    => __('Footer Text', 'xooblog'),
                'section'  => 'xooblog_color_scheme',
                'settings' => 'footer_text_block',
                'type'     => 'text'
            )
        ));


        // Sanitize text
        function xooblog_sanitize_text($text)
        {
            return sanitize_text_field($text);
        }
        //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
        $wp_customize->get_setting('blogname')->transport = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
        $wp_customize->get_setting('background_color')->transport = 'postMessage';
    }

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     * 
     * Used by hook: 'wp_head'
     * 
     * @see add_action('wp_head',$func)
     * @since xooblog 1.0
     */
    public static function header_output()
    {
?>
        <!--Customizer CSS-->
        <style type="text/css">
            /* <?php self::generate_css('a', 'color', 'header_textcolor', '#'); ?> */
            <?php self::generate_css('body,.post-category,input,button,.xooblog_search input[type=submit]', 'background-color', 'background_color', '#'); ?>
            <?php self::generate_css('a,.xooblog_footer ul li a,.xooblog_pagination_contaier ul li a,.xooblog_navbar .navbar-nav li a,.post-title h2,.xooblog_blog_widget .title-line', 'color', 'link_textcolor'); ?>
        </style>
        <!--/Customizer CSS-->
<?php
    }

    /**
     * This outputs the javascript needed to automate the live settings preview.
     * Also keep in mind that this function isn't necessary unless your settings 
     * are using 'transport'=>'postMessage' instead of the default 'transport'
     * => 'refresh'
     * 
     * Used by hook: 'customize_preview_init'
     * 
     * @see add_action('customize_preview_init',$func)
     * @since xooblog 1.0
     */
    public static function live_preview()
    {
        wp_enqueue_script(
            'xooblog-themecustomizer', // Give the script a unique ID
            get_template_directory_uri() . '/assets/js/customizer.js', // Define the path to the JS file
            array('jquery', 'customize-preview'), // Define dependencies
            '', // Define a version (optional) 
            true // Specify whether to put in footer (leave this true)
        );
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
  
     */
    public static function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true)
    {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if (!empty($mod)) {
            $return = sprintf(
                '%s { %s:%s; }',
                $selector,
                $style,
                $prefix . $mod . $postfix
            );
            if ($echo) {
                echo esc_attr($return);
            }
        }
        return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('xooblog_customize', 'register'));

// Output custom CSS to live site
add_action('wp_head', array('xooblog_customize', 'header_output'));

// Enqueue live preview javascript in Theme Customizer admin screen
add_action('customize_preview_init', array('xooblog_customize', 'live_preview'));
