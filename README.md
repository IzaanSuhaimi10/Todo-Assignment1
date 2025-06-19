Laravel To-Do App – Input Validation and Profile Page

This project is an enhanced Laravel-based To-Do Application for the Web App Security assignment. It improves user authentication and introduces a complete profile management feature using the MVC pattern.

---

## 🔐 Security Enhancements

### ✅ Register & Login Pages
- Implemented **Laravel Form Request** validation
- Restricted name field input using **regex whitelist** (`^[a-zA-Z\s]+$`)
- Added validation feedback with **Bootstrap alerts**
- Improved protection against invalid input and script injection

---

## 👤 User Profile Page

New feature at `/profile`:
- Users can:
  - Edit **nickname**, **email**, **phone**, **city**, **password**
  - Upload a profile picture (**avatar**)
  - **Delete their account** securely
- Fully protected by `auth` middleware

---

## 🧱 MVC Breakdown

| Component       | Changes Made                                                             |
|----------------|---------------------------------------------------------------------------|
| **Model**       | `User.php` now includes `nickname`, `avatar`, `phone`, `city`            |
| **Views**       | Modified `register`, `login`, and `layouts`; Added `profile/edit.blade.php` |
| **Controllers** | `RegisterController` & `LoginController` updated; New `ProfileController` created |
| **Requests**    | New `RegisterRequest`, `LoginRequest`, and `UpdateProfileRequest` added  |

---

## 📂 Key Files Modified or Added

- `app/Http/Controllers/Auth/RegisterController.php`
- `app/Http/Controllers/Auth/LoginController.php`
- `app/Http/Controllers/ProfileController.php`
- `app/Http/Requests/RegisterRequest.php`
- `app/Http/Requests/LoginRequest.php`
- `app/Http/Requests/UpdateProfileRequest.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/profile/edit.blade.php`
- `routes/web.php`
- `database/migrations/*_add_profile_fields_to_users_table.php`

---
# Laravel To-Do App – Authentication Enhancements

This project extends the Laravel To-Do App with robust authentication security improvements as part of the Web App Security assignment. The enhancements include Multi-Factor Authentication (MFA), password salting, secure password hashing, and login rate limiting using Laravel Fortify and RateLimiter.

---

## 🔐 Authentication Enhancements Overview

### ✅ Multi-Factor Authentication (MFA)
- Integrated **Laravel Fortify** for 2FA setup
- Verification code sent via email using a custom Mailable
- 2FA code expires after 10 minutes and regenerates securely
- Protects access by requiring a valid 6-digit code after login

### 🔒 Password Salting
- Added a `salt` field to the `users` table
- During registration, each user is assigned a unique 16-character salt
- Password is hashed using: `Hash::make(password + salt)`
- On login, validation uses: `Hash::check(input + salt, stored_hash)`

### 🧂 Strong Hashing Algorithm
- Utilized **bcrypt** (Laravel's default hashing driver)
- No config change needed; compatible with Laravel’s `Hash::make()`

### 🛡️ Rate Limiting
- Used Laravel’s built-in **RateLimiter** class
- Limited login attempts to **3 per minute**
- Applied per email and IP combination
- Displays remaining seconds until user can retry

---

## 🧱 MVC Breakdown

| Component    | Changes Made |
|--------------|--------------|
| **Model**    | `User.php` includes `salt` column and 2FA helper methods |
| **Views**    | `login.blade.php`, `register.blade.php`, `verify-2fa.blade.php` created or updated |
| **Controllers** | `LoginController` modified to handle salt + rate limit + MFA |
| **Mailables**  | New `TwoFactorCodeMail` class created |
| **Migration**  | Added `salt` column to `users` table |
| **Service Providers** | `FortifyServiceProvider` configured for 2FA + RateLimiter |

---

## 📂 Key Files Modified or Added

- `app/Http/Controllers/Auth/LoginController.php`
- `app/Http/Controllers/Auth/RegisterController.php`
- `app/Http/Controllers/Auth/TwoFactorController.php`
- `app/Mail/TwoFactorCodeMail.php`
- `app/Models/User.php`
- `app/Providers/FortifyServiceProvider.php`
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/verify-2fa.blade.php`
- `routes/web.php`
- `database/migrations/*_add_salt_to_users_table.php`

---
# Laravel To-Do App – Authorization

This final security enhancement implements Role-Based Access Control (RBAC) to restrict access and functionality based on user roles and defined permissions. It ensures users can only access the UI features and routes they’re authorized to use.

---

## 🧑‍💼 Roles and Permissions

Two user roles were introduced:

| Role   | Permissions                        |
|--------|------------------------------------|
| Admin  | Create, Retrieve, Update, Delete   |
| User   | Create, Retrieve                   |

These roles are stored in the `user_roles` table, and their allowed actions are defined in the `role_permissions` table.

---

## 🔐 Features Implemented 

- Created `user_roles` and `role_permissions` migration and model files
- Used Tinker and Seeder to assign:
  - `admin@example.com` → Admin
  - `user@example.com` → User
- Built `CheckUserRole` middleware to restrict access to role-specific routes (e.g. `/admin`)
- Restricted To-Do list buttons based on permissions:
  - ✅ **Create** → Show "Add new todo" button
  - ✅ **Update** → Show "Edit" button
  - ✅ **Delete** → Show "Delete" button
- Role-based UI enforcement in `list.blade.php`
- Admin has full access, while User has limited access
- Middleware successfully redirects unauthorized users

---

## 📂 Key Files Modified or Added

- `app/Models/UserRole.php`
- `app/Models/RolePermission.php`
- `app/Http/Middleware/CheckUserRole.php`
- `app/Http/Controllers/AdminController.php`
- `resources/views/todo/list.blade.php`
- `database/seeders/RoleAndPermissionSeeder.php`
- `routes/web.php`

---

## 🧪 Testing Access

### ✅ Admin Login
- **Email:** `admin@example.com`
- **Password:** `password`
- Full access to To-Do list actions and Admin dashboard

### ✅ User Login
- **Email:** `user@example.com`
- **Password:** `password`
- Can only add and view todos (edit and delete hidden)

### 🔐 Route Protection
- `/admin` is accessible to Admin only
- Users without sufficient permission are redirected

---

