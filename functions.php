<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

try {
    \Roots\bootloader();
} catch (Throwable $e) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://docs.roots.io/acorn/2.x/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (!locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

/*
|--------------------------------------------------------------------------
| Enable Sage Theme Support
|--------------------------------------------------------------------------
|
| Once our theme files are registered and available for use, we are almost
| ready to boot our application. But first, we need to signal to Acorn
| that we will need to initialize the necessary service providers built in
| for Sage when booting.
|
*/

add_theme_support('sage');


function epicure_restaurants_list($number_of_restaurants = -1)
{ ?>
    <?php
    $args = array(
        'post_type' =>  'epicure_restaurants',
        'posts_per_page'   => $number_of_restaurants
    );

    $restaurants_results = new WP_Query($args);

    $restaurants = array();
    while ($restaurants_results->have_posts()) :
        $restaurants_results->the_post();

        $restaurant = (object)[];
        $restaurant->name = get_the_title();
        $restaurant->image = get_the_post_thumbnail_url();
        $restaurant->chef = get_field('chef_name');

        array_push($restaurants, $restaurant);
    endwhile;
    wp_reset_postdata();

    return $restaurants;
    ?>
<?php
}

function epicure_dishes_list($number_of_dishes = -1)
{ ?>
    <ul class="dishes-list">

        <?php
        $args = array(
            'post_type' =>  'epicure_dishes',
            'posts_per_page'   => $number_of_dishes
        );

        $dishes = new WP_Query($args);

        while ($dishes->have_posts()) :
            $dishes->the_post();
        ?>
            <li class="dish-card text-center">
                <?php
                // Custom field type (ACF) for dishes
                $image_width = wp_get_attachment_image_src(get_post_thumbnail_id($dishes->post->ID), "medium")[1];
                $restaurant = get_field('restaurant');
                $name = get_field('name');
                $ingredients = get_field('ingredients');
                $dish_types = get_field('dish_types');
                $price = get_field('price');
                ?>
                <h2><?php echo "{$restaurant}"; ?></h2>

                <div class="dish-card-content" style="max-width: <?php echo $image_width; ?>px">
                    <?php the_post_thumbnail('medium'); ?>

                    <h1><?php echo "{$name}"; ?></h1>
                    <p><?php echo "{$ingredients}"; ?></p>
                    <?php
                    foreach ($dish_types as $type) {
                    ?>

                        <?php
                        if ($type) {
                        ?>
                            <img height="24px" class="dish-info-icon" src='<?php
                                                                            switch ($type) {
                                                                                case 'Spicy':
                                                                                    echo \Roots\asset('images/spicy-icon.svg');
                                                                                    break;
                                                                                case 'Vegetarian':
                                                                                    echo \Roots\asset('images/vegetarian-icon.svg');
                                                                                    break;
                                                                                case 'Vegan':
                                                                                    echo \Roots\asset('images/vegan-icon.svg');
                                                                                    break;
                                                                            }
                                                                            ?>' alt='icon'>

                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                    <h3 class="price"><span><?php echo "{$price} ₪"; ?></span></h3>

                </div>


            </li>

        <?php endwhile;
        wp_reset_postdata(); ?>

    </ul>
<?php
}
