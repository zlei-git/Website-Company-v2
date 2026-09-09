# NordicHome Furniture — Premium Scandinavian E-Commerce

A full-stack Laravel 12 application for **NordicHome Furniture**, a fictional international Scandinavian furniture company.

## Tech Stack
- **Framework**: Laravel 12 (PHP 8.2+)
- **Database**: MySQL
- **Templating**: Blade
- **Styling**: Tailwind CSS 4 (via `@tailwindcss/vite`)
- **Interactivity**: Alpine.js
- **Asset Bundling**: Vite

---

## Credentials

### Admin Account
- **URL**: `/login` (redirects to `/admin`)
- **Email**: `admin@nordichome.test`
- **Password**: `password`

### Customer Demo Account
- **URL**: `/login`
- **Email**: `customer@nordichome.test`
- **Password**: `password`

---

## Installation & Setup

1. **Clone or navigate to the project directory**:
   ```bash
   cd d:\nordichome
   ```

2. **Install Composer Dependencies**:
   ```bash
   composer install
   ```

3. **Install NPM Dependencies & Build Assets**:
   ```bash
   npm install
   npm run build
   ```

4. **Environment Configuration**:
   Ensure `.env` has the correct database configuration:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nordichome
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Create Public Storage Link**:
   ```bash
   php artisan storage:link
   ```

7. **Run Tests**:
   ```bash
   php artisan test
   ```

8. **Start the Development Server**:
   ```bash
   php artisan serve
   ```
   Open `http://localhost:8000` in your browser.

---

## Features

### Customer Website
- **Editorial Home Page**: Scandinavian aesthetics, hero banner, category showcase, brand story, newsletter signup.
- **Product Catalog**: Multi-attribute filtering (Category, Collection, Price range, In-stock status), dynamic sorting, and instant search.
- **Product Detail**: Multi-angle gallery with interactive selector, specifications, reviews, stock indicators, and related products.
- **Wishlist & Database-Backed Cart**: Add/remove, increment/decrement with stock validation, coupon code discounting.
- **Transactional Checkout**: Atomic database transaction creating order, reserving stock, recording coupon usage, and generating order numbers.
- **Customer Account**: Personal dashboard, past orders history, order tracking, address book management, profile details.
- **Inspiration Blog**: Articles on interior styling, Nordic lifestyle, craftsmanship stories.

### Admin Dashboard
- **Executive Metrics**: Total revenue, order volume, customer counts, real sales charts, low stock monitors.
- **Complete Inventory & Catalog CRUD**: Manage products, multiple photo uploads, categories, and curated collections.
- **Order Management**: Order timeline and status updates (Pending, Processing, Shipped, Completed, Cancelled).
- **Customer & Review Moderation**: Inspect customer orders, approve or delete reviews.
- **Marketing & Communication**: Coupon manager (Percentage & Fixed discount), contact message inbox, newsletter subscribers.
- **Business Reports**: Date-filtered sales and category performance.
- **Site Settings**: Contact details, social profiles, and branding.
