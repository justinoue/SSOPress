<?php
  namespace SSOPress\Core;
  if(!defined('ABSPATH')) die();

  class Config{
    public static $defaults = [
      'remote_login_url' => '',
      'remote_logout_url' => '',
      'secret_token' => ''
    ];
  }
