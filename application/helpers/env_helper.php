<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Environment Helper Functions
 * 
 * Provides convenient functions for accessing environment variables
 * throughout the application.
 */

if (!function_exists('env')) {
    /**
     * Get environment variable value
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env($key, $default = null) {
        $CI =& get_instance();
        
        // Load Env library if not already loaded
        if (!property_exists($CI, 'env')) {
            $CI->load->library('env');
        }
        
        return $CI->env->get($key, $default);
    }
}

if (!function_exists('env_set')) {
    /**
     * Set environment variable
     * 
     * @param string $key
     * @param mixed $value
     */
    function env_set($key, $value) {
        $CI =& get_instance();
        
        // Load Env library if not already loaded
        if (!property_exists($CI, 'env')) {
            $CI->load->library('env');
        }
        
        $CI->env->set($key, $value);
    }
}

if (!function_exists('env_has')) {
    /**
     * Check if environment variable exists
     * 
     * @param string $key
     * @return bool
     */
    function env_has($key) {
        $CI =& get_instance();
        
        // Load Env library if not already loaded
        if (!property_exists($CI, 'env')) {
            $CI->load->library('env');
        }
        
        return $CI->env->has($key);
    }
}

if (!function_exists('env_all')) {
    /**
     * Get all environment variables
     * 
     * @return array
     */
    function env_all() {
        $CI =& get_instance();
        
        // Load Env library if not already loaded
        if (!property_exists($CI, 'env')) {
            $CI->load->library('env');
        }
        
        return $CI->env->all();
    }
}
