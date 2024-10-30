<?php
    /*
    Plugin Name: Image Rating by GD Star Rating for Nextgen Gallery
    Description: Renders the GD Star Rating shortcode in a way suitable for the Nextgen Gallery.
    Version: 1.0
    Author: Aimbox
    Author URI: http://aimbox.com
    Depends: NextGEN Gallery, GD Star Rating
    */

    class NggGdsrImageRating
    {
        public $pluginTitle = 'NGG Image Rating';
        private static $instance;



        public static function instance()
        {
            if (!isset(self::$instance))
            {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function __construct()
        {
            add_action('admin_menu', array($this, 'registerAdminSettingsPage'));
            add_action('admin_init', array($this, 'registerAdminSettings'));

            add_filter('ngg_image_object', array($this, 'renderImageRatingShortcode'));
        }

        public function registerAdminSettingsPage()
        {
            add_options_page("{$this->pluginTitle} Options", $this->pluginTitle, 'manage_options', 'nextgen-gdstarrating-image-rating/admin-settings.php');
        }

        public function registerAdminSettings()
        {
            register_setting('ngggdsr_general_options', 'ngggdsr_option_shortcode');
        }

        public function renderImageRatingShortcode(nggImage $image)
        {
            $shortcode = get_option('ngggdsr_option_shortcode');

            if ($shortcode && get_query_var('pid'))
            {
                global $post;
                $postBackup = $post;

                $post = new stdClass();
                $post->ID = 100000000 + $image->pid;
                $post->post_author = '';
                $post->post_date = '';
                $post->post_date_gmt = '';
                $post = new WP_Post($post);

                $image->description .= '<br />' . do_shortcode($shortcode);

                $post = $postBackup;
            }

            return $image;
        }
    }

    NggGdsrImageRating::instance();
?>