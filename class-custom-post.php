<?php

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'classes',
    array(
      'labels' => array(
        'name' => __( 'Classes' ),
        'singular_name' => __( 'Class' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'title' )
    )
  );
}



add_action("admin_init", "admin_init");
 
function admin_init(){
  add_meta_box("maximum_clients-meta", "Maximum Clients", "maximum_clients", "classes", "normal", "low");
}
 
function maximum_clients(){
  global $post;
  $custom = get_post_custom($post->ID);
  $maximum_clients = $custom["maximum_clients"][0];
  ?>
  <label>Year:</label>
  <input name="maximum_clients" value="<?php echo $maximum_clients; ?>" />
  <?php
}


add_action('save_post', 'save_details');

function save_details(){
  global $post;
  update_post_meta($post->ID, "maximum_clients", $_POST["maximum_clients"]);
}