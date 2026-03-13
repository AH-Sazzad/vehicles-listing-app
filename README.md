# Vehicle Listing Application

A modern vehicle marketplace platform built with Laravel 12, featuring real-time messaging, favorites, and comprehensive vehicle management.

## Features

- **Vehicle Listings** - Browse, search, and filter vehicles by category, condition, price
- **User Authentication** - Secure registration and login with Laravel Breeze
- **Real-time Messaging** - AJAX-powered chat system between buyers and sellers
- **Favorites System** - Save and manage favorite vehicle listings
- **Vehicle Management** - Create, edit, and manage vehicle listings with multiple images
- **Responsive Design** - Mobile-friendly interface with modern UI
- **Vehicle Details** - Comprehensive vehicle information with image gallery
- **User Dashboard** - Manage listings, messages, and favorites

## Tech Stack

- **Framework:** Laravel 12.54
- **PHP:** 8.2+
- **Database:** MySQL
- **Frontend:** Blade Templates, Bootstrap Icons
- **Authentication:** Laravel Breeze
- **Storage:** Local file storage for images

## Requirements

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM (for asset compilation)

## Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd vehicles-listing-app
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vehicles_listing
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
```

6. **Create storage link**
```bash
php artisan storage:link
```

7. **Compile assets**
```bash
npm run dev
```

8. **Start the server**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Database Structure

### Main Tables

- **users** - User accounts and authentication
- **vehicles_details** - Vehicle listings with specifications
- **categories** - Vehicle categories
- **images** - Vehicle images (multiple per vehicle)
- **massages_tabel** - Messaging system between users
- **favorites** - User favorite vehicles

## Key Features Explained

### Messaging System
- Real-time AJAX messaging without page reload
- Vehicle context in conversations
- Unread message tracking
- Conversation list with latest messages

### Vehicle Management
- Multiple image upload support
- Slug-based URLs for SEO
- View counter
- Featured listings
- Negotiable pricing option

### Favorites
- Quick add/remove favorites
- Dedicated favorites page
- Persistent across sessions

## Routes

### Public Routes
- `GET /` - Home page with vehicle listings
- `GET /vehicle/{slug}` - Single vehicle details

### Authenticated Routes
- `GET /dashboard` - User dashboard
- `GET /massages` - Message inbox
- `GET /massages/{user}` - Chat with specific user
- `POST /massages/send` - Send message (AJAX)
- `GET /favorite` - Favorites list
- `POST /favorite` - Add to favorites
- `DELETE /favorite/{id}` - Remove from favorites
- `POST /vehicles` - Create vehicle listing

## Models

- **User** - User authentication and profile
- **VehiclesDetail** - Vehicle listings
- **Category** - Vehicle categories
- **Image** - Vehicle images
- **Massage** - Messages between users
- **Favorite** - User favorites

## Controllers

- **HomeController** - Main listing page
- **SingelCarController** - Vehicle details
- **MassageController** - Messaging system
- **FavoriteController** - Favorites management
- **DashboardController** - User dashboard
- **CategoryController** - Category management

## Configuration

### File Upload
Images are stored in `storage/app/public/` and accessed via the public symlink.

### Pagination
Default pagination is set in controllers (typically 10-15 items per page).

## Development

### Code Style
Follow PSR-12 coding standards.

### Database Seeding
```bash
php artisan db:seed
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Security

- CSRF protection on all forms
- SQL injection prevention via Eloquent ORM
- XSS protection in Blade templates
- Password hashing with bcrypt
- File upload validation

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues and questions, please open an issue in the repository.

## Credits

Built with Laravel framework and Bootstrap Icons.
