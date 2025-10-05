FLEETIFY ATTENDANCE -  TEST CASE FULLSTACK

Sistem absensi karyawan berbasis Laravel + MySQL dengan fitur:
CRUD Department
CRUD Employee
Check-in & Check-out
Log Absensi (filter tanggal, department, employee) + status ON_TIME/LATE & COMPLETE/EARLY/MISSING
Attendance History (IN/OUT)

ENVIRONTMENT

PHP 8.2+ & Laravel 10/11
MySQL 8.x
Node 20.x 
Vite + Tailwind CSS

HOW TO USE ?

# 1) Clone repo
git clone https://github.com/prtmbvn/Test_Case-leetify.id
cd Test_Case-leetify.id

# 2) Install dependencies
composer install
npm install

# 3) Setup environment
cp .env.example .env
php artisan key:generate

# 4) Konfigurasi .env lalu migrate
php artisan migrate


RUN THE PROJECT 
    composer run dev (sebelumnya instal dulu composer "composer install")

| Modul              | Method | Route                        | Keterangan                                                            |
| ------------------ | ------ | ---------------------------- | --------------------------------------------------------------------- |
| Departments        | GET    | `/departments`               | List + filter                                                         |
|                    | GET    | `/departments/create`        | Form create                                                           |
|                    | POST   | `/departments`               | Simpan                                                                |
|                    | GET    | `/departments/{id}/edit`     | Form edit                                                             |
|                    | PUT    | `/departments/{id}`          | Update                                                                |
|                    | DELETE | `/departments/{id}`          | Hapus                                                                 |
| Employees          | GET    | `/employees`                 | List + filter                                                         |
|                    | GET    | `/employees/create`          | Form create                                                           |
|                    | POST   | `/employees`                 | Simpan                                                                |
|                    | GET    | `/employees/{id}/edit`       | Form edit                                                             |
|                    | PUT    | `/employees/{id}`            | Update                                                                |
|                    | DELETE | `/employees/{id}`            | Hapus                                                                 |
| Attendance         | GET    | `/attendance/check-in`       | Form check-in                                                         |
|                    | POST   | `/attendance/check-in`       | Simpan check-in                                                       |
|                    | GET    | `/attendance/check-out`      | Form check-out                                                        |
|                    | POST   | `/attendance/check-out`      | Simpan check-out                                                      |
|                    | GET    | `/attendance/logs`           | Log + filter (`date_from`, `date_to`, `department_id`, `employee_id`) |
| Attendance History | GET    | `/attendance-histories`      | Riwayat IN/OUT + filter                                               |
|                    | GET    | `/attendance-histories/{id}` | Detail                                                                |
|                    | DELETE | `/attendance-histories/{id}` | Hapus (opsional)                                                      |
