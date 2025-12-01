# Hotel Booking System Documentation

Sistem booking hotel yang telah dibuat untuk TRAVIO-WEBSITE. Sistem ini terintegrasi dengan data hotel dan kamar yang sudah ada sebelumnya.

## Files Yang Dibuat

### 1. Migration

- `database/migrations/2025_12_02_100000_create_hotel_bookings_table.php`
    - Tabel `hotel_bookings` dengan relasi ke `hotel_details`, `hotel_rooms`, dan `users`

### 2. Model

- `app/Models/HotelBooking.php`
    - Model utama untuk booking hotel
    - Relasi ke HotelDetail, HotelRoom, dan User
    - Method helper untuk perhitungan malam menginap
    - Scope untuk filter status booking

### 3. Controller

- `app/Http/Controllers/HotelBookingController.php`
    - Method `create()`: Menampilkan halaman checkout
    - Method `store()`: Menyimpan booking ke database
    - Method `success()`: Halaman sukses booking
    - Method `index()`: Daftar booking user
    - Method `cancel()`: Membatalkan booking
    - Method `calculatePrice()`: AJAX untuk hitung harga

### 4. Routes

Routes yang ditambahkan di `routes/web.php`:

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/hotel-booking/checkout/{hotelId}/{roomId}', [HotelBookingController::class, 'create'])->name('hotel.booking.create');
    Route::post('/hotel-booking/store', [HotelBookingController::class, 'store'])->name('hotel.booking.store');
    Route::get('/hotel-booking/success/{id}', [HotelBookingController::class, 'success'])->name('booking.success');
    Route::get('/my-bookings', [HotelBookingController::class, 'index'])->name('my.bookings');
    Route::patch('/hotel-booking/cancel/{id}', [HotelBookingController::class, 'cancel'])->name('hotel.booking.cancel');
    Route::post('/hotel-booking/calculate-price', [HotelBookingController::class, 'calculatePrice'])->name('hotel.booking.calculate.price');
});
```

### 5. Views

- `resources/views/hotel/checkout.blade.php` - Halaman checkout booking
- `resources/views/hotel/booking-success.blade.php` - Halaman sukses booking
- `resources/views/hotel/my-bookings.blade.php` - Daftar booking user

### 6. Seeder

- `database/seeders/HotelBookingSeeder.php` - Data sample booking

## Cara Penggunaan

### 1. Jalankan Migration

```bash
php artisan migrate
```

### 2. Jalankan Seeder (Optional)

```bash
php artisan db:seed --class=HotelBookingSeeder
```

### 3. Akses Booking

Dari halaman detail hotel (`/hotels/{id}`), klik tombol "Book Now" pada kamar yang diinginkan.

### 4. Flow Booking

1. User pilih kamar di halaman hotel detail
2. Redirect ke halaman checkout: `/hotel-booking/checkout/{hotelId}/{roomId}`
3. User isi form (tanggal checkin/checkout, jumlah tamu)
4. Sistem hitung otomatis total harga
5. User submit booking
6. Redirect ke halaman sukses: `/hotel-booking/success/{bookingId}`

## Fitur Sistem

### ✅ Validasi Booking

- Tanggal checkin tidak boleh masa lalu
- Tanggal checkout harus setelah checkin
- Jumlah tamu tidak boleh melebihi kapasitas kamar
- Cek ketersediaan kamar (tidak double booking)

### ✅ Perhitungan Harga

- Otomatis hitung jumlah malam menginap
- Total harga = harga kamar × jumlah malam
- AJAX calculation untuk update realtime

### ✅ Status Booking

- `pending`: Booking baru menunggu konfirmasi
- `confirmed`: Booking dikonfirmasi
- `cancelled`: Booking dibatalkan

### ✅ Relasi Database

- HotelBooking belongsTo HotelDetail
- HotelBooking belongsTo HotelRoom
- HotelBooking belongsTo User
- HotelDetail hasMany HotelBookings
- HotelRoom hasMany HotelBookings
- User hasMany HotelBookings

## Customization

### Menambah Field Baru

1. Tambah kolom di migration
2. Update $fillable di model HotelBooking
3. Update form di view checkout
4. Update validasi di controller

### Notifikasi Email

Tambahkan pengiriman email di method `store()` controller:

```php
// Setelah booking berhasil
Mail::to($user)->send(new BookingConfirmation($booking));
```

### Payment Integration

Tambahkan payment gateway di method `store()` sebelum simpan booking.

## Testing

Untuk test sistem:

1. Login sebagai user
2. Pilih hotel dan kamar
3. Isi form booking
4. Verifikasi data tersimpan di database
5. Test cancel booking di halaman "My Bookings"

## Troubleshooting

### Error "Room not found for this hotel"

- Pastikan room_id valid dan sesuai dengan hotel_id

### Error "Room is not available"

- Ada booking lain yang bentrok di tanggal sama
- Cek data di tabel hotel_bookings

### AJAX calculate price tidak bekerja

- Pastikan CSRF token sudah ditambahkan di layout
- Check console browser untuk error JavaScript
