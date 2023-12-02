<?php
// Define the RSS feed URL
$rss_feed_url = 'https://www.ntv.com.tr/sanat.rss';

// Fetch the RSS feed
$rss = fetch_feed($rss_feed_url);

// Check if the feed was retrieved successfully
if (!is_wp_error($rss)) {
    // Get the number of items you want to display
    $max_items = $rss->get_item_quantity(5);

    // Get the RSS feed items
    $rss_items = $rss->get_items(0, $max_items);
?>

<div class="rss-feed-container">
    <?php
    // Loop through each RSS item
    foreach ($rss_items as $item) {
    ?>
        <div class="d-flex mb-20">
            <div class="rc-thumb mr-15">
                <a href="<?php echo esc_url($item->get_permalink()); ?>">
                    <div class="sidebar-posts-bg-thumb" data-background="<?php echo esc_url($item->get_enclosure()->get_thumbnail()); ?>" style="background-image: url('<?php echo esc_url($item->get_enclosure()->get_thumbnail()); ?>');"></div>
                </a>
            </div>
            <div class="rc-text">
                <h6><a href="<?php echo esc_url($item->get_permalink()); ?>"><?php echo esc_html($item->get_title()); ?></a></h6>
                <div class="rc-meta"><?php echo esc_html($item->get_date('F j, Y')); ?></div>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<?php
} else {
    // Display an error message if the RSS feed couldn't be retrieved
    echo '<p>Error fetching RSS feed</p>';
}
?>
