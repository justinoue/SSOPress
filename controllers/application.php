<?php
  namespace SSOPress\Controllers;
  if(!defined('ABSPATH')) die();

  class ApplicationController{
    public function __construct(){
      $this->options = get_option(\SSOPress::$options_var);
    }

    public function flash($type, $message){
      $messages = get_transient(\SSOPress::$flash_messages_var);
      if(!is_array($messages)){
        $messages = [];
      }
      array_push($messages, ['type' => $type, 'message' => $message]);
      set_transient(\SSOPress::$flash_messages_var, $messages);
    }

    public function flash_messages(){
      $messages = get_transient(\SSOPress::$flash_messages_var);
      if(is_array($messages)){
        foreach ($messages as $message) {
          echo '<div class="notice '.$message['type'].'"><p>'.$message['message'].'</p></div>';
        }
      }
      delete_transient(\SSOPress::$flash_messages_var);
    }

    public function update_options($new_options){
      $this->options = array_replace($this->options, $new_options);
      update_option(\SSOPress::$options_var, $this->options);
      $this->options = get_option(\SSOPress::$options_var);
    }
  }