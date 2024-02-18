# Broobe PHP Challenge Project: Laravel 10 with PHP 8.1

Welcome to my Broobe PHP Challenge project, developed using Laravel 10 and PHP 8.1. This project showcases my skills in building a dynamic web application with modern web technologies.

## Key Features & Technologies Used

- **Laravel 10 Framework:** Leveraging the power of Laravel 10 to build robust and scalable web applications with ease, utilizing features such as routing, controllers, and Eloquent ORM.
- **PHP 8.1:** Utilizing the latest features and enhancements of PHP 8.1 for efficient and modern server-side scripting.
- **AJAX Integration:** Implementing AJAX (Asynchronous JavaScript and XML) to enable seamless communication between the client and server, enhancing user interactivity and responsiveness.
- **HTML5 and CSS3 Styling:** Employing HTML5 and CSS3 to create a visually appealing and user-friendly interface, utilizing modern design techniques and best practices.

## Usage

1. Clone the repository to your local machine: 
  git clone https://github.com/Hernan-90/BroobeChallenge.git

2. Move into the folder BroobeChallenget: 
  cd BroobeChallenge

3. Create vendor folder and install project dependencies: 
  composer install

4. Create a new .env file using .env.example as template: 
  cp .env.example .env

5. Create a new SQL database using MySQL Workbench, DBeaver, or any other database management tool: 
  CREATE SCHEMA table_name

6. Configure your database credentials in the .env file and complete 'URL' and 'KEY' variables.

7. Clear the cached configuration for the new .env file: 
  php artisan config:clear

8. Run migrations to create tables and the seeders to populate them: 
  php artisan migrate --seed

9. Start the development server to run the project locally:
  php artisan serve