<?php get_header();?>

    <main class='container'>
        <?php if(have_posts()){
                while(have_posts()){
                    the_post(); ?>

                <!-- <h1 class='my-3'><?php the_title();?>!!</h1> -->
                <?php the_content(); ?>
                
                <?php }
        } ?>


        <div class="lista-productos">
            <h2 class="text-center">PRODUCTOS</h2>
            <div class="row mb-3 masonry">
            <?php
            $args = array(
                'post_type' => 'producto',
                'post_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'title'

            );
                $productos = new WP_Query($args);

                if($productos->have_posts()){
                    while($productos->have_posts()){
                        $productos->the_post();
                        ?>

                        <ul class="col-4 thumbnails">
                            <li class="shadows">
                                <?php the_post_thumbnail('large'); ?>
                            </li>
                            <h4 class='my-3 text-center'>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        </ul>
                    <?php }
                }
            ?>
        </div>
    </div>
    </main>

<?php get_footer();?>