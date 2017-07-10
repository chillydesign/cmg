<?php /* Template Name: Login Template */ get_header(); ?>




<div class="loginbox">
  <div class="login_inner">
    <h2>Connexion à l'intranet du CMG</h2>
    <?php wp_login_form(array(
        'redirect'  => site_url( '/' )
    )); ?>
  </div>
</div>

<?php get_footer(); ?>
