# Open Trip Booking Documentation

## Overview

Fitur Open Trip memungkinkan user untuk melihat dan memesan paket open trip yang tersedia. Alur lengkap dari melihat daftar trip hingga konfirmasi pembayaran telah diimplementasikan dengan UI yang konsisten dengan fitur booking lainnya (Destination, Hotel, Car, Package).

## Database Structure

### Table: `open_trip_bookings`

```sql
- id (bigint, primary key)
- user_id (foreign key -> users.id)
- trip_title (string)
- trip_location (string)
- trip_schedule (string)
- trip_price (decimal 15,2)
- full_name (string)
- phone (string)
- email (string)
- gender (enum: 'male', 'female')
- dob (date)
- address (text)
- emergency_name (string)
- emergency_phone (string)
- participants (integer)
- total_price (decimal 15,2)
- payment_method (enum: 'bank_transfer', 'qris', 'e_wallet', 'cash')
- payment_proof (string, nullable)
- status (enum: 'pending', 'confirmed', 'cancelled')
- notes (text, nullable)
- created_at, updated_at (timestamps)
```

## File Structure

### Models

- **`app/Models/OpenTripBooking.php`**: Model untuk open trip bookings dengan relasi ke User

### Controllers

- **`app/Http/Controllers/TripController.php`**:
  - `index()`: Menampilkan list open trip (di OpenTripController)
  - `show($id)`: Menampilkan detail trip
  - `checkout($id)`: Menampilkan form checkout
  - `checkoutSubmit($id)`: Proses submit booking
  - `success($bookingId)`: Menampilkan halaman sukses booking

### Views

- **`resources/views/opentrip/index.blade.php`**: Halaman list semua open trip
- **`resources/views/opentrip/show.blade.php`**: Halaman detail trip dengan tombol "Book Now"
- **`resources/views/opentrip/checkout.blade.php`**: Form checkout dengan informasi personal dan pembayaran
- **`resources/views/opentrip/success.blade.php`**: Halaman konfirmasi booking berhasil

### Migrations

- **`database/migrations/2025_12_06_120000_create_open_trip_bookings_table.php`**: Create table open_trip_bookings

### Seeders

- **`database/seeders/OpenTripBookingSeeder.php`**: Sample data untuk testing

## User Flow

### 1. Browse Open Trips

- User mengakses `/opentrip`
- Melihat list open trip yang tersedia dengan info: judul, lokasi, jadwal, harga, dan deskripsi
- Setiap card memiliki tombol "View Details"

### 2. View Trip Details

- User klik "View Details" → redirect ke `/opentrip/{id}`
- Menampilkan informasi lengkap:
  - Judul trip
  - Lokasi
  - Jadwal
  - Harga per orang
  - Deskripsi lengkap
  - What's Included (list fasilitas)
  - What to Prepare (list yang perlu dibawa)
  - Gambar trip
- Tombol "Book Now" (atau "Login to Book" jika belum login)

### 3. Checkout Process

- User klik "Book Now" → redirect ke `/opentrip/{id}/checkout` (requires auth)
- Form checkout mencakup:

#### Personal Information:

- Full Name
- Phone Number
- Email
- Gender
- Date of Birth
- Address
- Number of Participants (menghitung total otomatis)

#### Emergency Contact:

- Emergency Contact Name
- Emergency Contact Phone
- Special Notes (optional)

#### Payment Information:

- Payment Method (Bank Transfer, QRIS, E-Wallet, Cash)
- Payment Proof Upload (JPG, PNG, PDF max 5MB)
- Payment Instructions (nomor rekening, total amount)

### 4. Booking Confirmation

- Setelah submit → redirect ke `/opentrip/{bookingId}/success`
- Menampilkan:
  - Booking ID
  - Trip details
  - Personal information
  - Payment information
  - Total price
  - Status (Pending)
  - What's Next instructions
  - Tombol "View My Bookings" dan "Back to Open Trips"
  - Link ke Gallery untuk share pengalaman

### 5. View Booking History

- User dapat melihat semua booking di halaman Profile
- Profile menampilkan bookings dari semua tipe (Open Trip, Destination, Hotel, Car, Package)
- Informasi ditampilkan: type, title, location, date, status, price

## Routes

```php
// Open Trip Routes
Route::get('/opentrip', [OpenTripController::class, 'index'])->name('opentrip.index');
Route::get('/opentrip/{id}', [TripController::class, 'show'])->name('opentrip.show');
Route::get('/opentrip/{id}/checkout', [TripController::class, 'checkout'])->name('opentrip.checkout')->middleware('auth');
Route::post('/opentrip/{id}/checkout', [TripController::class, 'checkoutSubmit'])->name('opentrip.checkout.submit')->middleware('auth');
Route::get('/opentrip/{bookingId}/success', [TripController::class, 'success'])->name('opentrip.success')->middleware('auth');

// Legacy routes (for backward compatibility)
Route::get('/opentrip/{id}/register', [TripController::class, 'register'])->name('opentrip.register');
Route::post('/opentrip/{id}/register', [TripController::class, 'registerSubmit'])->name('opentrip.register.submit');
```

## Features

### 1. Authentication Check

- User harus login untuk melakukan booking
- Jika belum login, tombol akan mengarah ke halaman login

### 2. Dynamic Price Calculation

- Total price dihitung otomatis: `trip_price × participants`
- JavaScript real-time update di form checkout

### 3. Payment Proof Upload

- Support format: JPG, JPEG, PNG, PDF
- Max size: 5MB
- File disimpan di `storage/app/public/payment_proofs/`

### 4. Status Management

- **Pending**: Booking baru dibuat, menunggu verifikasi
- **Confirmed**: Pembayaran terverifikasi
- **Cancelled**: Booking dibatalkan

### 5. Emergency Contact

- Mandatory untuk keamanan peserta trip
- Akan dihubungi jika terjadi emergency

### 6. Special Notes

- Optional field untuk request khusus (diet, alergi, dll)

### 7. Booking History Integration

- Terintegrasi dengan Profile page
- Menampilkan semua tipe booking dalam satu view
- Sorting by date (terbaru dulu)

## UI Design Consistency

Form checkout dan success page mengikuti design pattern yang sama dengan:

- ✅ Destination Booking
- ✅ Hotel Booking
- ✅ Car Booking
- ✅ Package Booking
- ✅ Planning Booking

### Design Elements:

- Bootstrap 5 components
- Card-based layout
- Primary color scheme (#007bff)
- Icons dari Bootstrap Icons
- Responsive design (mobile-friendly)
- Form validation
- Toast notifications for success/error
- Shadow effects dan rounded corners
- Gradient buttons dengan hover effects

## Installation & Setup

### 1. Run Migration

```bash
php artisan migrate
```

### 2. Run Seeder (Optional - for testing)

```bash
php artisan db:seed --class=OpenTripBookingSeeder
```

### 3. Create Storage Link (if not exists)

```bash
php artisan storage:link
```

## Validation Rules

### Checkout Form:

- `full_name`: required, string, max:255
- `phone`: required, string, max:20
- `email`: required, email
- `gender`: required, in:male,female
- `dob`: required, date
- `address`: required, string
- `emergency_name`: required, string, max:255
- `emergency_phone`: required, string, max:20
- `participants`: required, integer, min:1
- `payment_method`: required, in:bank_transfer,qris,e_wallet,cash
- `payment_proof`: required, file, mimes:jpg,jpeg,png,pdf, max:5120
- `notes`: nullable, string

## Testing Checklist

- [ ] User dapat melihat list open trip
- [ ] User dapat melihat detail trip
- [ ] User tidak login diarahkan ke login saat klik "Book Now"
- [ ] User login dapat akses form checkout
- [ ] Form validation bekerja dengan baik
- [ ] Upload payment proof berhasil
- [ ] Total price terhitung otomatis sesuai participants
- [ ] Data tersimpan ke database dengan benar
- [ ] Redirect ke success page setelah submit
- [ ] Booking muncul di profile history
- [ ] Status badge ditampilkan dengan warna yang tepat
- [ ] Responsive di mobile, tablet, dan desktop
- [ ] Toast notification muncul untuk success/error

## Future Enhancements

1. **Email Notifications**: Send confirmation email setelah booking
2. **Payment Gateway Integration**: Integrasi dengan Midtrans/Xendit
3. **Automatic Status Update**: Update status otomatis setelah payment verified
4. **Review System**: User dapat memberikan review setelah trip
5. **Trip Calendar**: Calendar view untuk jadwal trip
6. **Available Slots**: Menampilkan slot tersedia untuk setiap trip
7. **Waitlist**: Daftar tunggu jika slot penuh
8. **Cancellation Policy**: User dapat cancel dengan policy tertentu
9. **Admin Dashboard**: Untuk manage bookings dan trips
10. **WhatsApp Integration**: Send confirmation via WhatsApp

## Support

Untuk pertanyaan atau issue terkait Open Trip Booking:

- Email: info@travio.com
- Phone: +62 812-3456-7890
- GitHub Issues: [Repository Link]

---

**Last Updated**: December 6, 2025
**Version**: 1.0.0
**Author**: Travio Development Team
