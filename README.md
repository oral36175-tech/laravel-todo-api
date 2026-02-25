# 📝 Laravel To-Do API & SPA Frontend

Bu loyiha to'liq RESTful API arxitekturasida qurilgan bo'lib, foydalanuvchilarga o'z vazifalarini boshqarish imkonini beradi. Loyihada xavfsizlik va zamonaviy web-texnologiyalar amalda qo'llanilgan.

## 🚀 Ishlatilgan Texnologiyalar

* **Backend:** PHP, Laravel 11
* **Ma'lumotlar bazasi:** MySQL
* **Autentifikatsiya:** Laravel Sanctum (Token-based Auth)
* **Frontend:** HTML, TailwindCSS, Vanilla JavaScript (Fetch API)
* **Testlash uchun:** Thunder Client / Postman

## 📌 API Yo'llari (Endpoints)

| Metod | URL Yo'li (Endpoint) | Vazifasi | Autentifikatsiya |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/login` | Tizimga kirish va Token olish | ❌ Yo'q |
| `GET` | `/api/vazifalar` | Foydalanuvchining barcha vazifalarini olish | ✅ Ha (Bearer) |
| `POST` | `/api/vazifalar` | Yangi vazifa yaratish | ✅ Ha (Bearer) |
| `PATCH` | `/api/vazifalar/{id}` | Vazifa holatini o'zgartirish (Bajarildi/Bajarilmadi) | ✅ Ha (Bearer) |
| `DELETE`| `/api/vazifalar/{id}` | Vazifani bazadan o'chirish | ✅ Ha (Bearer) |

## ⚙️ Loyihani kompyuterga o'rnatish

Agar ushbu loyihani o'z kompyuteringizda ishlatib ko'rmoqchi bo'lsangiz, quyidagi qadamlarni bajaring:

1. Loyihani yuklab oling:
   ```bash
   git clone [https://github.com/oral36175-tech/laravel-todo-api.git](https://github.com/oral36175-tech/laravel-todo-api.git)