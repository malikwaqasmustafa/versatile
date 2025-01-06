```markdown
# 🌟 Versatile PHP Framework

Versatile PHP Framework is a lightweight, highly flexible, and beginner-friendly
PHP MVC framework built for speed, simplicity, and scalability. Whether you're
building small projects or scaling up to larger applications, Versatile PHP
provides the perfect foundation to create robust web solutions.


 🚀 Why Choose Versatile PHP?

1. Lightweight and Efficient:
   - No unnecessary bloat. Focus on performance and simplicity.

2. Beginner-Friendly:
   - Clean architecture with intuitive Models, Views, and Controllers (MVC).

3. Dynamic ORM with Query Builder:
   - Write readable and powerful database queries without raw SQL.

4. CSRF Protection and Secure Helpers:
   - Built-in tools for secure and seamless development.

5. Extensible and Customizable:
   - Easily integrate libraries or extend functionality for your needs.


 🌟 Features

 ⚙️ Modern MVC Architecture
- Clean separation of concerns with Models, Views, and Controllers.
- Encourages maintainable and scalable development practices.

 🛠️ Dynamic Query Builder
- Intuitive ORM that supports method chaining for easy database operations.
- Examples:
  ```php
  $user = new User();

  // Fetch all users
  $users = $user->all();

  // Fetch the first user where name = 'John'
  $firstUser = $user->where('name', 'John')->first();

  // Fetch users with specific conditions
  $filteredUsers = $user->where('role', 'admin')->where('status', 'active')->all();
  ```

 🔒 Security by Default
- CSRF token generation and validation for safe form submissions.
- Helper functions to escape HTML and sanitize input.

 🚀 Built-in Developer Tools
- `dd()` for quick debugging.
- Flash messages, URL helpers, and input sanitization.

 📜 Ready-to-Use Database Example
- Included `versatile.sql` file with a sample `users` table to kickstart your project.

---

 📦 Installation

 1️⃣ Clone the Repository
```bash
git clone https://github.com/yourusername/versatile-php-framework.git
cd versatile-php-framework
```

 2️⃣ Set Up the Database
- Create a MySQL database.
- Import the `versatile.sql` file located in the project root:
  ```bash
  mysql -u your_username -p your_database < versatile.sql
  ```

 3️⃣ Configure the Framework
- Update the `config/config.php` file with your database credentials:
  ```php
  <?php
  define('DB_DSN', 'mysql:host=localhost;dbname=your_database');
  define('DB_USERNAME', 'your_username');
  define('DB_PASSWORD', 'your_password');
  ```

 4️⃣ Run the Application
- Start a local PHP server:
  ```bash
  php -S localhost:8000 -t public
  ```

 5️⃣ Access the Framework
- Open your browser and visit: [http://localhost:8000](http://localhost:8000).

---

 🛠️ Usage Examples

 1️⃣ Fetch All Users
```php
$user = new User();
$users = $user->all();
print_r($users);
```

 2️⃣ Add a New User
```php
$user = new User();
$user->save([
    'name' => 'Jane Doe',
    'email' => 'jane@example.com',
]);
```

 3️⃣ Update an Existing User
```php
$user = new User();
$user->update(1, [
    'name' => 'Jane Smith',
]);
```

 4️⃣ Delete a User
```php
$user = new User();
$user->delete(1);
```

 5️⃣ Query with Conditions
```php
$user = new User();

// Find a user by email
$userByEmail = $user->where('email', 'jane@example.com')->first();

// Find all admins
$admins = $user->where('role', 'admin')->all();
```

---

 🏗️ Directory Structure

```plaintext
project/
├── app/
│   ├── controllers/  # Application Controllers
│   ├── models/       # Application Models
│   ├── views/        # Application Views
│   └── core/         # Framework Core Files (Router, Model, Controller, etc.)
├── config/
│   └── config.php    # Database Configuration
├── public/
│   ├── index.php     # Entry Point
│   └── .htaccess     # Apache Rewrite Rules
├── versatile.sql      # Sample Database Schema
└── README.md         # Documentation
```

---

 🛡️ Security Highlights

1. CSRF Protection:
   ```php
   // Generate a CSRF token for forms
   echo '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';

   // Validate the CSRF token upon form submission
   if (!validate_csrf_token($_POST['csrf_token'])) {
       die('Invalid CSRF token.');
   }
   ```

2. HTML Escaping:
   ```php
   // Escape output to prevent XSS attacks
   echo e($user['name']);
   ```

---

 🤝 Contributing

Contributions are welcome! Here's how you can contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m 'Add your feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a pull request.

---

 📜 License

This project is licensed under the [MIT License](LICENSE).

---

 ❤️ Acknowledgments

Special thanks to the PHP community for inspiring this framework and to all contributors for their valuable support.

---

 🎉 Get Started Today!

Dive into web development with Versatile PHP Framework and experience the power of simplicity and flexibility. Clone the repo and start building amazing web applications in minutes!

Happy coding! 🚀
```
