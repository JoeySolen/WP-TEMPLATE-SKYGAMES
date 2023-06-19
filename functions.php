<?php
    function init_template(){

        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');

        register_nav_menus(
            array(
                'top_menu' => 'Menú Principal'
            )
        );

    }

    add_action( 'after_setup_theme','init_template' );

    function assets(){
        wp_register_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css', '', '5.0.0', 'all' );
        wp_register_style('montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat&display=swap', '', '1.0', 'all');

        wp_enqueue_style( 'estilos',  get_stylesheet_uri(), array('bootstrap', 'montserrat'), '1.1', 'all');

        wp_register_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', '', '1.16.0', true );

        wp_enqueue_script('bootstraps', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js', array('jquery', 'popper'), '4.4.1', true);

        wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', '','1.0', true);

    }

    add_action( 'wp_enqueue_scripts', 'assets' );

    function sidebar(){
        register_sidebar(
            array(
                'name' => 'Pie de página',
                'id' => 'footer',
                'description' => 'Zona de Widgets para pie de página',
                'before_title' => '<p>',
                'after_title' => '</p>',
                'before_widget' => '<div id="$1$s" class="%2$s">',
                'after_widget' => '</div>',
            )
        );
    }

    add_action('widgets_init', 'sidebar');

    function productos_type(){ //Con esta función, es posible crear nuevos Custom Post Type, o entradas personalizadas, asociadas en este caso a productos de la tienda.

        $labels =array(
            'name' => 'Productos',
            'singular_name' => 'Producto',
            'menu_name' => 'Productos',
        );
        $args = array(
            'label' => 'Productos',
            'description' => 'Productos de Platzi',
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
            'public' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-cart',
            'can_export' => true,
            'publicly_queryable' => true,
            'rewrite' => true,
            'show_in_rest' => true,
        );
        register_post_type('producto', $args);
    
    }

    add_action('init', 'productos_type');

    function bps_masonry () {
        wp_enqueue_script('masonry-js', '//unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery'));
        wp_enqueue_script('masonry-init', get_stylesheet_directory_uri() . '/assets/js/masonry-init.js', array('masonry'), 1, true); 
        }
        
        add_action( 'wp_enqueue_scripts', 'bps_masonry' );
        

    add_action('init', 'pgRegisterTax');
    function pgRegisterTax() { //Con esta función, es posible registrar nuevas taonomías que pueden ser asociadas a los productos y de este modo organizarlos y filtrarlos con facilidad.    
        $args = array(
            'hierarchical' => true, //permite crear subcategorías
            'labels' => array(
                'name' => 'Categorías de productos',
                'singular_name' => 'Categoría de productos',
            ),
            'show_in_nav_menu' => true,
            'show_admin_column' => true,
            'rewrite' => array('slug' => 'categoria-productos')
        );
        register_taxonomy('categoria-productos', array('producto'), $args);
    }
?>