# Environment Configuration System

This project now includes a comprehensive environment configuration system that allows you to manage different configurations for various environments (local, development, production, live) using `.env` files.

## Features

- **Environment-specific configuration files** (`.env.local`, `.env.development`, `.env.live`)
- **Centralized configuration management** through environment variables
- **Easy access** to configuration values throughout the application
- **Secure credential management** - keep sensitive data out of version control
- **Fallback support** for missing environment variables

## File Structure

```
project_root/
├── .env.example          # Template file showing all available options
├── .env.local           # Local development environment
├── .env.development     # Development environment
├── .env.live            # Production/live environment
├── application/
│   ├── libraries/
│   │   ├── Env.php      # Environment library
│   │   └── Config.php   # Configuration library
│   └── helpers/
│       └── env_helper.php # Environment helper functions
└── index.php            # Updated to load .env files early
```

## Quick Start

### 1. Create Environment Files

Copy the example file and create your environment-specific files:

```bash
cp env.example .env.local
cp env.example .env.development
cp env.example .env.live
```

### 2. Configure Your Environment

Edit each `.env` file with your specific configuration:

```bash
# .env.local
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=your_password
DB_DATABASE=harvest
APP_DEBUG=true
APP_URL=http://localhost
```

### 3. Set Environment

The system automatically detects the environment based on the `ENVIRONMENT` constant in `index.php`. You can also set it via:

```bash
export CI_ENV=local
export CI_ENV=development
export CI_ENV=live
```

## Available Configuration Options

### Database Configuration
```bash
DB_HOST=localhost
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_DATABASE=your_database
DB_DRIVER=mysqli
DB_PREFIX=
DB_DEBUG=true
DB_CHARSET=utf8
DB_COLLATION=utf8_general_ci
```

### Application Configuration
```bash
APP_NAME=Harvest Green
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=Asia/Kolkata
```

### Security Configuration
```bash
ENCRYPTION_KEY=your_32_character_encryption_key_here
SESSION_SECURE=false
COOKIE_SECURE=false
```

### Mail Configuration
```bash
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Cache Configuration
```bash
CACHE_DRIVER=file
CACHE_PREFIX=harvest_
CACHE_TTL=3600
```

### Logging Configuration
```bash
LOG_LEVEL=debug
LOG_CHANNEL=stack
```

## Usage in Code

### Using Helper Functions

```php
// Get environment variable with default
$db_host = env('DB_HOST', 'localhost');
$app_name = env('APP_NAME', 'Harvest Green');

// Check if variable exists
if (env_has('MAIL_HOST')) {
    $mail_host = env('MAIL_HOST');
}

// Set environment variable
env_set('CUSTOM_VAR', 'value');

// Get all environment variables
$all_vars = env_all();
```

### Using the Config Library

```php
// Load the library
$this->load->library('config');

// Get configuration values
$db_config = $this->config->get_database();
$app_config = $this->config->get_app_config();
$mail_config = $this->config->get_mail_config();

// Get specific values
$db_host = $this->config->get('DB_HOST', 'localhost');
$app_name = $this->config->get('APP_NAME', 'Harvest Green');
```

### Using the Env Library Directly

```php
// Load the library
$this->load->library('env');

// Get environment variable
$db_host = $this->env->get('DB_HOST', 'localhost');

// Check if variable exists
if ($this->env->has('MAIL_HOST')) {
    $mail_host = $this->env->get('MAIL_HOST');
}

// Set environment variable
$this->env->set('CUSTOM_VAR', 'value');

// Get all variables
$all_vars = $this->env->all();
```

## Environment File Priority

The system loads environment variables in the following order:

1. **Environment-specific file** (e.g., `.env.local`, `.env.development`)
2. **Default `.env` file** (if environment-specific file doesn't exist)
3. **System environment variables** (already set in the system)
4. **Default values** (specified in code)

## Security Best Practices

### 1. Never Commit Sensitive Data
```bash
# Add to .gitignore
.env
.env.local
.env.development
.env.live
.env.production
```

### 2. Use Strong Encryption Keys
```bash
ENCRYPTION_KEY=your_very_long_and_random_32_character_key_here
```

### 3. Environment-Specific Security
```bash
# Development
SESSION_SECURE=false
COOKIE_SECURE=false

# Production
SESSION_SECURE=true
COOKIE_SECURE=true
```

### 4. Database Credentials
```bash
# Use strong passwords and limited privileges
DB_USERNAME=app_user
DB_PASSWORD=strong_random_password_here
```

## Migration from Hardcoded Values

### Before (Hardcoded)
```php
$db['local'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => 'password123',
    'database' => 'harvest',
);
```

### After (Environment-based)
```php
$db['local'] = array(
    'hostname' => env('DB_HOST', 'localhost'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'database' => env('DB_DATABASE', 'harvest'),
);
```

## Troubleshooting

### Environment Variables Not Loading

1. **Check file permissions**: Ensure `.env` files are readable
2. **Verify file location**: `.env` files should be in the project root
3. **Check environment**: Verify `ENVIRONMENT` constant is set correctly
4. **Clear cache**: Restart your web server

### Configuration Not Working

1. **Load helper**: Ensure `env_helper` is autoloaded
2. **Check syntax**: Verify `.env` file syntax (no spaces around `=`)
3. **Restart application**: Clear any cached configurations

### Database Connection Issues

1. **Verify credentials**: Check `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE`
2. **Check host**: Ensure `DB_HOST` is correct
3. **Database exists**: Verify the database exists and is accessible
4. **User privileges**: Ensure the database user has proper permissions

## Examples

### Complete .env.local Example
```bash
# Local Environment Configuration
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=local_password
DB_DATABASE=harvest_local
DB_DRIVER=mysqli
DB_PREFIX=
DB_DEBUG=true
DB_CHARSET=utf8
DB_COLLATION=utf8_general_ci

APP_NAME=Harvest Green
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=Asia/Kolkata

ENCRYPTION_KEY=local_32_character_encryption_key_here
SESSION_SECURE=false
COOKIE_SECURE=false

MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=dev@example.com
MAIL_PASSWORD=dev_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=dev@example.com
MAIL_FROM_NAME="${APP_NAME}"

CACHE_DRIVER=file
CACHE_PREFIX=harvest_local_
CACHE_TTL=3600

LOG_LEVEL=debug
LOG_CHANNEL=stack

GOOGLE_MAPS_API_KEY=your_dev_google_maps_api_key
STRIPE_PUBLIC_KEY=your_dev_stripe_public_key
STRIPE_SECRET_KEY=your_dev_stripe_secret_key

UPLOAD_MAX_SIZE=10485760
ALLOWED_FILE_TYPES=jpg,jpeg,png,gif,pdf,doc,docx
MAINTENANCE_MODE=false
```

## Support

For issues or questions about the environment configuration system:

1. Check this README for common solutions
2. Verify your `.env` file syntax
3. Ensure all required libraries are loaded
4. Check the CodeIgniter logs for errors

## Contributing

When adding new configuration options:

1. Update `env.example` with the new option
2. Add appropriate default values in the Config library
3. Update this README with usage examples
4. Test in multiple environments
