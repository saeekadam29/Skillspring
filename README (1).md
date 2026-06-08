# 🌱 SkillSpring — Career Guidance Platform

> **Build your future with SkillSpring** — A full-stack career guidance web platform helping students and professionals discover their ideal career path.

![Platform](https://img.shields.io/badge/Platform-Web-blue)
![Backend](https://img.shields.io/badge/Backend-PHP%20%2B%20MySQL-orange)
![Server](https://img.shields.io/badge/Server-XAMPP-red)
![Status](https://img.shields.io/badge/Status-Active-brightgreen)

---

## 📌 About The Project

SkillSpring is a dynamic career guidance platform built with PHP and MySQL. It helps students and professionals explore career paths, analyze their resumes, read industry news, and access skill-building resources — all in one place.

---

## ✨ Features

- 🔐 **User Authentication** — Secure Login & Registration system
- 🧠 **Personalized Career Quiz** — Discover your ideal career path
- 🗺️ **Career Roadmaps** — Step-by-step guidance for different careers
- 📄 **AI-Powered Resume Analyzer** — Upload resume and get instant recruiter feedback
- 📰 **Blog & Latest News** — Articles on Tech, Finance, AI, Cybersecurity, Career & Manufacturing
- 🔍 **Search & Filter** — Search articles by keyword and filter by category
- 📚 **Resources Section** — Curated learning materials
- 💡 **Fully Dynamic** — All content powered by PHP & MySQL backend

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML5, CSS3, JavaScript |
| Backend | PHP |
| Database | MySQL |
| Local Server | XAMPP (Apache) |

---

## 📸 Screenshots

### 🏠 Homepage
Clean landing page with navigation, career quiz CTA, and featured sections.
<img width="1808" height="923" alt="Screenshot 2026-06-03 180847" src="https://github.com/user-attachments/assets/84abb34e-def2-47bc-8232-58afc797688d" />

### 🔐 Login & Register
Secure authentication with a modern split-screen UI design.
<img width="1808" height="835" alt="Screenshot 2026-06-03 180635" src="https://github.com/user-attachments/assets/f6201368-1f47-4b0c-8c86-7c5c67ec11f0" />

### 📰 Blog / News Page
Filter articles by category: All, Tech, Finance, AI, Cybersecurity, Career, Manufacturing.
<img width="1799" height="804" alt="image" src="https://github.com/user-attachments/assets/498488e9-2e33-4729-a4ed-1fa8075ef82b" />
<img width="1806" height="806" alt="image" src="https://github.com/user-attachments/assets/c75b1a11-3e41-4b61-b604-ce538a9213e3" />

### 📄 Resume Analyzer
Paste resume text or upload a .txt file, select target career role, and get instant analysis.
<img width="1845" height="823" alt="image" src="https://github.com/user-attachments/assets/16884f21-70e5-40a3-81ae-a6c6f66016c0" />

<img width="1824" height="840" alt="image" src="https://github.com/user-attachments/assets/a1a0da7a-8731-4fab-80f2-6b3e3425a7b7" />

<img width="1824" height="832" alt="Screenshot 2026-06-08 155320" src="https://github.com/user-attachments/assets/1cfd2d51-5191-43d6-a981-b95a0c0c3b1c" />

<img width="1812" height="888" alt="Screenshot 2026-06-08 155334" src="https://github.com/user-attachments/assets/bae9ad3d-2221-49c7-a4e2-50aff39d7b0c" />

<img width="1790" height="837" alt="Screenshot 2026-06-08 155355" src="https://github.com/user-attachments/assets/ad234bcf-53f3-46d4-9315-08a97224e74a" />

<img width="1822" height="815" alt="Screenshot 2026-06-08 155410" src="https://github.com/user-attachments/assets/e4b09e1e-29a1-47e0-834a-f9682c0d437b" />



## ⚙️ Installation & Setup

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) installed on your system
- Git (optional)

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/saeekadam29/Skillspring.git
```

**2. Move to XAMPP folder**
```
Copy the project folder to: C:\xampp\htdocs\skillspring
```

**3. Start XAMPP**
- Open XAMPP Control Panel
- Start **Apache** and **MySQL**

**4. Setup the Database**
- Open browser → go to `http://localhost/phpmyadmin`
- Create a new database named `skillspring`
- Import the `setup.sql` file

**5. Configure Database Connection**
- Open `db.php`
- Update credentials if needed:
```php
$host = "localhost";
$user = "root";
$password = "";
$database = "skillspring";
```

**6. Run the Project**
- Open browser → `http://localhost/skillspring/index%20(6).html`

---

## 📁 Project Structure

```
skillspring/
│
├── index (6).html           # Main homepage
├── new.html                 # Blog & News page
│
├── login.php                # Login page UI
├── login_handler (1).php    # Login backend logic
├── register_handler.php     # Registration backend logic
├── logout.php               # Logout handler
│
├── db.php                   # ⚠️ Database connection (excluded from repo)
├── setup.sql                # ⚠️ Database schema (excluded from repo)
│
└── img1–img15.jpeg          # Project image assets
```

---

## 🔒 Security Note

`db.php` and `setup.sql` are excluded from this repository for security reasons.
You will need to create your own `db.php` file with your local database credentials to run this project.

---

## 📰 Blog Categories

The platform currently features **16 articles** across 6 categories:

| Category | Example Articles |
|----------|-----------------|
| 🖥️ Tech | The Rise of Serverless Computing |
| 💰 Finance | Global Economic Forecast for Q4 2025 |
| 🤖 AI | Generative AI Reshapes the Creative Industry |
| 🏭 Manufacturing | AI Integration in Supply Chain Logistics |
| 🔒 Cybersecurity | Latest cybersecurity trends |
| 🎯 Career | Career development guides |

---

## 👤 Author

**Saee Kadam**
- GitHub: [@saeekadam29](https://github.com/saeekadam29)

---

## 📄 License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgements

- Built as a student project to learn full-stack web development
- XAMPP for local server environment
- PHP & MySQL for backend functionality

---

⭐ **If you find this project helpful, please give it a star!**
