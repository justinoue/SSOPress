<?php
  namespace SSOPress\Core;
  if(!defined('ABSPATH')) die();

  class URLRewriter{
    public function init(){
      $this->add_rewrite_tags();
      $this->add_rewrite_rules();
    }

    private function add_rewrite_tags(){
      add_rewrite_tag('%ssopress%', '([^&]+)');
      add_rewrite_tag('%ssopress_action%', '([^&]+)');
    }
    
    private function add_rewrite_rules(){
      add_rewrite_rule(
        '^ssopress/jwt/login/?$',
        'index.php?ssopress=true&ssopress_action=jwt_login',
        'top'
      );
    }
  }
