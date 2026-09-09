# Nordic Pure Nutrition and Natural Hydration - E-Commerce Platform

A full-stack Laravel 12 application for **Nordic Pure Nutrition & Natural Hydration**, a modern Scandinavian e-commerce platform offering natural mineral waters, living probiotic yogurts, organic plant milks, and active nutrition.

## Tech Stack
- **Framework**: Laravel 12 (PHP 8.2+)
- **Database**: MySQL / SQLite
- **Templating**: Blade Engine
- **Styling**: Tailwind CSS v4 (via `@tailwindcss/vite`)
- **Interactivity**: Alpine.js v3
- **Animations**: Bidirectional Scroll Reveal Observer & Micro-Interactions
- **Asset Bundling**: Vite Modern Pipeline
- **Testing**: PHPUnit 11 Automation Test Suite

---

## Default Credentials

### Admin Atelier Account
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
   git clone https://github.com/zlei-git/Website-Company-v2.git
   cd Website-Company-v2
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

### Customer Storefront
- **Glacial Spring Hero**: Aesthetic photography with high-contrast typography and instant shopping CTA.
- **Interactive Breakfast Ritual Lookbook**: Editorial Nordic breakfast setting with Alpine.js pulsing hotspot pins and quick-view product modal.
- **Four Core Nutrition Pillars**:
  1. *Waters & Natural Hydration* (AQUA Reflections, Evian Natural Mineral Water)
  2. *Essential Dairy & Probiotics* (Activia, Actimel, Oikos Probiotic Yogurt)
  3. *Plant-Based Milks & Drinks* (Alpro Oat, Almond, Coconut & Silk Soy)
  4. *Active & Specialized Nutrition* (High-protein isolates & recovery drinks)
- **Dynamic Catalog with Multi-Filtering**: Instant filter by category, price range, Nutri-Score indicator (Grade A, B, C), and sorting (Popularity, Highest Rating, Price, Newest).
- **Product Detail View**: Packshot gallery, volume dimensions, nutrition facts panel, verified reviews, and realtime stock status.
- **Wishlist & Database-Backed Cart**: Live item quantity adjustments, instant coupon code application with auto-discount deduction, and cold-chain delivery options.
- **Transactional Checkout**: Atomic DB transactions, address book selector, promo discount validation, stock deduction, and order generation.
- **Nutrition & Wellness Journal**: Editorial articles on cellular hydration, gut microbiome health, barista plant-milk recipes, and muscle recovery.
- **Customer Concierge**: Dedicated inquiry form for nutrition consultations and partnership questions.

### Admin Atelier Backoffice
- **Executive Metrics & KPIs**: Gross revenue, active order counts, inventory valuation, registered customer statistics, and sales rhythm charts.
- **Complete Inventory CRUD**: Manage products, upload high-res packshots, configure volume dimensions, pricing, and Nutri-Score tags.
- **Critical Low Stock Watchlist**: Automated visual warnings when product stock falls below safe threshold (< 5 units).
- **Order Fulfillment Lifecycle**: Status progression (Pending -> Processing -> Shipped -> Completed / Cancelled) with tracking numbers.
- **Customer Reviews Moderation**: Moderate, approve, feature, or remove product reviews.
- **Promotion & Voucher Engine**: Percentage and fixed discount coupons with minimum spend thresholds and usage limits.
- **Concierge Messages Inbox**: Review, process, and resolve customer support inquiries.

### Mobile Responsiveness (HP & Tablet)
- **Mobile-First Breakpoint System**: Optimized for smartphone viewports (< 640px), tablets (768px), and desktop (>= 1024px).
- **Off-Canvas Hamburger Drawer**: Smooth slide-out mobile navigation with backdrop blur and touch ergonomics (minimum 44x44px tap targets).
- **Fluid Typography & Zero Layout Shift**: Scalable rem typography and fixed aspect-ratio packshot containers (CLS = 0).
- **Adaptive Grid**: Seamless transition from 1 column on mobile to 2 columns on tablet and 4 columns on desktop monitors.
