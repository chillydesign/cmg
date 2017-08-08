<?php /* Template Name: Login Template */ get_header(); ?>

<?php $oublie = (isset($_GET['oublie'])) ? $_GET['oublie'] : false; ?>
<?php var_dump($oublie); ?>

<div class="loginbox">
  <div class="login_inner">

      <?php if ( $oublie === false ) : ?>

          <h2>Connexion à l'intranet du CMG</h2>
          <?php wp_login_form(array(
              'redirect'  => site_url( '/' )
          )); ?>
		<p class="notforgotten"> <a href="?oublie">Mot de passe oublié</a></p>


      <?php else : ?>

          <h2>Mot de passe oublié</h2>
  		<p>Entrez votre adresse email pour recevoir votre nouveau mot de passe</p>
  		<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
  			<div class="username">
  				<label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
  				<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
  			</div>
  			<div class="login_fields">
  				<?php do_action('login_form', 'resetpass'); ?>
  				<input type="submit" name="user-submit" value="Réinitialiser le mot de passe" class="user-submit" tabindex="1002" />
  				<?php  if($oublie === 'done') { echo '<br /><p>Un message de confirmation vous sera envoyé.</p>'; } ?>
  				<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>&amp;oublie=done" />
  				<input type="hidden" name="user-cookie" value="1" />
  			</div>
  		</form>
  		<p class="notforgotten"><a href="?acces_refuse">Pas oublié? Connexion </a></p>

      <?php endif; ?>







  </div>
</div>

<?php get_footer(); ?>
