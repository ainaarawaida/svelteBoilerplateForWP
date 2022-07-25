=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: svelteBoilerplate
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

1- Open console and go to this svelteboilerplate plugin root path
#npm create vite@latest my-app -- --template svelte
Done. Now run:

  #cd my-app
  #npm install
  #npm run dev

////////////////////////////////////////////////////////
////////////////////////////
2- To build , you must configure wordpress hook first

2.1- define plugin path at svelteboilerplate/svelteboilerplate.php

define( 'SVELTEBOILERPLATE_PATH', plugin_dir_path( __FILE__ ) );
define( 'SVELTEBOILERPLATE_URL', plugins_url('svelteboilerplate') );

////////////////////////////////////////////////////////
////////////////////////////
2.2- add script module hook at svelteboilerplate/includes/class-svelteboilerplate.php
under private function define_public_hooks() {

$this->loader->add_filter('script_loader_tag', $plugin_public, 'add_type_attribute' , 10, 3); 


////////////////////////////////////////////////////////
////////////////////////////
2.3- add code at svelteboilerplate/public/class-svelteboilerplate-public.php
under public function enqueue_styles() {

$files = glob(WP_PLUGIN_DIR . '/test/my-app/dist/assets/*.css');
		
		foreach ($files AS $key => $val){
			wp_enqueue_style( 'svelte_my-app#'.$key , SVELTEBOILERPLATE_URL.'/my-app/dist/assets/' . basename($val) , array(), null, 'all' );
		}

////////////////////////////////////////////////////////
////////////////////////////
2.4- add code at svelteboilerplate/public/class-svelteboilerplate-public.php
under public function enqueue_scripts() {

$files = glob(SVELTEBOILERPLATE_PATH . '/my-app/dist/assets/*.js');
		
		foreach ($files AS $key => $val){
			wp_enqueue_script( 'svelte_my-app#'.$key , SVELTEBOILERPLATE_URL.'/my-app/dist/assets/' . basename($val) , array(), null, true );
		}
		wp_localize_script( 'svelte_my-app#'.$key, 'frontend_ajax_object',
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'statuslogin' => wp_get_current_user()
			)
		);


////////////////////////////////////////////////////////
////////////////////////////
2.5- add code at svelteboilerplate/public/class-svelteboilerplate-public.php
under class Svelteboilerplate_Public {

public function add_type_attribute($tag, $handle, $src) {
		// if not your script, do nothing and return original $tag
		if (strpos($handle, 'svelte_my-app') !== false) {
			$tag = '<script type="module" crossorigin src="' . esc_url( $src ) . '"></script>';
			return $tag;
		}
		
		return $tag;
	}

////////////////////////////////////////////////////////
////////////////////////////
2.6- edit svelteboilerplate/my-app/vite.config.js

import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte'

// https://vitejs.dev/config/
export default defineConfig({
  base: '/wp-content/plugins/svelteboilerplate/my-app/dist/',
  plugins: [svelte()]
})


2.7 - edit svelteboilerplate/my-app/src/main.js
example You need render from id <div id="app"></div> or <div id="app2"></div>

// import './app.css'
import App from './App.svelte'
import App2 from './App2.svelte'

let app;
let app2;

if (document.getElementById('app') !== null) {
  app = new App({
    target: document.getElementById('app')
  })
}

if (document.getElementById('app2') !== null) {
  app2 = new App2({
    target: document.getElementById('app2')
  })
}

export let ex_app = app;
export let ex_app2 = app2;


////////////////////////////////////////////////////////
////////////////////////////
2.7- build 
#npm run build


