<?php
  namespace SSOPress\Controllers\SSO;
  if(!defined('ABSPATH')) die();

  class JWT extends \SSOPress\Controllers\SSOController{
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

      $username =     isset($decoded->username) ? $decoded->username : explode('@', $decoded->email)[0];
      $first_name =   isset($decoded->first_name) ? $decoded->first_name : '';
      $last_name =    isset($decoded->last_name) ? $decoded->last_name : '';
      $display_name = isset($decoded->display_name) ? $decoded->display_name : $first_name.' '.$last_name;
      $nicename =     isset($decoded->nicename) ? $decoded->nicename : $display_name;
      $role =         isset($decoded->role) ? $decoded->role : 'subscriber';
      $nickname =     isset($decoded->nickname) ? $decoded->nickname : $username;

      $attrs = [
        'email'         => $decoded->email,
        'username'      => $username,
        'website'       => isset($decoded->website) ? $decoded->website : '',
        'nicename'      => $nicename,
        'display_name'  => $display_name,
        'first_name'    => $first_name,
        'last_name'     => $last_name,
        'role'          => $role,
        'nickname'      => $nickname,
        'description'   => isset($decoded->description) ? $decoded->description : '',
      ];
      parent::login_by_email($attrs);
    }
  }
