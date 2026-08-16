---
paths:
  - 'database/seeders/**'
---

# Seeders

## Idempotent recruitment fixture data
Keep the recruitment sample data in dependency order in DatabaseSeeder. Seeders must use updateOrCreate with stable business identifiers so `php artisan db:seed` can safely be re-run without duplicating records.
