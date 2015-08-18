<?php
  namespace SSOPress\Core;
  if(!defined('ABSPATH')) die();

  class Router{
    public function parse_query($query){
      if($query->is_main_query() && get_query_var('ssopress') == 'true'){
        add_action('template_redirect', [$this, 'route'], 0);
      }
    }

    public function route(){
      $action = get_query_var('ssopress_action');
      if($action){
        switch ($action) {
          case 'jwt_login':
            (new \SSOPress\Controllers\SSO\JWT)->login();
            break;
        }
      }
    }
  }
