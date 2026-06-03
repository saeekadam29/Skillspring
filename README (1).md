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

### 🔐 Login & Register
Secure authentication with a modern split-screen UI design.

### 📰 Blog / News Page
Filter articles by category: All, Tech, Finance, AI, Cybersecurity, Career, Manufacturing.

### 📄 Resume Analyzer
Paste resume text or upload a .txt file, select target career role, and get instant analysis.

---

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
