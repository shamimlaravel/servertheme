# Changelog

All notable changes to the `shamimstack/servertheme` package will be documented in this file.

## [1.0.0] - 2026-05-06

### Added
- Initial release of the unified DhruFusion API client
- Support for both Fusion Standard (legacy) and Fusion Pro (RESTful) APIs
- Auto-detection of API version based on configuration
- Unified DTOs for consistent data handling across both API versions
- Fluent interface for switching between API versions
- Response normalization to bridge differences between API versions
- Comprehensive exception hierarchy with meaningful error messages
- Webhook support for order feedback processing
- Laravel 12+ compatibility (PHP 8.4+)
- Full test suite with PHPUnit

### Features
- `ServerTheme` facade for easy access
- `AccountService`, `ProductService`, `OrderService`, `FeedbackService`, `ImeiService`
- `VersionResolver` for automatic API version detection
- `ResponseNormalizer` for unified response handling
- Support for bulk order placement
- Configurable via environment variables
- Order logging migration included
