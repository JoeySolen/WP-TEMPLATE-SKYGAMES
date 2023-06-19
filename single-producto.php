<?php get_header(); ?>

    <main class='container my-3'>
        <?php if(have_posts()){
            while(have_posts()){
                the_post();
                $taxonomy = get_the_terms(get_the_ID(), 'categoria-productos');
            ?>
                <h1 class='my-5'><?php the_title() ?></h1>
                <div class="row">
                    <div class="col-4">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                    <div class="col-8">
                        <?php echo do_shortcode('[contact-form-7 id="97" title="Formulario de contacto 1"]') ?>
                    </div>
                    <div class="col-12">
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php 
                $ID_producto_actual = get_the_ID();
                $args = array(
                    'post_type' => 'producto',
                    'posts_per_page' => 3,
                    'order' => 'ASC',
                    'orderby' => 'title',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categoria-productos',
                            'field' => 'slug',
                            'terms' => $taxonomy[0] -> slug
                        )
                    ),
                    'post__not_in'  => array($ID_producto_actual) //Con esta función evito que el loop me llame el producto actual, descartándolo del array de argumentos.
                );
                $productos = new WP_Query($args);?>

                <?php if ($productos->have_posts()){ ?>
                    <div class="row text-center justify-content-center productos-relacionados">
                        <div class="col-12">
                            <h3>Productos Relacionados</h3> 
                        </div>
                        <?php while ($productos->have_posts()){ ?>
                            <?php $productos->the_post(); ?>
                            <div class="col-2 my-3 text-center">
                                <h4>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
            <?php }
        } ?>
    </main>
<?php get_footer(); ?>