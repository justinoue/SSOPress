<?php
  namespace SSOPress\Controllers;
  if(!defined('ABSPATH')) die();

  class AdminController extends ApplicationController{
    function admin_menu(){
      //pages
      add_options_page('Single Sign-on', 'Single Sign-on', 'manage_options', 'ssopress', [$this, 'options_page']);

      //save hooks
      add_action('admin_action_sso_press', [$this, 'save_options']);
    }

    function options_page(){
      include(plugin_dir_path(__FILE__).'../views/admin.php');
    }

    function save_options(){
      if(wp_verify_nonce($_POST['_wpnonce'], 'ssopress')){
        $new_options = [
          'remote_login_url'   => empty($_POST['remote_login_url']) ? \SSOPress\Core\Config::$defaults['remote_login_url'] : $_POST['remote_login_url'],
          'remote_logout_url'  => empty($_POST['remote_logout_url']) ? \SSOPress\Core\Config::$defaults['remote_logout_url'] : $_POST['remote_logout_url'],
          'secret_token'       => empty($_POST['secret_token']) ? \SSOPress\Core\Config::$defaults['secret_token'] : $_POST['secret_token'],
          'sso_required'       => isset($_POST['sso_required']) ? true : false,
          'provision_users'    => isset($_POST['provision_users']) ? true : false,
          'scramble_passwords' => isset($_POST['scramble_passwords']) ? true : false
        ];
        $this->update_options($new_options);
        $this->flash('updated', 'Changes successfully saved!');
      }
      else{
        $this->flash('error', 'An error has occured while saving your options. Please try again.');
      }
      wp_redirect($_SERVER['HTTP_REFERER']);
      exit;
    }

  }
