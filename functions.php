<?php

// Creo una constante REDIRECT_URL
if (!defined("REDIRECT_URL")) {
  define("REDIRECT_URL", "http://localhost:3000");
}

// Hacemos redirect a la url de nuestro frontend
if (!function_exists("a_custom_redirect")) {
  function a_custom_redirect()
  {
    header("Location: " . REDIRECT_URL);
    die();
  }
}

// Permitimos que el backend tenga imagen destacada
if (!function_exists("a_theme_setup")) {
  function a_theme_setup()
  {
    add_theme_support("post-thumbnails");
  }
  add_action("after_setup_theme", "a_theme_setup");
}


// Permitir subir imagenes SVG
if (!function_exists("a_mime_types")) {
  function a_mime_types($mimes)
  {
    $mimes["svg"] = "image/svg+xml";
    return $mimes;
  }
  add_filter("upload_mimes", "a_mime_types");
}


// Agregando mas tamaños a las imagenes subidas a wordpress
if (!function_exists("a_add_image_size")) {
  function a_add_image_size()
  {
    add_image_size("custom-medium", 300, 9999);
    add_image_size("custom-tablet", 600, 9999);
    add_image_size("custom-large", 1200, 9999);
    add_image_size("custom-large-crop", 1200, true);
    add_image_size("custom-desktop", 1600, 9999);
    add_image_size("custom-full", 2560, 9999);
  }
  add_action("after_setup_theme", "a_add_image_size");
}


// Asignarle nombre a cada tamaño de imagen
if (!function_exists("a_custom_image_size_names")) {
  function a_custom_image_size_names($sizes)
  {
    return array_merge($sizes, array(
      "custom-medium" => __("Custom medium", "wp-vinas-de-oro"),
      "custom-tablet" => __("Custom tablet", "wp-vinas-de-oro"),
      "custom-large" => __("Custom large", "wp-vinas-de-oro"),
      "custom-large-crop" => __("Custom large crop", "wp-vinas-de-oro"),
      "custom-desktop" => __("Custom desktop", "wp-vinas-de-oro"),
      "custom-full" => __("Custom full", "wp-vinas-de-oro")
    ));
  }
  add_filter("image_size_names_choose", "a_custom_image_size_names");
}

// Deshabilitar Gutenber
add_filter("use_block_editor_for_post", "__return_false", 10);
add_filter("use_block_editor_for_post_type", "__return_false", 10);


// Register Menu
if (!function_exists("a_custom_navigation_menus")) {
  function a_custom_navigation_menus()
  {
    $locations = array(
      "header_menu" => __("Header menu", "wp-vinas-de-oro"),
      "footer_menu" => __("Footer menu", "wp-vinas-de-oro")
    );
    register_nav_menus($locations);
  }
  add_action("init", "a_custom_navigation_menus");
}