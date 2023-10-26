<footer class="site-footer container text-center px-2 px-md-0 shadow" id="colophon">
    <div class="row footer-widget text-start velocity-widget m-0 px-2 pt-4">
        <?php for($x = 1; $x <= 3; $x++){ ?>
            <?php if ( is_active_sidebar( 'footer-'.$x ) ) { ?>
                <div class="col-md">
                    <?php dynamic_sidebar('footer-'.$x); ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="site-info px-3 py-2 py-md-4">
        <small class="text-secondary">
            Copyright © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
        </small>
        <br>
        <small class="opacity-25" style="font-size: .7rem;">
            Design by <a class="text-muted" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
        </small>
    </div>
    <!-- .site-info -->
</footer>