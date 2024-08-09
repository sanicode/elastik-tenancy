<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>
<a href="https://jetstream.laravel.com" target="_blank">
<img src="https://picperf.io/https://laravelnews.s3.amazonaws.com/images/jetstream.png" width="400" alt="Jetstream Logo"></img>
</a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Elastik Tenancy

Laravel Jetstream is a robust application scaffolding for Laravel, providing essential features such as user authentication, registration, email verification, two-factor authentication, session management, API support via Laravel Sanctum, and optional team management. Elastik Tenancy combined with a multitenancy architecture, Laravel Jetstream can be adapted to serve multiple tenants, each with their isolated data and configurations.

## Integrating Multitenancy with Laravel Jetstream

### Tenant Identification:

    -   Subdomains: Each tenant can be identified by a unique subdomain (e.g., tenant1.yourapp.com). Middleware can be used to detect the subdomain and load the appropriate tenant configuration.

    -   Domains: Each tenant can have its domain (e.g., tenant1.com), with the application routing requests to the correct tenant based on the domain.

    -   Query String or Path: Tenants can be identified by a unique identifier in the URL path or query string (e.g., yourapp.com/tenant1).

### User Authentication:

    -   Jetstream’s user authentication system can be extended to support multitenancy by associating users with a specific tenant. For example, each user could have a tenant_id field in the database, linking them to the appropriate tenant.

    -   Authentication logic can be adjusted to ensure that users can only log in to their respective tenants.

### Database Separation:

    -   Depending on your multitenancy approach, you might use a shared database with a tenant_id column to segregate data or multiple databases where each tenant has its own database.
    -   Laravel's database connections can be dynamically configured based on the tenant, ensuring that the correct database is used for each request.

### Middleware:

    -   Custom middleware can be used to identify the current tenant and configure the application accordingly. This includes setting the database connection, loading tenant-specific configurations, and ensuring that authenticated users belong to the correct tenant.

### Routes and Controllers:

    -   Routes can be grouped based on tenants, allowing for tenant-specific functionality within your application. Controllers can be adapted to ensure they handle data in the context of the current tenant.

## Credits

-   [Jetstream](https://jetstream.laravel.com/)
-   [Tenancy for Laravel](https://tenancyforlaravel.com/)

## License

The Elastik Tenancy is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
