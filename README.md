<div align="center">

# Box Sneakers Commerce Platform

### A custom, high-performance WooCommerce storefront built for a premium sneaker retailer.

[View Live Website](https://box-sneakers.com/)

</div>

---

![Box Sneakers Desktop Experience](assets/screenshots/desktop-dark-hero.png)

## Project Overview

Box Sneakers is a production eCommerce platform designed for a sneaker and streetwear retailer operating in the Egyptian market.

The project involved rebuilding the customer-facing storefront with a custom WordPress and WooCommerce architecture focused on performance, maintainability, responsive behavior, and a premium shopping experience.

The platform supports coordinated dark and light visual modes and delivers tailored shopping experiences across desktop and mobile devices.

This repository documents the engineering architecture, implementation approach, infrastructure decisions, and selected sanitized code examples behind the project.

---

## Business Challenge

The store needed more than a visual redesign.

The new platform had to:

- Deliver a distinctive premium brand experience.
- Perform reliably with a large product catalog and thousands of historical orders.
- Provide a smooth mobile-first shopping journey.
- Replace generic theme behavior with purpose-built WooCommerce components.
- Remain manageable for the internal operations team.
- Support future integrations and business automation.
- Run efficiently on production infrastructure.
- Improve maintainability compared with page-builder-heavy implementations.
- Keep frontend assets modular and production-ready.

---

## The Solution

A custom WooCommerce storefront was engineered around reusable components, a modular theme architecture, and production-focused infrastructure.

The solution included:

- A fully custom WordPress theme.
- Custom WooCommerce layouts and components.
- Responsive desktop and mobile interfaces.
- Dark and light display modes.
- Custom navigation and mobile bottom navigation.
- Product discovery sections for arrivals, collections, brands, and best sellers.
- Wishlist, cart, account, and search experiences.
- Reusable template parts and UI components.
- Conditional frontend asset loading.
- Performance-focused infrastructure and caching.
- Production deployment and server optimization.
- Security hardening and backup procedures.
- Git-based development and release workflow.

---

## Engineering Highlights

- Custom WooCommerce theme architecture
- Mobile-first responsive implementation
- Dark and light storefront modes
- Reusable UI component system
- Modular PHP architecture
- Custom product cards and merchandising sections
- Optimized product listing experiences
- Conditional CSS and JavaScript loading
- File modification-based asset versioning
- Redis object caching
- PHP OPcache configuration
- Nginx and PHP-FPM optimization
- MySQL-backed WooCommerce data layer
- Modular CSS and JavaScript structure
- Production deployment on Ubuntu
- Security hardening and backup workflows
- Git-based development workflow
- WP-CLI-based administration
- Separation of presentation and business logic

---

## Core Experiences

### Product Discovery

The homepage presents multiple discovery paths, including:

- New arrivals
- Best sellers
- Collections
- Product categories
- Brand-based navigation
- Promotional sections
- Curated merchandising blocks

These sections are built as reusable theme components rather than static page-builder elements.

### Responsive Commerce

The mobile interface was designed as a dedicated shopping experience rather than a reduced version of the desktop website.

It includes:

- Mobile search
- Category shortcuts
- Fixed bottom navigation
- Wishlist and cart access
- Mobile-optimized promotional sections
- Touch-friendly product browsing
- Responsive product cards
- Mobile-specific interaction patterns

### Theme Modes

The platform provides coordinated dark and light modes while maintaining the Box Sneakers brand colors and visual identity.

The theme mode implementation affects:

- Navigation
- Background surfaces
- Product cards
- Typography
- Buttons
- Icons
- Promotional sections
- WooCommerce components

### Trust and Conversion

Key customer assurances are displayed directly within the shopping journey:

- Product warranty
- Return and exchange policy
- Flexible payment options
- Fast delivery
- WhatsApp customer support

These trust elements are positioned within relevant commerce flows rather than isolated on a separate information page.

---

## Theme Architecture

```text
box-store/
│
├── assets/
│   ├── css/
│   │   ├── base/
│   │   ├── components/
│   │   ├── layout/
│   │   ├── pages/
│   │   ├── utilities/
│   │   ├── woocommerce/
│   │   └── app.css
│   │
│   ├── js/
│   ├── fonts/
│   └── images/
│
├── inc/
│   ├── setup.php
│   ├── assets.php
│   ├── cleanup.php
│   ├── helpers.php
│   ├── image-sizes.php
│   ├── menus.php
│   ├── performance.php
│   ├── security.php
│   ├── widgets.php
│   └── woocommerce.php
│
├── template-parts/
│   ├── components/
│   ├── footer/
│   ├── header/
│   ├── home/
│   └── sections/
│
├── templates/
│
├── woocommerce/
│
├── functions.php
├── header.php
├── footer.php
├── index.php
└── style.css
```

The architecture separates configuration, assets, WooCommerce customizations, reusable components, and page templates into focused modules.

---

## Theme Bootstrap

The main theme bootstrap loads individual modules from the `inc/` directory.

```php
$modules = [
    'setup',
    'assets',
    'helpers',
    'performance',
    'security',
    'woocommerce',
];

foreach ($modules as $module) {
    $file = get_template_directory() . "/inc/{$module}.php";

    if (file_exists($file)) {
        require_once $file;
    }
}
```

This approach keeps `functions.php` small and makes individual responsibilities easier to maintain.

A sanitized version is included in:

```text
examples/01-theme-bootstrap.php
```

---

## Conditional Asset Loading

Frontend assets are loaded according to page context instead of loading every stylesheet and script globally.

Examples include:

- Product page assets
- Shop and category assets
- Cart and checkout assets
- Homepage assets
- Mobile-specific interactions
- Shared global assets

This reduces unnecessary frontend work and keeps page payloads more focused.

A simplified example is included in:

```text
examples/02-conditional-assets.php
```

---

## Asset Versioning

Static assets use file modification timestamps for versioning.

```php
function box_asset(string $relative_path): string
{
    $path = get_template_directory() . '/assets/' . ltrim($relative_path, '/');

    if (! file_exists($path)) {
        return '';
    }

    return add_query_arg(
        'ver',
        filemtime($path),
        get_template_directory_uri() . '/assets/' . ltrim($relative_path, '/')
    );
}
```

This allows browsers and caches to receive updated asset URLs after deployment without manually changing version numbers.

A sanitized version is included in:

```text
examples/05-helper-functions.php
```

---

## Performance Strategy

Performance was treated as an architectural requirement rather than a final optimization step.

The strategy includes:

- Conditional asset loading
- Versioned static assets
- Redis object caching
- PHP OPcache
- Optimized WooCommerce templates
- Modular CSS loading
- Reduced unnecessary frontend requests
- Nginx configuration
- PHP-FPM tuning
- Database-backed WooCommerce caching
- Removal of unnecessary WordPress output
- Controlled image sizing
- Lightweight reusable templates
- Avoidance of excessive page-builder dependencies

---

## WordPress Performance Cleanup

Selected WordPress features and output can be removed where they are not required.

Examples include:

- WordPress generator metadata
- Emoji-related assets
- Legacy manifest links
- Unused editor functionality
- Unnecessary frontend resources

A simplified example is included in:

```text
examples/03-performance.php
```

---

## Security Approach

The project applies security controls at both application and infrastructure levels.

Application-level practices include:

- Direct file-access protection
- WordPress file editor restrictions
- Input validation
- Output escaping
- Nonce verification for state-changing actions
- Controlled WooCommerce hooks
- Reduced unnecessary WordPress metadata
- No credentials committed to Git

Infrastructure-level practices include:

- Nginx configuration
- Firewall rules
- Fail2ban
- File-permission controls
- Regular backups
- Restricted administrative access
- HTTPS
- PHP configuration hardening
- Database backup procedures

A simplified application hardening example is included in:

```text
examples/04-security.php
```

---

## WooCommerce Customization

The storefront replaces selected default WooCommerce presentation layers with custom implementations.

Customized areas include:

- Product cards
- Product archives
- Shop layouts
- Single-product presentation
- Cart experience
- Quantity controls
- Account navigation
- Search behavior
- Category browsing
- Product variation presentation
- Promotional merchandising sections

Production WooCommerce templates and business-specific logic are intentionally excluded from this repository.

---

## Reusable Component System

The theme uses reusable components for repeated storefront elements.

Examples include:

- Product cards
- Section headers
- Promotional banners
- Brand cards
- Category cards
- Trust blocks
- Navigation elements
- Product sliders
- Mobile navigation
- Empty states
- WooCommerce notices

This reduces duplication and keeps visual behavior consistent across the storefront.

---

## CSS Architecture

The stylesheet structure separates responsibilities into focused layers.

```text
assets/css/
│
├── base/
│   ├── reset.css
│   ├── variables.css
│   └── typography.css
│
├── layout/
│   ├── grid.css
│   ├── header.css
│   └── footer.css
│
├── components/
│   ├── buttons.css
│   ├── cards.css
│   ├── navigation.css
│   └── sections.css
│
├── pages/
│   ├── home.css
│   ├── shop.css
│   └── product.css
│
├── woocommerce/
│   ├── cart.css
│   ├── checkout.css
│   └── account.css
│
├── utilities/
│   └── helpers.css
│
└── app.css
```

This makes the frontend easier to navigate, debug, extend, and optimize.

---

## Mobile-First Design

Mobile behavior was considered independently rather than added after the desktop design.

Key decisions include:

- Dedicated bottom navigation
- Touch-friendly interaction sizes
- Responsive product grids
- Mobile-specific spacing
- Simplified navigation
- Accessible search and cart controls
- Reduced visual clutter
- Optimized promotional layouts
- Product information prioritization

---

## Technology Stack

| Layer | Technologies |
|---|---|
| Commerce | WordPress, WooCommerce |
| Backend | PHP, WooCommerce APIs |
| Frontend | HTML5, CSS3, JavaScript |
| Database | MySQL |
| Cache | Redis Object Cache, PHP OPcache |
| Web Server | Nginx, PHP-FPM |
| Infrastructure | Ubuntu VPS |
| Administration | WordPress Admin, WP-CLI |
| Version Control | Git, GitHub |
| Deployment | Linux command line, Git workflow |

---

## System Architecture

```text
Customers
   │
   ├── Desktop Experience
   └── Mobile Experience
            │
            ▼
Custom WordPress Theme
            │
            ├── Reusable UI Components
            ├── Custom WooCommerce Templates
            ├── Product Discovery
            ├── Wishlist / Cart / Account
            ├── Search and Navigation
            └── Dark / Light Modes
            │
            ▼
WooCommerce Business Layer
            │
            ├── Products and Variations
            ├── Orders
            ├── Customers
            ├── Payments
            └── Inventory
            │
            ▼
WordPress Application Layer
            │
            ├── Custom Theme Modules
            ├── Plugins and Integrations
            ├── Scheduled Actions
            └── Administrative Workflows
            │
            ▼
Redis Cache ── MySQL ── PHP OPcache
            │
            ▼
Nginx + PHP-FPM on Ubuntu
```

---

## Production Infrastructure

The platform runs on a production Ubuntu VPS configured for WooCommerce workloads.

The stack includes:

- Ubuntu Linux
- Nginx
- PHP-FPM
- MySQL
- Redis
- PHP OPcache
- WP-CLI
- Git
- Firewall rules
- Fail2ban
- Scheduled backups

The infrastructure was configured to support a large catalog, historical order data, administrative operations, and future growth.

---

## Deployment Workflow

The project follows a Git-based workflow.

```text
Local Development
        │
        ▼
Code Review and Testing
        │
        ▼
Git Commit
        │
        ▼
Production Deployment
        │
        ▼
Cache Invalidation
        │
        ▼
Verification
```

Production deployments include validation of:

- PHP syntax
- Theme activation
- WooCommerce templates
- Responsive behavior
- Cache behavior
- Asset loading
- Critical commerce flows

---

## Engineering Examples

The `examples/` directory contains simplified implementations extracted from the production BOX Sneakers theme.

```text
examples/
│
├── README.md
├── 01-theme-bootstrap.php
├── 02-conditional-assets.php
├── 03-performance.php
├── 04-security.php
└── 05-helper-functions.php
```

Included examples demonstrate:

- Theme module loading
- Conditional asset loading
- Static asset versioning
- WordPress performance cleanup
- Basic security hardening
- Reusable helper functions

These examples use the Box project naming to clearly connect them to the real implementation while excluding customer-specific templates and confidential business logic.

---

## Development Principles

The project follows several engineering principles:

- Modular architecture
- Separation of concerns
- Reusable components
- Maintainable code
- Mobile-first design
- Production-focused performance
- Secure deployment practices
- Controlled WooCommerce customization
- Minimal dependence on generic page builders
- Clear boundaries between presentation and business logic

---

## Business Outcomes

The rebuilt platform provides:

- A stronger premium brand experience
- Faster and more focused frontend delivery
- Better mobile usability
- Greater control over WooCommerce presentation
- Reduced dependence on generic themes
- Easier long-term maintenance
- A reusable architecture for future features
- Better infrastructure visibility
- Improved production stability
- A stronger foundation for integrations and automation

---

## Screenshots

Additional screenshots can be added under:

```text
assets/screenshots/
```

Suggested screenshots:

- Desktop dark-mode homepage
- Desktop light-mode homepage
- Mobile homepage
- Mobile navigation
- Product archive
- Product details page
- Cart experience
- Search experience

---

## Repository Scope

This repository is a case study and engineering showcase.

It includes:

- Project documentation
- Architecture diagrams
- Selected screenshots
- Sanitized implementation examples
- Technology and infrastructure overview

It does not contain the complete production theme.

---

## Confidentiality

This repository documents the engineering architecture behind the project.

Production source code, client assets, proprietary business logic, credentials, customer information, database data, and sensitive operational details have been intentionally excluded.

Only simplified engineering examples are included for demonstration purposes.

See `NOTICE.md` for additional information.

---

<div align="center">

Engineered by **SlantFlow**

### Building software that moves businesses forward.

</div>
