<?php
  namespace SSOPress\Controllers;
  if(!defined('ABSPATH')) die();

  class LoginController extends ApplicationController{
    public function init(){
      add_filter('login_message', [$this, 'login_form']);
      
      if($this->options['sso_required']){
        add_action('init', [$this, 'login_redirect']);
        add_action('login_enqueue_scripts', [$this, 'logout_redirect']);
      }
    }

    public function login_form(){
      $redirect_to = urlencode(filter_var($_GET['redirect_to'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED));
      echo '<div class="login message"><a href="'.$this->options['remote_login_url'].'?return_to='.$redirect_to.'">Click here to log in with single sign-on.</a></div><br>';
    }

    public function login_redirect(){
      global $pagenow;
      $action = isset($_GET['action']) ? $_GET['action'] : '';
      $loggedout = isset($_GET['loggedout']) ? $_GET['loggedout'] : false;
      $redirect_to = urlencode(filter_var($_GET['redirect_to'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED));
      
      if(($pagenow == 'wp-login.php') && ($action != 'logout') && !$loggedout) {
        wp_redirect($this->options['remote_login_url'].'?return_to='.$redirect_to);
        exit();
      }
    }

    public function logout_redirect(){
      $loggedout = isset($_GET['loggedout']) ? $_GET['loggedout'] : false;
      if($loggedout){
        wp_redirect($this->options['remote_logout_url']);
        exit();
      }
    }
  }
