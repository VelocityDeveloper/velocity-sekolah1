<?php

/**
 * Template Name: Home Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package justg
 */

get_header();
$container = velocitytheme_option('justg_container_type', 'container');
$home_banner = velocitytheme_option('home_banner', '');
$home_banner_title = velocitytheme_option('home_banner_title', '');
$home_banner_subtitle = velocitytheme_option('home_banner_subtitle', '');
$headline_post = velocitytheme_option('headline_post', '');
?>

<?php if($home_banner){ ?>
    <div class="mx-2-minus position-relative">
        <img class="w-100" src="<?php echo $home_banner;?>" />
        <div class="velocity-banner-caption">
            <h1 class="velocity-banner-title text-white"><?php echo $home_banner_title;?></h1>
            <h2 class="velocity-banner-subtitle fs-6 text-white"><?php echo $home_banner_subtitle;?></h2>
        </div>
    </div>
<?php } ?>

<div class="velocity-headline mx-2-minus">
    <?php 
    $args = array(
        'posts_per_page' => 1,
        'showposts' => 1,
        'cat' => $headline_post,
    );
    $wp_query = new WP_Query($args); 
    if($wp_query->have_posts ()):
    while($wp_query->have_posts()): $wp_query->the_post(); ?>
        <div class="bp-thumbnail" 
            <?php if ( has_post_thumbnail() ) : ?>
            style="background-image: url(<?php the_post_thumbnail_url( 'medium' ); ?> );"
            <?php endif; ?>>
            </div>
            <div class="bp-content">
            <div class="bp-title">
                <a class="fw-bold" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </div>
            <div class="text-muted">
                <?php $content = get_the_content();
                $trimmed_content = wp_trim_words($content,50);
                echo $trimmed_content.' '; ?>
                <a class="font-italic" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Selengkapnya</a>
            </div>
        </div>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>


<div class="wrapper" id="page-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content">
        <div class="row">

            <?php do_action('justg_before_content'); ?>

            <div class="content-area col order-2" id="primary">

            <main class="site-main" id="main" role="main">

                <div class="text-uppercase bg-theme text-white fw-bold p-3 fs-6 lh-1">
                    <?php echo velocity_category_name('news1');?>
                </div>
                <div class="row mx-0 mb-4 pt-3 border-end border-start border-bottom-primary px-sm-0 px-1">
                    <div class="col-sm-6 pe-sm-1">
                        <?php echo velocity_first_post('news1');?>
                    </div>
                    <div class="col-sm-6 mt-sm-0 mt-3">
                        <?php echo velocity_recent_posts('news1', array('offset' => 1));?>
                    </div>
                </div>


                <div class="row mx-sm-0">
                    <div class="col-sm-6 ps-sm-0 pe-sm-2 mb-3">
                        <div class="text-uppercase bg-theme text-white fw-bold p-3 fs-6 lh-1">
                            <?php echo velocity_category_name('news2');?>
                        </div>
                        <div class="border-end border-start border-bottom-primary p-3 pb-2">
                            <?php echo velocity_recent_posts('news2', array('showposts' => 2));?>
                        </div>
                    </div>
                    <div class="col-sm-6 pe-sm-0 ps-sm-2 mb-3">
                        <div class="text-uppercase bg-theme text-white fw-bold p-3 fs-6 lh-1">
                            <?php echo velocity_category_name('news3');?>
                        </div>
                        <div class="border-end border-start border-bottom-primary p-3 pb-2">
                            <?php echo velocity_recent_posts('news3', array('showposts' => 2));?>
                        </div>
                    </div>
                </div>


                <div class="text-uppercase bg-theme text-white fw-bold p-3 fs-6 lh-1">
                    <?php echo velocity_category_name('news4');?>
                </div>
                <div class="border-end border-start border-bottom-primary p-3">
                    <?php echo velocity_gallery_posts('news4');?>
                </div>


                <div class="row mx-sm-0 mt-3">
                    <div class="col-sm-6 ps-sm-0 pe-sm-2 mb-3 mb-sm-0">
                        <div class="text-uppercase bg-theme text-white fw-bold p-3 fs-6 lh-1">
                            <?php echo velocity_category_name('news5');?>
                        </div>
                        <div class="border-end border-start border-bottom-primary p-3 pb-2">
                            <?php echo velocity_recent_posts('news5', array('showposts' => 2));?>
                        </div>
                    </div>
                    <div class="col-sm-6 pe-sm-0 ps-sm-2">
                        <div class="text-uppercase bg-theme text-white fw-bold p-3 fs-6 lh-1">
                            <?php echo velocity_category_name('news6');?>
                        </div>
                        <div class="border-end border-start border-bottom-primary p-3 pb-2">
                            <?php echo velocity_recent_posts('news6', array('showposts' => 2));?>
                        </div>
                    </div>
                </div>

            </main><!-- #main -->

            </div>

            <?php do_action('justg_after_content'); ?>

        </div>

    </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
