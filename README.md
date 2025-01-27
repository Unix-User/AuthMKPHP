<p align="center"><a href="https://github.com/Unix-User/AuthMKPHP" target="_blank"><img src="https://user-images.githubusercontent.com/38821945/192930836-6be0ee28-7206-4651-a18c-da7e8ab99a11.svg" width="400" alt="AuthMKPHP Logo"></a></p>

<p align="center">
  
  [Português](README-PT.md) | [Español](README-ES.md)
  
</p>

## About AuthMKPHP

AuthMKPHP is a web application built with Laravel and Vue.js, designed to streamline user and profile management within Mikrotik devices' PPPoE servers.  It provides a user-friendly interface for managing users and their associated devices, enhancing efficiency and centralizing administration.

## Installation and Setup

This section guides you through setting up AuthMKPHP on your system.

### Prerequisites

Before you begin, ensure you have the following installed and configured on your system:

* **PHP:** Version 8.2 or higher. Additionally, ensure that the following PHP extensions are enabled: BCrypt, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, and sockets. The `composer.json` file specifies `^8.2.0`, so ensure you have at least PHP 8.2 installed.
* **Composer:** The PHP dependency manager.  You can download it from [https://getcomposer.org/](https://getcomposer.org/).
* **Node.js and npm:**  Node.js is a JavaScript runtime environment, and npm is its package manager. Download them from [https://nodejs.org/](https://nodejs.org/).


### Development Setup

These steps will set up AuthMKPHP for local development.

1. **Clone the repository:**  Clone the AuthMKPHP repository to your local machine using Git:
   ```bash
   git clone https://github.com/Unix-User/AuthMKPHP.git
   cd AuthMKPHP
   ```

2. **Install dependencies:** Install the required PHP and JavaScript dependencies using Composer and npm:
   ```bash
   composer install
   npm install
   ```

3. **Configure environment variables:** Create a `.env` file by copying the `.env.example` file. This file contains various configuration settings for your application.  You will need to configure the following:

    * **Database Credentials:**  Specify your database connection details, including the hostname, database name, username, and password.  For local development, you can use SQLite for simplicity.
    * **API Keys:** If the application uses any external APIs (e.g., payment gateways, messaging services), you'll need to provide the necessary API keys here.
    * **Other Settings:**  Other settings may include application URLs, email configurations, and other application-specific parameters.  Refer to the `.env.example` file for a complete list of variables and their descriptions.

4. **Generate application key:** Generate a unique application key for security:
   ```bash
   php artisan key:generate
   ```

5. **Run database migrations:** Apply the database migrations to create the necessary tables:
   ```bash
   php artisan migrate
   ```

6. **Start the development server:** Start the development server to run the application:
   ```bash
   npm run dev
   ```

### Production Setup

To deploy AuthMKPHP to a production environment, follow these steps:

1. **Follow steps 1-3 from the Development Setup section.**

2. **Run database migrations with seeding:** Run the database migrations and seed the database with initial data (if required):
   ```bash
   php artisan migrate:fresh
   php artisan db:seed
   ```

3. **Compile assets for production:** Compile the frontend assets for optimized performance in production:
   ```bash
   npm run build
   ```

4. **Deploy:** Deploy the application to your chosen web server.  The deployment process will vary depending on your hosting provider and infrastructure.  Consult your hosting provider's documentation for specific instructions.


## Features

AuthMKPHP offers the following features (with some still under development):

- [x] **Automated Deployment:** Automated deployment is set up using GitHub Actions.
- [ ] **Comprehensive Documentation:** Detailed documentation is planned for future releases.
- [x] **Basic CRUD Operations:** Provides basic Create, Read, Update, and Delete (CRUD) functionality for managing users and devices.
- [ ] **Telegram Chat Integration:** Integration with Telegram for notifications and communication is planned.
- [ ] **PagSeguro API Integration:** Integration with the PagSeguro payment gateway is planned.
- [ ] **Mercado Pago API Integration:** Integration with the Mercado Pago payment gateway is planned.
- [x] **Mikrotik API Integration:** Robust integration with the Mikrotik API for device management.


## Sponsors

We are actively seeking sponsors to support the continued development and improvement of AuthMKPHP.  Your contribution will help us deliver a more robust and feature-rich application.

### Partners

We welcome partnerships to collaborate on the development and expansion of AuthMKPHP. If you are interested in becoming a partner, please visit [udianix.com.br](udianix.com.br).


## Contributing

We encourage contributions to AuthMKPHP!  Please review our contribution guidelines before submitting a pull request.


## Security Vulnerabilities

If you discover a security vulnerability, please report it responsibly by creating an issue.
