<?php if(!defined('ABSPATH')) die(); ?>
<div class="wrap ssopress-admin">
  <?php $this->flash_messages(); ?>
  <h2><?php echo get_admin_page_title(); ?> - SSOPress</h2>
  <div class="notice" style="border-left-color: #00a0d2;">
    <p>You can configure your single sign-on settings here. SSOPress uses JWT for authentication.</p>
    <p>More information can be found <a href="https://github.com/justinoue/ssopress" target="_blank">here</a></p>
    <p>Don't have a JWT single sign-on provider? Try: <a href="https://signup.clearlogin.com/?utm_source=wordpress-plugin&amp;utm_medium=link&amp;utm_campaign=try-clearlogin-for-wordpress" target="_blank">Clearlogin</a></p>
  </div>
  <div class="notice" style="border-left-color: #00a0d2;">
    <p>Your site's JWT login URL is: <strong><?php echo site_url();?>/ssopress/jwt/login</strong></p>
    <p>Your site's logout URL is: <strong><?php echo site_url();?>/wp-login.php?action=logout</strong></p>
  </div>
  <form method="post" action="<?php echo admin_url('admin.php'); ?>">
    <input type="hidden" name="action" value="sso_press">
    <?php wp_nonce_field('ssopress'); ?>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="remote-login-url">Remote Login URL</label>
          </th>
          <td>
            <input type="text" name="remote_login_url" id="remote-login-url" class="regular-text" value="<?php echo $this->options['remote_login_url']; ?>">
            <p class="description">This is the URL that SSOPress will redirect your users to for remote authentication, e.g. <strong>https://www.example.com/services/login</strong></p>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="remote-logout-url">Remote Logout URL</label>
          </th>
          <td>
            <input type="text" name="remote_logout_url" id="remote-logout-url" class="regular-text" value="<?php echo $this->options['remote_logout_url']; ?>">
            <p class="description">This is the URL that SSOPress will redirect your users to after they sign out, e.g. <strong>https://www.example.com/services/logout</strong></p>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="secret-token">JWT Secret Token</label>
          </th>
          <td>
            <input type="text" name="secret_token" id="secret-token" class="regular-text" value="<?php echo $this->options['secret_token']; ?>">
            <p class="description"></p>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="sso-required">Require single sign-on?</label>
          </th>
          <td>
            <input type="checkbox" name="sso_required" id="sso-required" class="regular-checkbox" <?php echo $this->options['sso_required'] ? 'checked="checked"' : ''; ?>>
            <p class="description">Enabling this option will redirect users from the default Wordpress login page to your Remote Login URL.</p>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="provision-users">Auto provision users?</label>
          </th>
          <td>
            <input type="checkbox" name="provision_users" id="provision-users" class="regular-checkbox" <?php echo $this->options['provision_users'] ? 'checked="checked"' : ''; ?>>
            <p class="description">Single sign-on requests for users that do not exist will be created automatically.</p>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="scramble-passwords">Scramble passwords?</label>
          </th>
          <td>
            <input type="checkbox" name="scramble_passwords" id="scramble-passwords" class="regular-checkbox" <?php echo $this->options['scramble_passwords'] ? 'checked="checked"' : ''; ?>>
            <p class="description">Enable this option to set users' passwords to unknown random passwords, ensuring single sign-on is used.</p>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>
</div>
