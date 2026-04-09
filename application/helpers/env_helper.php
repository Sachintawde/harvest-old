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

if (!function_exists('img_url')) {
    /**
     * Convert a stored image path to an absolute URL using the current base_url.
     * Handles both legacy absolute URLs (with hardcoded domain) and relative paths,
     * so the correct URL is always returned regardless of environment.
     *
     * @param  string $path  Stored image path (relative or absolute URL)
     * @return string        Absolute URL using current base_url
     */
    function img_url($path) {
        if (empty($path)) {
            return '';
        }
        // If the stored value is already an absolute URL, extract the path component
        // and rebuild it with the current base_url so the domain is always dynamic.
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            $parsed   = parse_url($path);
            $relative = ltrim(isset($parsed['path']) ? $parsed['path'] : '', '/');
            return base_url($relative);
        }
        // Already a relative path — just prepend base_url.
        return base_url($path);
    }
}
