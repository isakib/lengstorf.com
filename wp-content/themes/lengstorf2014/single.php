<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage RotorWash
 * @since RotorWash 1.0
 */

get_header();
get_template_part('common/main-column', 'post-top');

while (have_posts()):
    the_post();

    $tw_config = array(
        'via' => 'jlengstorf',
        'hashtag' => strip_tags(get_the_tag_list('', ',', '')),
        'text' => get_the_title(),
    );
    $gplus_config = array( 'width' => 60 );

    // Grabs the featured image
    $attachment_id = get_post_thumbnail_id();
    $has_image = !empty($attachment_id) ? TRUE : FALSE;

    if ($has_image) {
        $image_src = wp_get_attachment_image_src($attachment_id, 'thumbnail');
        $image_path = $image_src[0];
        $image_class = 'img-circle';
    } else {
        $image_path = ASSETS_DIR . '/images/jason-lengstorf.jpg';
        $image_class = NULL;
    }

    if (function_exists('yoast_breadcrumb')) {
        $breadcrumbs = yoast_breadcrumb('<p id="breadcrumbs" class="sr-only"><small>','</small></p>', FALSE);
    } else {
        $breadcrumbs = NULL;
    }

?>
        <div class="col-md-10 col-md-push-2">
            <?php echo $breadcrumbs; ?> 
            <h1><?php the_title(); ?></h1>
        </div>
        <div id="post-meta" 
             class="col-md-2 col-md-pull-10 hidden-sm hidden-xs">
            <img src="<?php echo $image_path; ?>"
                 alt="<?php the_title(); ?>"
                 class="<?php echo $image_class; ?>">
            <p>Posted in <?php the_category(' '); ?></p>
            <?php the_tags('<ul class="list-unstyled"><li>', '</li><li>', '</li></ul>'); ?> 
        </div>
        <article class="post col-md-8 col-md-offset-2">
            <?php the_content(); ?>

<?php if (get_field('discussion_link')): ?>
            <p id="discussion">
                <strong>Let&rsquo;s talk.</strong>
                Join the <a href="<?php the_field('discussion_link'); ?>">discussion about this post</a>.
            </p>
<?php endif; ?>

            <div class="row opt-in">
                <form class="form-inline" role="form"
                      action="http://copterlabs.us2.list-manage2.com/subscribe/post" 
                      method="post">
                    <div class="copy">
                        <h4>Get Notified of New Posts</h4>
                        <p>
                            New posts will be delivered straight to your inbox. 
                            Plus, it gives me warm fuzzies to know people read 
                            the things I write. So thanks in advance.
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" 
                               autocapitalize="off" autocorrect="off" name="MERGE0"
                               placeholder="Email your email address">
                    </div>

                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;">
                        <input type="text" 
                               name="b_34042625c99172141e2b35836_7e395d5c57" 
                               tabindex="-1" value="">
                    </div>

                    <button type="submit" name="submit"
                            class="btn btn-primary">Get Notified</button>

                    <input type="hidden" name="u" value="34042625c99172141e2b35836">
                    <input type="hidden" name="id" value="7e395d5c57">
                </form>
            </div>
        </article>

        <div class="col-md-2">
            <?php echo rw2_social_facebook_btn(get_permalink()); ?> 
            <?php echo rw2_social_gplus_btn(get_permalink(), $gplus_config); ?> 
            <?php echo rw2_social_twitter_btn(get_permalink(), $tw_config); ?> 
            <script type="text/javascript" 
                    src="//cdn.fusionads.net/fusion.js?zoneid=1332&serve=C6SDP2Y&placement=lengstorf" 
                    id="_fusionads_js" async defer></script>
        </div>

        <div id="author-bio" class="col-md-8 col-md-offset-2">
            <img src="<?php echo ASSETS_DIR; ?>/images/jason-lengstorf.jpg"
                 alt="Jason Lengstorf">
            <p>
                <?php the_author_meta('description'); ?> 
                <!-- <strong>Jason Lengstorf</strong> spends the majority of his time solving hard problems at Copter Labs, and otherwise occupies himself with travel, Learning For Fun&trade; (current obsession: cocktails), and the pursuit of new adventures. He lives in Portland, OR. -->
            </p>
            <p class="author-meta">
                Connect: 
                <a href="http://facebook.com/jasonlengstorf">Facebook</a> | 
                <a href="http://twitter.com/jlengstorf">Twitter</a> | 
                <a href="https://plus.google.com/+jasonlengstorf">Google+</a>
            </p>
        </div>
<?php 

endwhile;

get_template_part('common/main-column', 'post-bottom');
get_footer();