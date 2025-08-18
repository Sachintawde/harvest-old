<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Environment Configuration Library
 * 
 * This library loads environment variables from .env files and provides
 * easy access to configuration values across different environments.
 */
class Env {
    
    private $CI;
    private $env_vars = array();
    private $env_file;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->load_env_file();
    }
    
    /**
     * Load environment variables from .env file
     */
    private function load_env_file() {
        // Determine environment file to load
        $env = ENVIRONMENT;
        $this->env_file = FCPATH . ".env.{$env}";
        
        // Fallback to .env if environment-specific file doesn't exist
        if (!file_exists($this->env_file)) {
            $this->env_file = FCPATH . '.env';
        }
        
        // Load environment variables
        if (file_exists($this->env_file)) {
            $this->parse_env_file();
        }
    }
    
    /**
     * Parse .env file and set environment variables
     */
    private function parse_env_file() {
        $lines = file($this->env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Skip comments and empty lines
            if (strpos(trim($line), '#') === 0 || empty(trim($line))) {
                continue;
            }
            
            // Parse key=value pairs
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Remove quotes if present
                if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
                    (substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
                    $value = substr($value, 1, -1);
                }
                
                $this->env_vars[$key] = $value;
                
                // Set as environment variable if not already set
                if (!getenv($key)) {
                    putenv("{$key}={$value}");
                    $_ENV[$key] = $value;
                    $_SERVER[$key] = $value;
                }
            }
        }
    }
    
    /**
     * Get environment variable value
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null) {
        // Check in order: .env file, environment variable, server variable
        if (isset($this->env_vars[$key])) {
            return $this->env_vars[$key];
        }
        
        if (getenv($key) !== false) {
            return getenv($key);
        }
        
        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }
        
        if (isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }
        
        return $default;
    }
    
    /**
     * Set environment variable
     * 
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value) {
        $this->env_vars[$key] = $value;
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
    
    /**
     * Check if environment variable exists
     * 
     * @param string $key
     * @return bool
     */
    public function has($key) {
        return isset($this->env_vars[$key]) || 
               getenv($key) !== false || 
               isset($_ENV[$key]) || 
               isset($_SERVER[$key]);
    }
    
    /**
     * Get all environment variables
     * 
     * @return array
     */
    public function all() {
        return array_merge($this->env_vars, $_ENV, $_SERVER);
    }
    
    /**
     * Get current environment file path
     * 
     * @return string
     */
    public function get_env_file() {
        return $this->env_file;
    }
    
    /**
     * Check if .env file exists
     * 
     * @return bool
     */
    public function has_env_file() {
        return file_exists($this->env_file);
    }
}
