<?php 
  if(!defined('ABSPATH')) die();
  require('core/config.php');
  require('core/url_rewriter.php');
  require('core/router.php');
  require('controllers/application.php');
  require('controllers/admin.php');
  require('controllers/login.php');
  require('controllers/sso.php');
  require('controllers/sso/jwt.php');
