<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <?php if (has_post_thumbnail()) : ?>
        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'medium')); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-48 object-cover">
    <?php endif; ?>
    <div class="p-4">
        <h3 class="text-lg font-semibold"><?php the_title(); ?></h3>
        <p class="text-gray-600"><?php echo esc_html(get_post_meta(get_the_ID(), '_rel_price', true)); ?> USD</p>
        <p class="text-sm text-gray-500"><?php echo esc_html(wp_get_post_terms(get_the_ID(), 'listing_status')[0]->name); ?></p>
        <a href="<?php the_permalink(); ?>" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Listing</a>
    </div>
</div>