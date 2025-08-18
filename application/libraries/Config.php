<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Configuration Library
 * 
 * Provides easy access to environment-based configuration values
 * and centralized configuration management.
 */
class Config {
    
    private $CI;
    private $config_cache = array();
    
    public function __construct() {
        $this->CI =& get_instance();
    }
    
    /**
     * Get configuration value
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null) {
        // Check cache first
        if (isset($this->config_cache[$key])) {
            return $this->config_cache[$key];
        }
        
        // Try to get from environment
        if (function_exists('env')) {
            $value = env($key, $default);
            $this->config_cache[$key] = $value;
            return $value;
        }
        
        // Fallback to CodeIgniter config
        if (property_exists($this->CI, 'config')) {
            $value = $this->CI->config->item($key);
            if ($value !== null) {
                $this->config_cache[$key] = $value;
                return $value;
            }
        }
        
        return $default;
    }
    
    /**
     * Set configuration value
     * 
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value) {
        $this->config_cache[$key] = $value;
        if (property_exists($this->CI, 'config')) {
            $this->CI->config->set_item($key, $value);
        }
    }
    
    /**
     * Get database configuration
     * 
     * @param string $group
     * @return array
     */
    public function get_database($group = null) {
        if ($group === null && property_exists($this->CI, 'db')) {
            $group = $this->CI->db->dbgroup;
        }
        
        $db_config = array(
            'hostname' => $this->get('DB_HOST', 'localhost'),
            'username' => $this->get('DB_USERNAME', ''),
            'password' => $this->get('DB_PASSWORD', ''),
            'database' => $this->get('DB_DATABASE', ''),
            'dbdriver' => $this->get('DB_DRIVER', 'mysqli'),
            'dbprefix' => $this->get('DB_PREFIX', ''),
            'db_debug' => $this->get('DB_DEBUG', true),
            'char_set' => $this->get('DB_CHARSET', 'utf8'),
            'dbcollat' => $this->get('DB_COLLATION', 'utf8_general_ci'),
        );
        
        return $db_config;
    }
    
    /**
     * Get application configuration
     * 
     * @return array
     */
    public function get_app_config() {
        return array(
            'name' => $this->get('APP_NAME', 'Harvest Green'),
            'env' => $this->get('APP_ENV', ENVIRONMENT),
            'debug' => $this->get('APP_DEBUG', (ENVIRONMENT !== 'production')),
            'url' => $this->get('APP_URL', ''),
            'timezone' => $this->get('APP_TIMEZONE', 'Asia/Kolkata'),
        );
    }
    
    /**
     * Get mail configuration
     * 
     * @return array
     */
    public function get_mail_config() {
        return array(
            'host' => $this->get('MAIL_HOST', 'smtp.gmail.com'),
            'port' => $this->get('MAIL_PORT', 587),
            'username' => $this->get('MAIL_USERNAME', ''),
            'password' => $this->get('MAIL_PASSWORD', ''),
            'encryption' => $this->get('MAIL_ENCRYPTION', 'tls'),
            'from_address' => $this->get('MAIL_FROM_ADDRESS', ''),
            'from_name' => $this->get('MAIL_FROM_NAME', $this->get('APP_NAME', 'Harvest Green')),
        );
    }
    
    /**
     * Get cache configuration
     * 
     * @return array
     */
    public function get_cache_config() {
        return array(
            'driver' => $this->get('CACHE_DRIVER', 'file'),
            'prefix' => $this->get('CACHE_PREFIX', 'harvest_'),
            'ttl' => $this->get('CACHE_TTL', 3600),
        );
    }
    
    /**
     * Check if configuration key exists
     * 
     * @param string $key
     * @return bool
     */
    public function has($key) {
        if (isset($this->config_cache[$key])) {
            return true;
        }
        
        if (function_exists('env') && env($key) !== null) {
            return true;
        }
        
        if (property_exists($this->CI, 'config')) {
            return $this->CI->config->item($key) !== null;
        }
        return false;
    }
    
    /**
     * Get all configuration values
     * 
     * @return array
     */
    public function all() {
        return array_merge(
            $this->config_cache,
            $this->get_app_config(),
            $this->get_database(),
            $this->get_mail_config(),
            $this->get_cache_config()
        );
    }
    
    /**
     * Clear configuration cache
     */
    public function clear_cache() {
        $this->config_cache = array();
    }
}
