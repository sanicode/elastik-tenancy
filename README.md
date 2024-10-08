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

**Laravel Jetstream** is a robust application scaffolding for Laravel, providing essential features such as user authentication, registration, email verification, two-factor authentication, session management, API support via Laravel Sanctum, and optional team management. **Elastik Tenancy** combined with a TenancyForLaravel (a package by Stancl that provides multi-tenancy support for Laravel applications), allows you to build a powerful, multi-tenant SaaS application with user authentication, team management, and other features provided by Jetstream, all while keeping tenant data and configuration isolated.

## Overview
- **Laravel Jetstream**: Provides scaffolding for essential features like user authentication, registration, email verification, two-factor authentication, session management, and team management.

- **TenancyForLaravel**: A flexible multi-tenancy package that supports tenant identification, database separation, and tenant-specific configurations.

## Benefits of Combining Jetstream and TenancyForLaravel:

**Scalability**: The combined setup allows you to scale your application to support multiple tenants efficiently.
Feature-Rich: You get the best of both worlds—Jetstream's user management features and TenancyForLaravel’s robust multi-tenancy support.

**Flexibility**: The architecture can be adapted to various use cases, from small SaaS applications to large enterprise solutions.

## Integrating Multitenancy with Laravel Jetstream

### Tenant Identification:

-   **Subdomains**: Each tenant can be identified by a unique subdomain (**e.g., tenant1.yourapp.com**). Middleware can be used to detect the subdomain and load the appropriate tenant configuration.

-   **Domains**: Each tenant can have its domain (**e.g., tenant1.com**), with the application routing requests to the correct tenant based on the domain.

-   **Query String or Path**: Tenants can be identified by a unique identifier in the URL path or query string (**e.g., yourapp.com/tenant1**).

### User Authentication:

-   Jetstream’s user authentication system can be extended to support multitenancy by associating users with a specific tenant. For example, each user could have a **tenant_id** field in the database, linking them to the appropriate tenant.

-   Authentication logic can be adjusted to ensure that users can only log in to their respective tenants.

### Database Separation:

-   Depending on your multitenancy approach, you might use a shared database with a **tenant_id** column to segregate data or multiple databases where each tenant has its own database.
-   Laravel's database connections can be dynamically configured based on the tenant, ensuring that the correct database is used for each request.

### Middleware:

-   Custom middleware can be used to identify the current tenant and configure the application accordingly. This includes setting the database connection, loading tenant-specific configurations, and ensuring that authenticated users belong to the correct tenant.

### Routes and Controllers:

-   Routes can be grouped based on tenants, allowing for tenant-specific functionality within your application. Controllers can be adapted to ensure they handle data in the context of the current tenant.


## Elastik Tenancy Features

- **Laravel Jetstream**: Provides authentication, registration, email verification, two-factor authentication, session management, API support, and optional team management, etc.
- **Multi-Tenancy**: Supports tenant identification via subdomains, domains, or path-based routing.
- **Tenant Data Isolation**: Ensures that each tenant's data is securely separated, using either a shared database with tenant-specific identifiers or multiple databases.
- **Dynamic Tenant Configuration**: Automatically configures the application based on the current tenant's environment.
- **Scalability**: Built to handle multiple tenants efficiently while maintaining performance.

## Installation

To get started with this project, follow these steps:

### 1. Clone the Repository

```bash
git clone git@github.com:sanicode/elastik-tenancy.git
cd elastik-tenancy
```

### 2. Alternative Install with Composer
```bash
composer create-project sanicode/elastik-tenancy
cd elastik-tenancy
```

### 3. Install Dependencies
```bash
composer update
```

### 4. Next, be sure to compile your assets
```bash
npm install && npm run build
```

### 5. Set Up Environtment Variables
Copy the .env.example file to .env and configure the necessary environment variables, including your database connection and tenant identification method.

```bash
cp .env.example .env
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

> [!IMPORTANT]
> If you used the Laravel installer and chose `sqlite` as your database, the migrations may have already been run. In which case, you're good to go 🎉 Otherwords you'll need to connect a db and run this command 👇

### 7. Run database migrations
```
php artisan migrate
```

### 8. Configure Tenants
If you're using subdomains or multiple databases, ensure that your server is configured correctly to handle tenant routing. This might involve setting up wildcard subdomains or configuring additional databases.

### 9. Serve the Application

```bash
php artisan serve
```
### 10. Open your first page in browser
[![Screenshot 2024-08-10 at 12 33 56](https://github.com/user-attachments/assets/185ddc13-93fa-45b1-97e4-d1d20f54fe5e)](https://private-user-images.githubusercontent.com/6724789/356792912-4c74d64b-4cc1-4502-8aaf-540258678f04.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MjMyNzA5ODIsIm5iZiI6MTcyMzI3MDY4MiwicGF0aCI6Ii82NzI0Nzg5LzM1Njc5MjkxMi00Yzc0ZDY0Yi00Y2MxLTQ1MDItOGFhZi01NDAyNTg2NzhmMDQucG5nP1gtQW16LUFsZ29yaXRobT1BV1M0LUhNQUMtU0hBMjU2JlgtQW16LUNyZWRlbnRpYWw9QUtJQVZDT0RZTFNBNTNQUUs0WkElMkYyMDI0MDgxMCUyRnVzLWVhc3QtMSUyRnMzJTJGYXdzNF9yZXF1ZXN0JlgtQW16LURhdGU9MjAyNDA4MTBUMDYxODAyWiZYLUFtei1FeHBpcmVzPTMwMCZYLUFtei1TaWduYXR1cmU9Yzk1YmNjNGUwYTkxMGJkNzA2ZTJiNWE4YmRiMDYxMDhiMzgzMDY2YmFkZjJmY2YxMWRiZTlkMDU5NGUyNTRmYiZYLUFtei1TaWduZWRIZWFkZXJzPWhvc3QmYWN0b3JfaWQ9MCZrZXlfaWQ9MCZyZXBvX2lkPTAifQ.ZWFyt0ZxH6ET30Ef9UgzNk_c_sDSJSeRHXdKWIwrXew)


## Usage

After setting up the project, you can register new tenant with Domain/Subdomain field in register form and log in as a user. Each user domain/subdomain will be associated with a specific tenant, and all operations will be tenant-scoped. For the basic usage you can input subdomain name without dot[.] added for suffix, for the example : tenant1, tenant2, etc.

![register-page](https://github.com/user-attachments/assets/8e90e621-a986-4bc9-bcdd-7c282f3c49e5)


## Example Routes:
- **https://tenant1.yourapp.com/dashboard** - Dashboard for Tenant 1
- **https://tenant2.yourapp.com/dashboard** - Dashboard for Tenant 2

Visit your application homepage and you should be good to go 🤘


## Contributing

Contributions are welcome! Please feel free to submit a Pull Request or open an Issue.

## License

The Elastik Tenancy is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgements
-   [Laravel](https://laravel.com/)
-   [Laravel Jetstream](https://jetstream.laravel.com/)
-   [Tenancy for Laravel](https://tenancyforlaravel.com/)
