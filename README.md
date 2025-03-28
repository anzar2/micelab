
# Micelab

**Micelab** is an open-source platform designed for managing and testing software development projects. Built with Laravel 12, so it uses PHP.

Initially created for game development testing, Micelab is also suitable for software projects in general. Feel free to use it for yourself or your team.

If you want to collaborate on this project, feel free to message me on GitHub.

## Features
- Manage projects, with their modules and tasks.
- Manage users, with roles and permissions.
- Manage project requirements (user stories) and their status.
- Manage test cases for each requirement.
- Manage bugs and their status.
- Comments for tasks, test cases, and bugs.

For more details, visit the [wiki](https://github.com/anzar2/micelab/wiki).

## Installation

### Prerequisites
Ensure that your server has the following installed:
- PHP 8.2 or higher.
- PHP extensions:
    - OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, Fileinfo.

### Download the Latest Release
Download the [latest release](https://github.com/anzar2/micelab/releases) from GitHub. This release includes the **node_modules** and **vendor** folders, so it's a "plug and play" installation.

1. Once downloaded, run the following command to start the installation:

   ```bash
   ./mlab install
   ```

2. Follow the on-screen instructions to complete the setup.

3. Start using the app.

> **Note**: In the future, a web installer may be added to make the process even easier.

## Development Setup
 > **Requires <code>composer</code> and <code>npm</code>**

### Method 1: Fast setup with Console Installer
1. Install dependencies:

    ```bash
    composer install && npm install
    ```

1. Run the following command:

   ```bash
   ./mlab install
   ```

2. Follow the instructions to complete the installation.

> For more details on the console installer, visit the [repository](https://github.com/anzar2/mlab-cli).

### Method 2: Manual Installation
If you prefer more control or if the installer doesn't work, follow these steps:

1. Install the Composer and nodejs dependencies:

   ```bash
   composer install && npm install
   ```

2. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

3. Set up the database and update the `.env` file with your database credentials.

   > **By default, the `EXAMPLE_INSERT` variable is set to `true`**. If you don't want example data inserted, change it to `false`.

4. Generate the key, migrations, and seeders:

   ```bash
   php artisan key:generate && php artisan migrate && php artisan db:seed
   ```

5. Create an admin user:

   ```bash
   php artisan app:create-admin "<your_display_name>" "<your_email>" "<your_password>" "<your_username>"
   ```

   > **You can log in using either your username or email.**

6. Start development server:
    ```bash
    composer run dev
    ```

> **Report any issue 🚬**

## License
See the [LICENSE](LICENSE) file for details.
