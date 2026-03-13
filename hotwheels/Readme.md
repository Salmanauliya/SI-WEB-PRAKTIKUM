# Hot Wheels Toys - Katalog Interaktif dengan PHP Session & Cookies

Selamat datang di proyek **Hot Wheels Toys**, sebuah website katalog mainan Hot Wheels yang telah ditingkatkan dengan sistem autentikasi menggunakan **PHP Session** dan fitur **Remember Me** menggunakan **Cookies**. Proyek ini merupakan lanjutan dari Tugas Akhir 2 (JavaScript & Web Storage) dengan penambahan fitur keamanan dan kenyamanan pengguna.

## Fitur yang Ditambahkan

### 1. Sistem Login dengan Session
- Halaman login (`login.php`) dengan form username dan password.
- Kredensial sederhana: `admin` / `admin123` (dapat dikembangkan dengan database).
- Validasi dilakukan di `controller/proses_login.php`.
- Setelah login sukses, session `$_SESSION['username']` disimpan.
- Halaman utama (`indexs.php`) dilindungi: jika tidak ada session, pengguna diarahkan ke login.

### 2. Logout
- Tombol logout di navbar (hanya muncul jika sudah login).
- `controller/logout.php` menghancurkan session dan mengarahkan kembali ke login.

### 3. Remember Me dengan Cookies
- Checkbox "Remember Me" di halaman login.
- Jika dicentang, username disimpan dalam cookie `remember_username` selama 7 hari.
- Saat membuka halaman login kembali, field username otomatis terisi dari cookie.
- Cookie dihapus saat logout atau jika pengguna login tanpa mencentang remember me.

### 4. Tampilan Bootstrap Alert untuk Error Login
- Jika login gagal, ditampilkan alert Bootstrap (bukan JavaScript alert).

### 5. Fitur Interaktif JavaScript (dari Tugas Akhir 2)
- **Wishlist**: Tambah/hapus item, tersimpan di sessionStorage.
- **Dark Mode**: Beralih tema gelap/terang, tersimpan di localStorage.
- **Pembelian**: Tombol Beli mengurangi stok, tombol nonaktif jika stok habis.
- **Ringkasan Produk**: Total produk, total stok, jumlah kategori otomatis diperbarui.

## Struktur File