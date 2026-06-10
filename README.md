# DMRF — Develop Manager Registration Form

A simple PHP/MySQL demo for manager registration that stores basic manager details and a photo upload. This project is intended as a small CRUD example using plain PHP and MySQL (suitable for learning or quick prototyping).

## Features
- Register a manager with: Manager ID, Name, Father Name, Date of Birth, Photo
- File upload support (stores files to `uploads/`)
- Simple form validation (client-side) in `form.php`

## Prerequisites
- macOS / Windows / Linux with PHP (>=7.0) and MySQL
- XAMPP (recommended) or separate Apache+PHP+MySQL stack
- A web server document root containing this project (example: XAMPP `htdocs`)

## Project Structure
- [form.php](form.php) — registration form and insert logic
- [display.php](display.php) — (expected) display/listing of entries
- [update.php](update.php) — (expected) update logic
- [delete.php](delete.php) — (expected) delete logic
- [includes/connection.php](includes/connection.php) — database connection (configure DB credentials here)
- uploads/ — directory to store uploaded photos (must be writable by the webserver)
- assets/style.css — project styles

> Note: Only `form.php` is included in the attachments. The other files are referenced by name in the repo and are expected to exist in the project root.

## Quick Setup (XAMPP)
1. Install XAMPP and start Apache and MySQL.
2. Place the project folder in XAMPP's `htdocs` (example: `/Applications/XAMPP/xamppfiles/htdocs/DMRF`).
3. Ensure `uploads/` is writable by the webserver:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/DMRF
chmod 755 uploads
# if needed:
chmod 775 uploads
```

## Database Setup
1. Open phpMyAdmin or connect via MySQL CLI and create a database (example: `dmrf`):

```sql
CREATE DATABASE pk CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE pk;

CREATE TABLE form (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mid VARCHAR(50) NOT NULL,
  name VARCHAR(100) NOT NULL,
  fname VARCHAR(100) NOT NULL,
  dob DATE NOT NULL,
  photo VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

2. Update `includes/connection.php` with your DB credentials. A minimal example for `includes/connection.php`:

```php
<?php
$host = '127.0.0.1';
$user = 'root';
$pass = ''; // XAMPP default on macOS/Windows
$db   = 'pk';

$conn = mysqli_connect($host, $user, $pass, $db);
if(!$conn) {
    die('Connection error: ' . mysqli_connect_error());
}
?>
```

## How to Run
1. Install XAMPP on your system.
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Copy the project folder (DMRF) into the XAMPP htdocs directory:
```
C:\xampp\htdocs\DMRF
```
4. Open phpMyAdmin and create the required database.
```
http://localhost/phpmyadmin
```
5. Import the provided SQL file (if available) or create the required table structure manually.
6. Open a web browser and navigate to:
```
http://localhost/DMRF/form.php
```
7. Fill out the Manager Registration Form and submit the details.
8. Registered managers can be viewed, updated, and deleted from the display page.


## Important Implementation Notes
- The current `form.php` performs a file upload using `move_uploaded_file()` to the `uploads/` folder and inserts filenames into the DB.
- The SQL in `form.php` inserts into table `form` with columns `(mid,name,fname,dob,photo)`. The README's example `CREATE TABLE` follows that schema plus a primary `id` and `created_at`.

## Security & Hardening Recommendations
1. Use prepared statements (mysqli or PDO) to prevent SQL injection instead of interpolating `$_POST` values directly into SQL.
2. Perform server-side validation for all inputs (type, lengths, allowed characters).
3. For file uploads:
   - Restrict allowed MIME types (e.g., jpeg, png) and check actual file content.
   - Limit file size.
   - Generate safe, unique filenames (don't use user-supplied names directly).
   - Store uploads outside the webroot or restrict execution with `.htaccess` (deny `php`, etc.) in `uploads/`.
4. Escape output when displaying data in HTML to prevent XSS.
5. Enforce HTTPS in production environments.
