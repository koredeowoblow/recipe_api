
# Recipe API

A RESTful API for managing recipes, built with Laravel, a PHP framework for web artisans.

## Features

- **User Authentication**: Secure login and registration using Laravel's built-in authentication system.
- **Recipe Management**: Create, read, update, and delete recipes, including details like title, ingredients, and instructions.
- **Category Assignment**: Organize recipes into categories for better organization.
- **Image Upload**: Attach images to recipes for enhanced visual appeal.
- **Search Functionality**: Search recipes by title, ingredient, or category.

## Project Structure

The project follows Laravel's standard directory structure:
```
recipe_api/
├── app/           # Core application logic
│   ├── Console/   # Artisan commands
│   ├── Events/    # Event handling
│   ├── Exceptions/ # Error handling
│   ├── Http/      # Controllers, middleware, requests
│   ├── Models/    # Eloquent models
│   ├── Providers/  # Service providers
│   └── Services/   # Business logic
├── bootstrap/    # Application bootstrap files
│   └── cache/     # Cached files
├── config/        # Configuration files
├── database/      # Database migrations, factories, seeds
│   ├── factories/  # Model factories
│   ├── migrations/ # Database migrations
│   └── seeds/      # Database seeds
├── public/        # Publicly accessible files (e.g., index.php, assets)
├── resources/     # Views and raw assets
│   ├── lang/      # Localization files
│   ├── views/     # Blade templates
│   └── assets/    # Raw assets (e.g., Sass, JavaScript)
├── routes/        # API and web routes
│   ├── api.php    # API routes
│   └── web.php    # Web routes
├── storage/       # Logs, cache, and file storage
│   ├── app/       # Application storage
│   ├── framework/ # Framework-generated files
│   └── logs/      # Log files
├── tests/          # Automated tests
│   ├── Feature/   # Feature tests
│   └── Unit/      # Unit tests
├── .editorconfig   # Editor configuration
├── .env.example    # Environment configuration example
├── .gitattributes  # Git attributes
├── .gitignore      # Git ignore rules
├── artisan        # Command-line interface for Laravel
├── composer.json   # PHP dependencies and autoloading
├── composer.lock   # Locked PHP dependencies
├── package.json    # Node.js dependencies
├── phpunit.xml     # PHPUnit configuration
└── README.md      # Project documentation
```


## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/koredeowoblow/recipe_api.git
   ```

2. **Navigate to the Project Directory**:
   ```bash
   cd recipe_api
   ```

3. **Install PHP Dependencies**:
   Ensure you have [Composer](https://getcomposer.org/) installed, then run:
   ```bash
   composer install
   ```

4. **Set Up Environment File**:
   Copy the example environment file and edit it with your database and other configurations:
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**:
   This sets the `APP_KEY` in your `.env` file:
   ```bash
   php artisan key:generate
   ```

6. **Set Up Database**:
   - Create a new database in your preferred database management system.
   - Update the `.env` file with your database connection details.
   - Run the migrations to set up the database tables:
     ```bash
     php artisan migrate
     ```

7. **Seed the Database (Optional)**:
   Populate the database with sample data:
   ```bash
   php artisan db:seed
   ```

8. **Set Directory Permissions**:
   Ensure the storage and bootstrap/cache directories are writable:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

9. **Serve the Application**:
   Start the development server:
   ```bash
   php artisan serve
   ```
   Access the API at `http://localhost:8000`.

## Usage

- **Authentication**: Register and log in users to manage personal recipes.
- **Recipe Endpoints**:
  - `GET /api/recipes`: Retrieve all recipes.
  - `POST /api/recipes`: Create a new recipe.
  - `GET /api/recipes/{id}`: Retrieve a specific recipe by ID.
  - `PUT /api/recipes/{id}`: Update a recipe by ID.
  - `DELETE /api/recipes/{id}`: Delete a recipe by ID.
- **Category Endpoints**:
  - `GET /api/categories`: Retrieve all categories.
  - `POST /api/categories`: Create a new category.
  - `GET /api/categories/{id}`: Retrieve a specific category by ID.
  - `PUT /api/categories/{id}`: Update a category by ID.
  - `DELETE /api/categories/{id}`: Delete a category by ID.
- **Image Upload**: Use multipart form-data to upload images when creating or updating recipes.
- **Search**: Use query parameters to search recipes, e.g., `GET /api/recipes?search=ingredient_name`.

## Testing

Feature and unit tests are located in the `tests` directory. To run the tests, use:
```bash
php artisan test
```

## Contributing

Contributions are welcome! Please follow these steps: 
