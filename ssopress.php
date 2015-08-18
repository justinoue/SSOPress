<?php if(!defined('ABSPATH')) die(); ?>
<?php
  /*
    Plugin Name: SSO Press
    Plugin URI: https://github.com/justinoue/SSOPress
    Description: Easy Single Sign-on for Wordpress. Adds a Single Sign-on menu option to the settings menu <a href="/wp-admin/options-general.php?page=ssopress"> here</a>.
    Version: 0.1
    Author: Justin Ouellette
    Author URI: http://jouellette.com
  */
  if(!class_exists('SSOPress')){
    require('requires.php');

    class SSOPress{
      public static $secret = 'Rz0xu-vlHbN29JHSgSm0jc2PMQEkOwc31pdhk2YOGS1zo1oYVnXWQNbl2IvRKXGd';
      public static $options_var = 'ssopress';
      public static $flash_messages_var = 'ssopress_flash_messages';

      public function __construct(){
        $this->activation_hooks();
        $this->hooks();
      }
      public function hooks(){
        add_action('init', [new \SSOPress\Core\URLRewriter, 'init']);
        add_action('parse_query', [new \SSOPress\Core\Router, 'init']);
        add_action('admin_menu', [new \SSOPress\Controllers\AdminController, 'init']);
      }

      public function activation_hooks(){
        register_activation_hook(__FILE__, [$this, 'activate'], 0);
        register_deactivation_hook(__FILE__, [$this, 'deactivate'], 0);
      }
      public function activate(){
        if(get_option(self::$options_var)){
          delete_option(self::$options_var);
        }
        add_option(self::$options_var, \SSOPress\Core\Config::$defaults, '', 'yes');
        flush_rewrite_rules();
      }
      public function deactivate(){
        delete_option(self::$options_var);
        flush_rewrite_rules();
      }
    }
  }
  if(class_exists('SSOPress')){
    $ssopress = new SSOPress();
  }