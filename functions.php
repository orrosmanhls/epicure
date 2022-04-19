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
    <?php
    $args = array(
        'post_type' =>  'epicure_dishes',
        'posts_per_page'   => $number_of_dishes
    );

    $dishes_results = new WP_Query($args);

    $dishes = array();
    while ($dishes_results->have_posts()) :
        $dishes_results->the_post();
        $dish = (object)[];
        $dish->image_src = get_the_post_thumbnail_url(null, 'medium');
        $dish->image_width = wp_get_attachment_image_src(get_post_thumbnail_id($dishes_results->post->ID), "medium")[1];
        $dish->name = get_field('name');
        $dish->restaurant = get_field('restaurant');
        $dish->ingredients = get_field('ingredients');
        $dish->dish_types = get_field('dish_types');
        $dish->price = get_field('price');

        array_push($dishes, $dish);

    endwhile;
    wp_reset_postdata();

    return $dishes;
    ?>
<?php
}

function epicure_random_chef()
{ ?>

    <?php
    $args = array(
        'post_type' =>  'epicure_chefs',
        'posts_per_page'   => 1,
        'orderby' => 'rand'
    );

    $chef_query = new WP_Query($args);

    // build chef object
    while ($chef_query->have_posts()) :
        $chef_query->the_post();

        $chef = (object)[];
        $chef->image = get_the_post_thumbnail_url();
        $chef->name = get_field('name');
        $chef->restaurants = get_field('restaurants');
        $chef->info =  get_field('chef_info');

    endwhile;
    wp_reset_postdata();

    // build restaurant object
    $restaurants = array();
    foreach ($chef->restaurants as $restaurant) :
        $restaurant_obj = (object)[];
        $restaurant_obj->name = $restaurant->post_title;
        $restaurant_obj->image = wp_get_attachment_image_src(get_post_thumbnail_id($restaurant->ID))[0];
        array_push($restaurants, $restaurant_obj);
    endforeach;

    $chef->restaurants = $restaurants;

    return $chef;

    ?>

<?php
}
