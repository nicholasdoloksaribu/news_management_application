# Laravel News API

Proyek ini adalah RESTful API sederhana untuk mengelola berita (articles), komentar (comments), dan autentikasi pengguna menggunakan **Laravel Passport**.  
Struktur kodenya dibuat dengan **Service–Repository Pattern** agar rapi dan mudah dikembangkan.

---

## Fitur Utama
- Autentikasi dengan **Laravel Passport (Personal Access Token)**
- Pola **Service–Repository Pattern**
- CRUD Artikel dan Komentar
- Relasi antar model (User ↔ Article ↔ Comment)
- Redis Queue untuk proses komentar asinkron
- Upload gambar ke storage Laravel
- API Resource untuk respons JSON rapi
- Logging otomatis (Observer + Event & Listener)
- Proteksi API menggunakan Middleware `auth:api`

---