<?php
/**
 * Template Name: Property Archive
 * Description: Displays the archive of property listings for the Real Estate Listings plugin.
 */
get_header();
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Property Listings</h1>

    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while (have_posts()) : the_post(); ?>
                <?php include REL_PLUGIN_DIR . 'templates/property-card.php'; ?>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            <?php
            the_posts_pagination(array(
                'prev_text' => __('Previous', 'real-estate-listings'),
                'next_text' => __('Next', 'real-estate-listings'),
                'mid_size'  => 2,
            ));
            ?>
        </div>
    <?php else : ?>
        <p class="text-gray-600">No properties found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>