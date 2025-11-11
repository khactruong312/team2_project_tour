Tour Operations - PHP + MySQL (MVC) Base
======================================

This project is an internal Tour & Operations management system base for Admin and Guides (HDV). 
It implements the main entities and workflows described in the specification:
- Users (Admin, HDV)
- Tours and tour destinations
- Bookings and booking customers
- Guides and tour_schedule
- Checkpoints (check-in/check-out)
- Departures history and expenses
- Simple reports

How to run
1. Import SQL: sql/init.sql into MySQL.
2. Update configs/env.php with DB credentials.
3. Run built-in server:
   php -S localhost:8000 -t public
4. Open http://localhost:8000

Notes
- This is a student-level base. Passwords are seeded plaintext for demo. Replace with password_hash() in production.
- Controllers are minimal; extend validation and error handling as needed.
