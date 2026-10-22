# AI Prompt & Engineering Log — MyRehat Technical Assessment

## System Info
- **AI Assistant**: Claude Sonnet 4.6 (Thinking) via Antigravity
- **Target**: Task A — WordPress Theme Bug Fixes
- **Repo**: myrehat-task-a

---

## Log #1: functions.php PHP Bug Fixes (B1, B2, B3)
- **User Prompt**:
> Review dan refactor file `functions.php` dari child theme WordPress ('myrehat-test') ini dong.
> Ada 3 bug PHP spesifik yang perlu diperbaiki sesuai standar WordPress Coding Standards (WPCS):
> 1. B1 (i18n): Di fungsi `myrehat_test_booking_title()`, fungsi translation `__()` belum ada text-domain-nya. Tolong tambahkan text-domain `'myrehat-test'`.
> 2. B2 (Security): Di handler form `myrehat_test_booking_handler()`, data `$_POST` masih dipakai mentah tanpa nonce dan tanpa sanitasi. Tolong amankan dengan verifikasi nonce (`trails_booking_nonce` / `trails_booking_action`) dan sanitasi input pakai `sanitize_text_field(wp_unslash(...))`.
> 3. B3 (Action Hook): Di hook `add_action('myrehat_trail_viewed', ...)`, callback-nya butuh 2 argumen `($trail_id, $count)`, tapi `accepted_args` cuma diset 1. Efeknya `$trail_id` jadi null. Tolong benerin jumlah argumennya jadi 2.
> Buat kode perbaikan yang bersih dan rapi ya, plus penjelasan singkat kenapa bug itu terjadi dan gimana fix-nya!

- **Summary Fix**:
  - B1: Ditambahkan text-domain `'myrehat-test'` pada `__()`.
  - B2: Ditambahkan nonce verification `trails_booking_nonce` dan sanitasi `sanitize_text_field(wp_unslash($_POST['date']))`.
  - B3: Diupdate `accepted_args` dari 1 menjadi 2 pada `add_action('myrehat_trail_viewed', ...)`.
- **Verification Note**: Lolos review WPCS, nonce guard aktif, argumen hook lengkap.

---

## Log #2: trails.js JavaScript Bug Fixes (A1, A2, A10, A11, A12)
- **User Prompt**:
> review dan refactor file `trails.js` untuk menyelesaikan bug A1, A2, A10, A11, dan A12 sekaligus:
> 1. **A1 (Fix Search Listing):** 
>    - Selector input salah (`searchInput` harusnya `search-box`).
>    - Selector empty message salah (`no-results` harusnya `trails-no-results`).
> 2. **A2 (Filter Dropdown Kategori Terintegrasi):**
>    - Ambil elemen `#category`.
>    - Gabungkan logika pencarian teks DAN dropdown kategori (`data-category` pada `.trail-card`). Sebuah card hanya tampil jika lolos filter teks DAN kategori (atau jika kategori 'all').
> 3. **A10 (Header Search Sinkron):**
>    - Elemen `#main-search` di header harus ikut memfilter listing yang sama persis.
>    - Sinkronkan nilainya: jika user mengetik di `#main-search`, nilai `#search-box` ikut terupdate dan sebaliknya.
> 4. **A11 (Perhitungan Realtime Daily vs Monthly):**
>    - Tambahkan event listener saat user memilih radio button durasi booking (Daily vs Monthly).
>    - Rumus harga:
>      - Daily = RM 350
>      - Monthly = 350 * 30 * 0.8 = RM 8.400
>    - Update teks `#trails-total` secara realtime saat radio button diganti (contoh: "Total: RM 350" atau "Total: RM 8,400").
> 5. **A12 (Pesan Konfirmasi Booking):**
>    - Saat form `#booking-form` disubmit: preventDefault, ambil nama dan durasi yang dipilih, lalu tampilkan pesan konfirmasi sukses di dalam elemen `#trails-confirmation` (hapus atribut hidden, berikan pesan sukses yang rapi), bukan hanya window.alert().

- **Summary Fix**:
  - A1: Mengoreksi ID selector input menjadi `#search-box` dan empty message menjadi `#trails-no-results`.
  - A2: Mengambil `#category` dan mengintegrasikan filter pencarian teks dengan kategori `data-category`.
  - A10: Menghubungkan input listener pada `#main-search` dan `#search-box` secara bidirectional dengan sinkronisasi nilai otomatis.
  - A11: Menambahkan event listener `change` pada radio button `duration` dan kalkulasi harga realtime (Daily: RM 350, Monthly: RM 8,400).
  - A12: Mengganti `alert()` dengan memanipulasi elemen `#trails-confirmation` (membuka atribut hidden, menyisipkan detail booking yang telah di-escape).
- **Verification Note**: Event listener aman terpasang saat DOM siap, modular, filter terintegrasi penuh, sanitasi output HTML XSS-safe.

---

## Log #3: page-trails.php Template Fixes (A3, A4, A5, A6, A8, A9, A11)
- **User Prompt**:
> review dan update file `page-trails.php` untuk menyelesaikan bug A3, A4, A5, A6, A8, A9, dan A11 (sisi markup HTML):
> 1. **A5 (Judul Persis):**
>    - Ganti `<h1>Hiking Advantures</h1>` menjadi persis: `<h1>Tropic Hiking Trails</h1>`.
> 2. **A3 (Tombol WhatsApp & LINE di Atas):**
>    - Tambahkan container tombol kontak di bagian header atas (misal class `trails-sticky-contact` atau tombol di header) berisi link tombol WhatsApp dan LINE dengan teks tebal/bold (styling sticky akan difinalisasi di CSS).
> 3. **A11 (Markup Pilihan Durasi Booking):**
>    - Di dalam `#booking-form`, tambahkan pilihan radio button `name="duration"`:
>      - Opsi Daily (value="daily", label: Daily (RM 350))
>      - Opsi Monthly (value="monthly", label: Monthly (RM 8,400))
>      - Set default salah satunya (misal daily tercentang default) agar sinkron dengan kalkulasi di `trails.js`.
> 4. **A6 (Form Booking - Digital Nomad Wajib):**
>    - Tambahkan pilihan: "Are you a Digital Nomad?" dengan opsi Ya / Tidak (bisa radio button atau select dropdown) dan wajib diisi (`required`).
> 5. **A9 (Form Booking - Host Terms Checkbox Wajib):**
>    - Tambahkan checkbox persetujuan dengan label persis: "I agree to the Host Terms" dan wajib dicentang (`required`).
> 6. **Form Security Nonce:**
>    - Masukkan input hidden `name="trails_booking"` dan `<?php wp_nonce_field( 'trails_booking_action', 'trails_booking_nonce' ); ?>` di dalam `#booking-form` agar sinkron dengan handler keamanan di `functions.php`.
> 7. **A4 & A8 (Footer Clean up & Social Media):**
>    - Pada `<nav>` di dalam footer, sisakan HANYA 4 link ini (hapus Twitter, Blog, Careers, dkk):
>      - FAQ
>      - Contact Us
>      - PDPA
>      - Privacy Policy (atau Privacy Policy Statement)
>    - Tambahkan section/nav sosial media baru di footer yang berisi link ke:
>      - Facebook, LinkedIn, Instagram, TikTok, YouTube (bisa berupa teks link atau link dengan ikon/label yang jelas).

- **Summary Fix**:
  - A5: Mengubah judul `<h1>` menjadi `Tropic Hiking Trails` (memperbaiki typo "Advantures" dan menyamakan penamaan brand).
  - A3: Menambahkan container markup `.trails-sticky-contact` dengan link WhatsApp & LINE berlabel bold `<strong>`.
  - A11: Menambahkan radio group `duration` (Daily: RM 350 [default checked], Monthly: RM 8,400) dan inisialisasi default teks harga `#trails-total`.
  - A6: Menambahkan field select dropdown wajib (`required`) untuk pertanyaan "Are you a Digital Nomad?".
  - A9: Menambahkan checkbox wajib (`required`) dengan label "I agree to the Host Terms".
  - Security Nonce: Menambahkan hidden input `trails_booking` dan helper function WordPress `wp_nonce_field()` untuk sinkronisasi penuh dengan backend handler.
  - A4 & A8: Membersihkan menu navigasi footer menjadi tepat 4 link (FAQ, Contact Us, PDPA, Privacy Policy Statement), serta menambahkan kontainer sosial media baru `.trails-social-links` (Facebook, LinkedIn, Instagram, TikTok, YouTube).
- **Verification Note**: Markup valid HTML5, atribut aksesibilitas (`aria-label`, `fieldset`, `legend`) disematkan, form siap sinkron dengan frontend JS dan backend PHP.

---

## Log #4: style.css Styling & Responsive Fixes (A3, A7, A8)
- **User Prompt**:
> review dan update `style.css` untuk menyelesaikan bug A7 dan A3, plus merapikan styling komponen baru:
> 1. **A7 (Fix Mobile 390px — Hilangkan Section Hilang & Cegah Geser Kanan-Kiri):**
>    - Hapus aturan `.trails-promo { display: none; }` pada media query mobile (`@media (max-width: 600px)`). Section promo harus tetap terlihat dan terbaca rapi di mobile.
>    - Perbaiki horizontal scroll/overflow yang bikin layar geser kanan-kiri di 390px:
>      - Ubah `.trails-cards` agar menggunakan `flex-wrap: wrap` (atau CSS grid `grid-template-columns: repeat(auto-fit, minmax(280px, 1fr))`).
>      - Pastikan `.trail-card` tidak memaksa lebar melebihi layar (gunakan `min-width: 0; width: 100%;` di mobile).
>      - Tambahkan global/wrapper rule `box-sizing: border-box; overflow-x: hidden;` pada kontainer utama jika diperlukan agar halaman terklocked tegak lurus pada lebar 390px tanpa horizontal scroll sama sekali.
> 2. **A3 (Styling Tombol WhatsApp & LINE — Sticky & Bold):**
>    - Berikan styling untuk tombol WhatsApp dan LINE di header:
>      - Posisi **sticky** di bagian atas halaman (`position: sticky; top: 0; z-index: 1000;`).
>      - Background kontras, padding nyaman, border-radius, dan font **bold** (`font-weight: 700`).
>      - Responsif dan tetap terlihat elegan baik di desktop maupun mobile.
> 3. **Styling Elemen Baru (A8 & Booking Form):**
>    - Berikan styling rapi untuk ikon/link sosial media di footer (A8) agar sejajar dan berjarak estetik.
>    - Pastikan radio button durasi (Daily/Monthly), dropdown Digital Nomad, dan checkbox Host Terms tertata rapi dengan spasi yang nyaman di mobile.

- **Summary Fix**:
  - A7: Menghapus aturan `display: none;` pada `.trails-promo` di media query mobile sehingga promo banner tetap tampil.
  - A7: Mengubah layout `.trails-cards` dari single-line flexbox kaku menjadi CSS Grid fleksibel (`grid-template-columns: repeat(auto-fill, minmax(280px, 1fr))` dan `1fr` di mobile), mengatur `min-width: 0;`, serta menambahkan global reset `*, *::before, *::after { box-sizing: border-box; }` dan `body { overflow-x: hidden; }` sehingga viewport 390px terkunci sempurna tanpa horizontal scrolling.
  - A3: Menerapkan styling bar sticky `.trails-sticky-contact` (`position: sticky; top: 0; z-index: 1000;`) dengan tombol WhatsApp (`#25D366`) dan LINE (`#06C755`), font-weight 700 bold, border-radius pill, dan interaksi hover/active halus.
  - Form & A8 Styling: Menata rapi radio group durasi (`.booking-duration-group`), dropdown Digital Nomad, checkbox Host Terms, dan deretan link sosial media di footer (`.trails-social-links`).
- **Verification Note**: Clean CSS, mobile-first responsive breakdown, zero horizontal overflow pada viewport smartphone (390px), kontras warna aksesibel.

---

## Log #5: Audit Polish & Exact Requirement Alignment (A4, A11)
- **User Prompt**:
> Setelah aku audit ulang kodenya dan aku cross-check dengan detail teks di lembar instruksi resmi MyRehat, ada 2 detail teks kecil yang perlu kamu poles biar 100% persis kata-per-kata sesuai permintaan soal:
> 1. **A4 (Footer Navigation Text Precision) di `page-trails.php`:**
>    - Ubah teks link ke-4 pada footer `<nav class="trails-footer-nav">`:
>      - Dari: `Privacy Policy Statement`
>      - Menjadi: `Privacy Policy` (persis sesuai kalimat di soal: "sisakan HANYA FAQ, Contact Us, PDPA, Privacy Policy").
> 2. **A11 (Price Format Precision) di `trails.js`:**
>    - Pada fungsi `updatePriceCalculation()`, pastikan format teks output total harga persis menggunakan format di soal ("Daily = RM 350, Monthly = RM 350 × 30 × 0,8 = RM 8.400"):
>      - Untuk Daily: `'Total: RM 350'`
>      - Untuk Monthly: `'Total: RM 8.400'` (gunakan tanda titik `8.400`, bukan koma `8,400`).

- **Summary Fix**:
  - A4: Memperbarui label tautan legal keempat di footer template `page-trails.php` menjadi persis `Privacy Policy` (menghapus kata "Statement").
  - A11: Memperbaiki format pemisah ribuan output `#trails-total` pada `trails.js` menjadi format titik (`Total: RM 8.400` untuk Monthly dan `Total: RM 350` untuk Daily) persis sesuai instruksi penilaian teknis.
- **Verification Note**: String teks dan format harga 100% selaras dengan rubrik asesmen.

