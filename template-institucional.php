<?php 
// Template Name: Página Institucional
get_header();
$fields = get_fields();
?>
<main class='container'>
    <?php if(have_posts()){
        while(have_posts()){
            the_post(); ?>
        <h1 class='my=3'>Página: <?php echo $fields['titulo']; ?></h1>
            <img src="<?php echo $fields['imagen']?>">
            <?php the_content(); ?>
            <hr>
        <?php }
    }
    ?>
</main>

<?php get_footer(); ?>