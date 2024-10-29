<?php
/*
 * Create a blog that displays the number of views of a post
 */

function moashqar_count_post($post_id) {
	add_post_meta($post_id, 'moashqar_posts_views', "0" ,  'true');
	$count_posts_views = get_post_meta($post_id, 'moashqar_posts_views', true);
	$update_posts_views = $count_posts_views + 1;
	update_post_meta($post_id, 'moashqar_posts_views', $update_posts_views);
}

function moashqar_get_views($post_id) {
	$count_posts_views = get_post_meta($post_id, 'moashqar_posts_views', true);
	return (int)$count_posts_views;

}

add_filter("the_content", function ($content) {
	$post_id = get_the_ID();
	moashqar_count_post($post_id);
	$views = moashqar_get_views($post_id);
	$word_views = get_option('moashqar_view_word');
	$icon = get_option('moashqar_icon');
	$count = "<div class='box-count'> <i class='$icon'></i> $views . $word_views</div>";
	$moashqar_viewing_place  = get_option('moahsqar_viewing_place');
	if ($moashqar_viewing_place == 'moashqar_up'){
		$view = $count . $content;
	}elseif ($moashqar_viewing_place == 'moashqar_down'){
		$view = $content . $count;
	}elseif ($moashqar_viewing_place == 'moashqar_both'){
		$view = $count . $content . $count;
	}elseif ($moashqar_viewing_place == 'moashqar_remove'){
		$view = $content;
	}
	return $view ;

});

add_filter('manage_posts_columns', function ($columns) {
	$columns['views'] = 'Views';
	$columns['images'] = 'Images';
	return $columns;
});
add_filter('manage_posts_custom_column', function ($columns, $post_id) {
		if($columns == 'views') {
			echo moashqar_get_views($post_id);
		}elseif ($columns == 'images') {
			$post_id = get_the_ID();
			echo get_the_post_thumbnail($post_id, [50,50]);

		}

}, 10,2);