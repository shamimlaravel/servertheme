# ServerTheme - Unified DhruFusion API Client for Laravel

A production-ready Laravel package providing a unified interface for both **Dhru Fusion Standard** (legacy action-based) and **Dhru Fusion Pro** (modern RESTful) APIs.

## 📋 Features

- ✅ Auto-detects API version from configuration
- ✅ Supports both legacy and modern Dhru Fusion APIs
- ✅ Unified DTOs for consistent data handling
- ✅ Fluent interface for version switching
- ✅ Built-in response normalization
- ✅ Comprehensive exception handling
- ✅ Webhook support for order feedback
- ✅ Laravel 13+ compatible (PHP 8.4+)

## 🚀 Installation

```bash
composer require shamimstack/servertheme
```

Publish the configuration:

```bash
php artisan vendor:publish --tag=servertheme-config
```

## ⚙️ Configuration

Set your environment variables in `.env`:

```env
# Auto-detect or force version: auto, standard, pro
SERVERTHEME_API_VERSION=auto

# Fusion Standard (Legacy)
SERVERTHEME_STANDARD_URL=https://your-reseller.com/api/
SERVERTHEME_STANDARD_API_KEY=your_api_key
SERVERTHEME_STANDARD_USERNAME=your_username

# Fusion Pro (Modern)
SERVERTHEME_PRO_URL=https://api.dhrufusion.com
SERVERTHEME_PRO_API_TOKEN=your_bearer_token

# Common settings
SERVERTHEME_DEFAULT_CURRENCY=USD
SERVERTHEME_LOG_ORDERS=true
```

## 📖 Usage

### Basic Usage

```php
use ShamimStack\ServerTheme\Facades\ServerTheme;
use ShamimStack\ServerTheme\DTOs\Common\Order;

// Get account info (auto-detects API version)
$account = ServerTheme::getAccountInfo();
echo $account->formattedBalance(); // "450.78 EUR"

// Get available services
$services = ServerTheme::getServices();

// Place an order
$order = Order::fromArray([
    'service_id' => '123',
    'reference_id' => 'REF001',
    'imei' => '111111111111119',
    'quantity' => 1,
]);

$result = ServerTheme::placeOrder($order);
if ($result->success) {
    echo "Order ID: {$result->orderId}";
}
```

### Explicit Version Selection

```php
// Force Standard API
$legacyAccount = ServerTheme::useStandard()->getAccountInfo();

// Force Pro API
$proAccount = ServerTheme::usePro()->getAccountInfo();

// Check active version
$version = ServerTheme::getActiveVersion();
echo $version->label(); // "Dhru Fusion Pro (RESTful)"
```

### Bulk Orders

```php
$orders = [
    Order::fromArray(['service_id' => '123', 'reference_id' => 'BULK001', 'imei' => '111111111111119']),
    Order::fromArray(['service_id' => '123', 'reference_id' => 'BULK002', 'imei' => '222222222222229']),
];

$results = ServerTheme::placeBulkOrders($orders);
```

## 🧪 Testing

```bash
composer test
# or
vendor/bin/phpunit
```

## 📦 Package Structure

```
src/
├── Core/               # Core orchestration and drivers
├── DTOs/               # Data Transfer Objects
├── Traits/              # Shared HTTP and validation logic
├── Exceptions/          # Exception hierarchy
├── Support/             # Response normalization
└── Facades/             # Laravel facade
```

## 📄 License

MIT License. See [LICENSE](LICENSE) file.
