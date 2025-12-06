# User Authentication Synchronization - Implementation Guide

## Changes Made

### 1. Database Migration

**File:** `database/migrations/2025_12_06_120000_add_user_profile_columns.php`

Menambahkan kolom baru ke tabel `users`:

- `username` - Username unik (nullable)
- `phone` - Nomor telepon (nullable)
- `photo` - Path foto profile (nullable)
- `points` - Reward points (default: 0)
- `points_expiry` - Tanggal kadaluarsa points (nullable)
- `role` - Role user (default: 'user')

**Jalankan migration:**

```bash
php artisan migrate
```

### 2. User Model Update

**File:** `app/Models/User.php`

Menambahkan kolom baru ke `$fillable`:

- username
- phone
- photo
- points
- points_expiry
- role

### 3. UserDataTrait

**File:** `app/Http/Controllers/UserDataTrait.php`

Trait baru untuk konsistensi data user di semua controller:

- `getUserData()` - Mengambil data user untuk auto-fill form
- `isAuthenticated()` - Cek status autentikasi
- `getUserId()` - Ambil ID user
- `getUser()` - Ambil object user lengkap

### 4. ProfileController Updates

**File:** `app/Http/Controllers/ProfileController.php`

**Update Method:**

- `update()` - Sekarang benar-benar menyimpan data profile ke database

  - Update name, username, email, phone
  - Hash password jika diubah
  - Validasi unique untuk username dan email
  - Password confirmation validation

- `upload()` - Sekarang benar-benar menyimpan foto profile

  - Hapus foto lama jika ada
  - Simpan foto baru ke `public/photos/profiles/`
  - Update path di database

- `bookingsPdf()` - Mengambil semua booking data dari database (bukan dummy data)

### 5. Controller Updates dengan UserDataTrait

**Controllers yang diupdate:**

- `TripController` - Open trip checkout
- `CheckoutController` - Planning checkout
- `PackageBookingController` - Package checkout

Semua controller sekarang menggunakan `UserDataTrait` dan mengirim `$userData` ke view.

### 6. View Updates

**Views yang diupdate untuk menggunakan $userData:**

- `resources/views/opentrip/checkout.blade.php`
- `resources/views/checkout/planning.blade.php`
- `resources/views/packages/checkout.blade.php`
- `resources/views/profile.blade.php` (tambah username & password confirmation)

**Perubahan:**

- `Auth::user()->name` → `$userData['name']`
- `Auth::user()->email` → `$userData['email']`
- `Auth::user()->phone` → `$userData['phone']`

### 7. Profile View Updates

**File:** `resources/views/profile.blade.php`

**Form Edit Profile:**

- Tambah field Username
- Tambah field Password Confirmation
- Update validasi dan placeholder
- Booking history dibatasi 5 teratas
- Alert jika ada lebih dari 5 bookings
- Button download PDF untuk full history

## Benefits

### 1. Data Konsistensi

- Semua data user dari registrasi otomatis tersinkronisasi ke semua fitur
- Auto-fill form menggunakan data user yang login
- Update profile langsung tersimpan di database

### 2. User Experience

- User tidak perlu input data berulang kali
- Data konsisten di semua halaman checkout
- Profile dapat diupdate kapan saja
- Foto profile dapat diubah

### 3. Security

- Password di-hash dengan bcrypt
- Username unique validation
- Email unique validation
- Authentication check di semua protected routes

### 4. Maintainability

- UserDataTrait untuk konsistensi code
- Mudah ditambahkan ke controller baru
- Centralized user data logic

## Usage Example

### In Controller:

```php
use UserDataTrait;

public function checkout($id)
{
    // ... your code
    $userData = $this->getUserData();
    return view('checkout', compact('trip', 'userData'));
}
```

### In Blade View:

```blade
<input type="text" name="full_name"
       value="{{ old('full_name', $userData['name'] ?? '') }}">

<input type="email" name="email"
       value="{{ old('email', $userData['email'] ?? '') }}">

<input type="tel" name="phone"
       value="{{ old('phone', $userData['phone'] ?? '') }}">
```

## Next Steps

1. **Run Migration:**

   ```bash
   php artisan migrate
   ```

2. **Create Profiles Directory:**

   ```bash
   mkdir public/photos/profiles
   ```

3. **Test Features:**

   - Register new user
   - Update profile
   - Upload photo
   - Try checkout on different booking types
   - Verify auto-fill works correctly

4. **Optional Enhancements:**
   - Add image validation and compression
   - Add email verification
   - Add phone number format validation
   - Add username availability check (AJAX)
   - Add profile completion percentage

## File Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── UserDataTrait.php (NEW)
│       ├── ProfileController.php (UPDATED)
│       ├── TripController.php (UPDATED)
│       ├── CheckoutController.php (UPDATED)
│       └── PackageBookingController.php (UPDATED)
└── Models/
    └── User.php (UPDATED)

database/
└── migrations/
    └── 2025_12_06_120000_add_user_profile_columns.php (NEW)

resources/
└── views/
    ├── profile.blade.php (UPDATED)
    ├── opentrip/
    │   └── checkout.blade.php (UPDATED)
    ├── checkout/
    │   └── planning.blade.php (UPDATED)
    └── packages/
        └── checkout.blade.php (UPDATED)
```

## Testing Checklist

- [ ] Migration runs successfully
- [ ] Register new user with all fields
- [ ] Login with registered user
- [ ] Update profile (name, username, email, phone)
- [ ] Change password
- [ ] Upload profile photo
- [ ] Open trip checkout - verify auto-fill
- [ ] Planning checkout - verify auto-fill
- [ ] Package checkout - verify auto-fill
- [ ] Check booking history in profile
- [ ] Download PDF booking history
- [ ] Verify data persistence after logout/login

---

**Implementation Date:** December 6, 2025
**Status:** ✅ Complete and Ready for Testing
