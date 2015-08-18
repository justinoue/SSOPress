<?php
  namespace SSOPress\Controllers;
  if(!defined('ABSPATH')) die();

  class SSOController extends ApplicationController{
    public function login_by_email($attrs){
      $this->get_or_create_user_by_email($attrs);
      
      if(!$this->user){
        wp_redirect(home_url());
        exit();
      }

      $this->scramble_password();
      var_dump($this->user);
      die();

      $this->log_in_user($user);
      $this->redirect_after_login();
      exit();
    }

    public function log_in_user($user){
      wp_set_current_user($user->ID, $user->user_login);
      wp_set_auth_cookie($user->ID);
      do_action('wp_login', $user->user_login);
    }

    public function redirect_after_login(){
      $return_to = filter_var($_GET['return_to'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
      if($return_to != ""){
        wp_redirect($return_to);
      }
      else{
        wp_redirect(home_url());
      }
    }




    private function get_or_create_user_by_email($attrs){
      $this->user = get_user_by('email', $attrs['email']);
      if(!$this->user && $this->options['provision_users']){
        $this->auto_provision_user($attrs);
      }
    }


    private function auto_provision_user($attrs){
      $this->new_user = true;
      $userdata = [
        'user_email'    => $attrs['email'],
        'user_login'    => $attrs['username'],
        'user_url'      => $attrs['website'],
        'user_nicename' => $attrs['nicename'],
        'display_name'  => $attrs['display_name'],
        'user_pass'     => wp_generate_password(12),
        'first_name'    => $attrs['first_name'],
        'last_name'     => $attrs['last_name'],
        'role'          => $attrs['role'],
        'nickname'      => $attrs['nickname'],
        'description'   => $attrs['description']
      ];

      $user_id = wp_insert_user($userdata);
      if(!is_wp_error($user_id)){
        $this->user = get_user_by('email', $attrs['email']);
      }
      var_dump($attrs);
      die();

    }

    private function scramble_password(){
      if($this->options['scramble_passwords'] && $this->new_user == false){
        $this->user->user_pass = wp_hash_password(wp_generate_password(12, true, true));
        wp_update_user($user);
      }
    }
  }
