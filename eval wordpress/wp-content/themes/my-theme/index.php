<?php get_header(); ?>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  <div class="container-fluid">
    <div class="row home-header">
      <div class="col-12">
        <h1 class="mt-5"><?php wp_title() ?></h1>
      </div>
    </div>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="row">
              <div class="col-12">
                  <?php the_content(); ?>
              </div>
          </div>
      <?php endwhile; endif;?>
  </div>
</main>

<?php get_footer(); ?>
