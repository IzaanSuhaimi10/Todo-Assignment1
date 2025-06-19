# Laravel To-Do App – Input Validation and Profile Page

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

