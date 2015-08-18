<?php
  namespace SSOPress\Controllers\SSO;
  if(!defined('ABSPATH')) die();

  class JWT{
    public function login(){
      require(plugin_dir_path(__FILE__).'../../lib/php-jwt/JWT.php');
      require(plugin_dir_path(__FILE__).'../../lib/php-jwt/BeforeValidException.php');
      require(plugin_dir_path(__FILE__).'../../lib/php-jwt/ExpiredException.php');
      require(plugin_dir_path(__FILE__).'../../lib/php-jwt/SignatureInvalidException.php');

      $decoded = '';  
      
      if(isset($_GET['jwt'])){
        try{
          $decoded = \Firebase\JWT\JWT::decode($_GET['jwt'], \SSOPress::$secret, ['HS256']);
        }
        catch (Exception $e){
          $decoded = $e;  
        }
      }
      $user = get_user_by('email', $decoded->email); 
      if($user){
        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login );
        
        $return_to = filter_var($_GET['return_to'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
        if($return_to != ""){
          wp_redirect($return_to);
        }
        else{
          wp_redirect(home_url());
        }
        exit();
      }
      else{
        echo 'user not found';
        exit();
      }
    }
  }
