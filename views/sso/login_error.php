<!DOCTYPE html>
<!--[if IE 8]>
  <html xmlns="http://www.w3.org/1999/xhtml" class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
  <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!--<![endif]-->
  <head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php bloginfo('name'); ?> &rsaquo; Single Sign-on Error</title>
    <?php wp_admin_css( 'login', true ); ?>
  </head>
  <body class="login">
    <div id="login">
      <h1><a href="<?php echo esc_url( $login_header_url ); ?>" title="<?php echo esc_attr( $login_header_title ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
      <div id="login_error" class="login message">
        <p><strong>ERROR:</strong> An error has occured while attempting single sign-on.</p><br>
        <p>Possible errors include:</p>
        <ul style="margin-left: 24px;">
          <li>Bad claim</li>
          <li>Expired claim</li>
          <li>User does not exist</li>
          <li>User could not be created</li>
          <li>Other unforseen errors</li>
        </ul><br>
        <p><a href="/login">Please try logging in again.</a></p><br>
        <p>If the issue persists, please contact your administrator.</p>
      </div>
      <p id="backtoblog"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Are you lost?' ); ?>"><?php printf( __( '&larr; Back to %s' ), get_bloginfo( 'title', 'display' ) ); ?></a></p>
    </div>
    <div class="clear"></div>
  </body>
</html>
