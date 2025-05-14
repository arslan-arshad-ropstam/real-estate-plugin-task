<?php
/**
 * Template Name: Single Property
 * Description: Displays a single property listing for the Real Estate Listings plugin.
 */
get_header();
?>

<div class="container mx-auto px-4 py-8">
    <?php while (have_posts()) : the_post(); ?>
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-96 object-cover">
            <?php endif; ?>

            <div class="p-6">
                <!-- Title -->
                <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>

                <!-- Meta Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-gray-600"><strong>Price:</strong> $<?php echo esc_html(number_format(get_post_meta(get_the_ID(), '_rel_price', true))); ?></p>
                        <p class="text-gray-600"><strong>Location:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_rel_location', true)); ?></p>
                        <p class="text-gray-600"><strong>City:</strong> <?php
                            $cities = wp_get_post_terms(get_the_ID(), 'city');
                            echo !empty($cities) ? esc_html($cities[0]->name) : 'N/A';
                        ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600"><strong>Square Feet:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_rel_square_feet', true)); ?> sq ft</p>
                        <p class="text-gray-600"><strong>Status:</strong> <?php
                            $statuses = wp_get_post_terms(get_the_ID(), 'listing_status');
                            echo !empty($statuses) ? esc_html($statuses[0]->name) : 'N/A';
                        ?></p>
                    </div>
                </div>

                <!-- Description -->
                <div class="prose max-w-none mb-6">
                    <?php the_content(); ?>
                </div>

                <!-- Back to Listings -->
                <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">Back to Listings</a>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>