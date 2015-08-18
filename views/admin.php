<?php if(!defined('ABSPATH')) die(); ?>
<div class="wrap ssopress-admin">
  <?php $this->flash_messages(); ?>
  <h2><?php echo get_admin_page_title(); ?> - SSOPress</h2>
  <p>Here you can configure your single sign-on settings with SSOPress.</p>
  <p>More information can be found <a href="https://github.com/justinoue/ssopress" target="_blank">here</a></p>
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
            <label for="secret-token">Secret Token</label>
          </th>
          <td>
            <input type="text" name="secret_token" id="secret-token" class="regular-text" value="<?php echo $this->options['secret_token']; ?>">
            <p class="description"></p>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>
</div>
