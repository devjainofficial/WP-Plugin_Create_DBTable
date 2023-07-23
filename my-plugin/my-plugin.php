<?php
/**
 * Plugin Name: My Plugin
 * Description: This is my Plugin.
 * Version: 1.1
 * Author: Dev Jain
 * Author URI: localhost/plugin
 */
if(!defined('ABSPATH')){
    header("location: /");
    die("");
}
// Security Issue

// URL >> HTTP Server Request Apache >> .htaccess >> index.php >> wp-blog-header.php >> wp-load.php >> wp-config.php(database, security issue, multisite etc) 

// Activation Hook
function my_plugin_activation(){
    global $wpdb, $table_prefix;    //connect with database using wpdb
    $wp_emp = $table_prefix.'emp';


    $q = "CREATE TABLE IF NOT EXISTS `$wp_emp` (`ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `email` VARCHAR(100) NOT NULL , `status` BOOLEAN NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";

    $wpdb->query($q);

    // $q = "INSERT INTO `$wp_emp` (`name`, `email`, `status`) VALUES ('dev', 'dev@gmail.com', 1);";
    // $wpdb->query($q);

    $data = array(
        'name' => 'Dev',
        'email' => 'devjain@gmail.com',
        'status' => 1
    );

    $wpdb->insert($wp_emp, $data);
}
register_activation_hook(__FILE__, 'my_plugin_activation');

// Deactivation Hook
function my_plugin_deactivation(){
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';

    $q = "TRUNCATE `$wp_emp`";
    $wpdb->query($q);
}
register_deactivation_hook(__FILE__, 'my_plugin_deactivation');


// ShortCode
function my_sc_fun(){
    return "function call";
}

add_shortcode('my-sc', 'my_sc_fun');


?>