<?php 
/*
 * @Theme Name:WebStack
 * @Theme URI:https://www.iotheme.cn/
 * @Author: iowen
 * @Author URI: https://www.iowen.cn/
 * @Date: 2020-02-22 21:26:05
 * @LastEditors: iowen
 * @LastEditTime: 2023-02-20 20:56:55
 * @FilePath: \WebStack\inc\register.php
 * @Description: 
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
define( 'THEME_URL', get_bloginfo('template_directory') );
function theme_load_scripts() {
	$theme_version = esc_attr(wp_get_theme()->get('Version'));
    wp_register_style( 'font-awesome',      THEME_URL.'/css/font-awesome.min.css', array(), $theme_version, 'all'  );
	wp_register_style( 'bootstrap',         THEME_URL.'/css/bootstrap.css', array(), $theme_version, 'all'  );
	wp_register_style( 'nav',               THEME_URL.'/css/nav.css', array(), $theme_version );

	wp_register_script( 'bootstrap',        THEME_URL.'/js/bootstrap.min.js', array('jquery'), $theme_version, true );
	wp_enqueue_style( 'frigPatchs',         THEME_URL.'/css/patch.css', array('nav'), 'uni_20260608', 'all' );

	wp_register_script( 'TweenMax',         THEME_URL.'/js/TweenMax.min.js', array('jquery'), $theme_version, true );
	wp_register_script( 'appjs',            THEME_URL.'/js/app.js', array('jquery'), $theme_version, true );
	wp_register_script( 'lazyload',         THEME_URL.'/js/lazyload.min.js', array('jquery'), $theme_version, true );

	if( !is_admin() )
    {
		wp_enqueue_style('font-awesome');
		wp_enqueue_style('bootstrap');
		wp_enqueue_style('nav'); 

		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', THEME_URL.'/js/jquery-1.11.1.min.js', array(), $theme_version ,false);
		wp_enqueue_script('jquery');

		wp_enqueue_script('bootstrap');
		wp_enqueue_script('TweenMax');
		wp_enqueue_script('appjs'); 
		
		if(io_get_option('lazyload')) wp_enqueue_script('lazyload'); 

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	wp_localize_script('appjs', 'theme' , array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'addico'  => get_theme_file_uri('/images/add.png'),
		'version' => $theme_version,
	)); 
}
add_action('wp_enqueue_scripts', 'theme_load_scripts');

/**
 * 前台性能优化：非关键脚本延迟执行，减少首屏阻塞。
 * jQuery 保持在 head 中同步加载，因为 footer.php 内联脚本直接依赖 $。
 */
add_filter('script_loader_tag', function($tag, $handle, $src) {
    if (is_admin()) return $tag;
    $defer_handles = array('bootstrap', 'TweenMax', 'appjs', 'lazyload', 'comment-reply');
    if (in_array($handle, $defer_handles, true) && false === strpos($tag, ' defer')) {
        return str_replace(' src=', ' defer src=', $tag);
    }
    return $tag;
}, 10, 3);

/**
 * 前台资源优化：预连接外部图标/备案资源域名，并禁用游客不需要的 dashicons。
 */
add_action('wp_enqueue_scripts', function() {
    if (!is_admin() && !is_user_logged_in()) {
        wp_deregister_style('dashicons');
    }
}, 101);

add_filter('wp_resource_hints', function($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = 'https://static.myssl.com';
        $urls[] = 'https://beian.mps.gov.cn';
    }
    return array_values(array_unique($urls));
}, 10, 2);

