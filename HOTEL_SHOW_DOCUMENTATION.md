# Hotel Show Page Documentation

## Deskripsi

File ini mengimplementasikan tampilan detail hotel menggunakan gaya dan struktur UI yang sama dengan `car/show.blade.php`, tetapi disesuaikan untuk menampilkan data hotel dari tabel `HotelDetail` dan `HotelRoom`.

## Struktur Data

### HotelDetail (app/Models/HotelDetail.php)

- `id` - ID unik hotel detail
- `hotel_id` - Foreign key ke tabel Hotel
- `nama` - Nama hotel
- `location` - Lokasi hotel
- `description` - Deskripsi hotel
- `headerImage` - Gambar header hotel
- `interiorImage` - Gambar interior hotel
- `syaratKetentuan` - Syarat dan ketentuan (string/array)
- `facilities` - Fasilitas hotel (JSON array)
- Dan field lainnya (address, phone, email, rating, price, dll)

### HotelRoom (app/Models/HotelRoom.php)

- `id` - ID unik kamar
- `hotel_id` - Foreign key ke tabel Hotel
- `name` - Nama kamar
- `description` - Deskripsi kamar
- `facilities` - Fasilitas kamar (JSON string)
- `price` - Harga kamar per malam
- `max_guest` - Kapasitas maksimal tamu
- `bed_type` - Jenis kasur
- `room_size` - Ukuran kamar
- `image` - Foto kamar
- `status` - Status ketersediaan

## Routes

```php
// Route untuk menampilkan detail hotel
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/hotel/{id}', [HotelController::class, 'show'])->name('hotel.show');
```

## Controller (app/Http/Controllers/HotelController.php)

```php
public function show($id)
{
    $hotel = Hotel::findOrFail($id);
    $hotelDetail = HotelDetail::where('hotel_id', $hotel->id)->first();
    $hotelRooms = HotelRoom::where('hotel_id', $hotel->id)->get();

    return view('hotels.show', compact('hotel', 'hotelDetail', 'hotelRooms'));
}
```

## Fitur Tampilan

### 1. Hero Banner

- Menggunakan `headerImage` dari HotelDetail sebagai background
- Menampilkan nama hotel dan lokasi

### 2. Gallery Section

- Menampilkan `headerImage` dan `interiorImage` dari HotelDetail
- Menampilkan foto kamar dari HotelRoom (maksimal 4 foto)
- Efek hover yang sama seperti car/show

### 3. Hotel Information

- Nama hotel dan lokasi
- Deskripsi lengkap hotel
- Menggunakan styling yang konsisten dengan car/show

### 4. Facilities

- Menampilkan fasilitas hotel dari field `facilities` di HotelDetail
- Support format JSON array
- Icon checkmark untuk setiap fasilitas

### 5. Terms & Conditions

- Menampilkan syarat ketentuan dari field `syaratKetentuan`
- Support format string dengan newline atau array
- Icon warning untuk setiap item

### 6. Room Selection

- Loop melalui semua `HotelRoom` yang terkait dengan hotel
- Menampilkan foto kamar, nama, deskripsi, fasilitas, harga, dan kapasitas
- Button "Book Now" yang mengarah ke checkout dengan parameter room_id
- Card styling yang konsisten dengan pricing card di car/show

## Styling

- Menggunakan sistem styling yang sama persis dengan `car/show.blade.php`
- Color scheme: Primary (#1f5eff), Secondary (#1546c1)
- Gradient backgrounds dan hover effects
- Responsive design dengan Bootstrap classes
- Custom CSS untuk konsistensi visual

## Usage Example

```php
// Untuk mengakses halaman detail hotel
URL: /hotels/1 atau /hotel/1

// Data yang akan ditampilkan:
- Header image dari HotelDetail
- Nama hotel: hotelDetail->nama
- Lokasi: hotelDetail->location
- Deskripsi: hotelDetail->description
- Fasilitas: hotelDetail->facilities (JSON array)
- Syarat ketentuan: hotelDetail->syaratKetentuan
- Daftar kamar: hotelRooms (collection)
```

## Seeder

Gunakan `HotelSeeder` yang telah diperbarui untuk mengisi sample data:

```bash
php artisan db:seed --class=HotelSeeder
```

## Notes

1. File view: `resources/views/hotels/show.blade.php`
2. Layout mengikuti struktur car/show tetapi data berasal dari HotelDetail dan HotelRoom
3. Responsive dan mobile-friendly
4. SEO friendly dengan proper title dan meta tags
5. Terintegrasi dengan sistem checkout yang sudah ada
