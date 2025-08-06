<div align="center">

# 🎓 EduConnect

<img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&size=24&duration=3000&pause=1000&color=2E86AB&center=true&vCenter=true&width=600&lines=Connecting+Education+Through+Technology;Empowering+Students+%26+Tutors;Building+the+Future+of+Learning" alt="Typing SVG" />

<br/>

🚀 **A comprehensive Laravel 12 educational platform with bilingual support**

✅ **Core Features Implemented - Beta Ready!** ✅

</div>

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white&labelColor=1a1a1a)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white&labelColor=1a1a1a)](https://php.net)
[![Status](https://img.shields.io/badge/Status-Beta%20Ready-28A745?style=for-the-badge&labelColor=1a1a1a)](https://github.com/Rajibkd1/EduConnect)
[![Bilingual](https://img.shields.io/badge/Languages-EN%20%7C%20বাং-007ACC?style=for-the-badge&labelColor=1a1a1a)](https://github.com/Rajibkd1/EduConnect)

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%">

</div>

---

<div align="center">

## 🌟 **What is EduConnect?**

</div>

**EduConnect** is a cutting-edge educational platform built with Laravel 12 that bridges the gap between students, tutors, and guardians. Our mission is to create seamless learning experiences through modern technology and innovative features.

🌍 **Bilingual Support**: Full English and Bangla (বাংলা) language support with seamless switching

<div align="center">

**🎯 Vision:** _Empowering education through intelligent connections_

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="50%">

</div>

```php
<?php
// EduConnect - Where Education Meets Innovation
class EduConnect {
    public function connectLearners() {
        return $this->students()
                   ->connectWith($this->tutors())
                   ->through($this->platform())
                   ->withBilingualSupport()
                   ->createMagic();
    }
}
```

<div align="center">

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%">

</div>

---

<div align="center">

## ✨ **Features Overview**

</div>

|  👥 **User Management**   |   📚 **Learning Hub**    | 💬 **Communication** |  📊 **Analytics**   |
| :-----------------------: | :----------------------: | :------------------: | :-----------------: |
| Multi-role Authentication | Subject & Tutor Matching | Real-time Messaging  |  Progress Tracking  |
|     Student Profiles      |    Session Scheduling    | Notification System  | Feedback & Ratings  |
|    Guardian Oversight     |     Resource Sharing     |  Group Discussions   | Performance Reports |

### 🔥 **Core Functionalities**

```
🎓 Student Features:
  ✅ Browse and filter tutors by subject/rating/location
  ✅ Send session requests to tutors with detailed requirements
  ✅ Real-time messaging system for communication
  ✅ Session management and scheduling
  ✅ Feedback and rating system for tutors
  ✅ Favorite tutors management
  ✅ Comprehensive dashboard with session history

👨🏫 Tutor Features:
  ✅ Detailed profile management with qualifications
  ✅ Session request approval/rejection workflow
  ✅ Create and manage tutoring sessions
  ✅ Real-time messaging with students
  ✅ Receive and respond to feedback
  ✅ Session analytics and management dashboard
  ✅ Notification system for all activities

👨👩👧👦 Guardian Features:
  ✅ Monitor student activities and sessions
  ✅ Direct communication with tutors
  ✅ Session oversight and approval
  ✅ Access to student progress reports
  ✅ Notification system for student activities

⚙️ System Features:
  ✅ Multi-role authentication system
  ✅ Comprehensive notification system
  ✅ Bilingual support (English/Bangla)
  ✅ Email verification and password reset
  ✅ Real-time messaging infrastructure
  ✅ Advanced search and filtering
```

---

<div align="center">

## 🏗️ **Development Status**

### 🎉 **Current Phase: Beta Ready - Core Features Complete** 🎉

</div>

✅ **Database Architecture** - Complete with comprehensive schema

✅ **Model Relationships** - All models with proper relationships

✅ **Laravel 12 Implementation** - Latest Laravel framework

✅ **Authentication System** - Multi-role auth with email verification

✅ **Session Management** - Complete session lifecycle management

✅ **Messaging System** - Real-time communication between users

✅ **Notification System** - Comprehensive notification infrastructure

✅ **Feedback System** - Rating and review functionality

✅ **Bilingual Support** - English and Bangla language support

✅ **API Development** - RESTful APIs for all core features

⏳ **UI/UX Enhancements** - Ongoing improvements

⏳ **Performance Optimization** - Database indexing and caching

📋 **Mobile App Integration** - Planned for next phase

**🎯 Current Status:** _Beta Ready - Core Platform Functional_

---

<div align="center">

## 🛠️ **Tech Stack**

<img src="https://skillicons.dev/icons?i=laravel,php,mysql,redis,git&theme=dark" />

</div>

### 📦 **Key Dependencies & Features**

-   **Backend:** Laravel 12.x with enhanced performance
-   **Database:** MySQL with comprehensive schema and relationships
-   **ORM:** Eloquent with optimized query structures
-   **Testing:** Pest Framework 3.x for comprehensive testing
-   **Authentication:** Multi-role authentication system
-   **Translation:** Google Cloud Translate API integration
-   **Email:** Laravel Mail with OTP verification
-   **Localization:** Full bilingual support (English/Bangla)
-   **Real-time:** Message system with notification infrastructure
-   **API:** RESTful APIs for all core functionalities

---

<div align="center">

## 🚀 **Quick Start**

</div>

📋 Prerequisites

-   PHP >= 8.2
-   Composer 2.6+
-   MySQL 8.0+ (recommended)
-   Node.js 18+ & NPM
-   Git
-   XAMPP/WAMP/MAMP (for local development)

### 🔧 **Installation Steps**

```bash
# 1️⃣ Clone the repository
git clone https://github.com/Rajibkd1/EduConnect.git
cd EduConnect

# 2️⃣ Install PHP dependencies
composer install

# 3️⃣ Environment setup
cp .env.example .env
php artisan key:generate

# 4️⃣ Configure your database in .env file
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=educonnect
# DB_USERNAME=root
# DB_PASSWORD=

# 5️⃣ Database setup
php artisan migrate
php artisan db:seed

# 6️⃣ Install frontend dependencies
npm install && npm run build

# 7️⃣ Start development server
php artisan serve
```

🎉 **Your EduConnect instance will be available at:** `http://localhost:8000`

### 🌍 **Language Support**
- Switch between English and Bangla using the language toggle (EN/বাং)
- All UI elements, forms, and content support both languages
- Database content is automatically translated

---



## 🤝 **Contributing**

**We welcome contributions from the community!**

[![Contributors](https://img.shields.io/github/contributors/Rajibkd1/EduConnect?style=for-the-badge)](https://github.com/Rajibkd1/EduConnect/graphs/contributors)

### 📝 **How to Contribute**

1. **🍴 Fork** the repository
2. **🌿 Create** your feature branch (`git checkout -b feature/AmazingFeature`)
3. **✍️ Commit** your changes (`git commit -m 'Add some AmazingFeature'`)
4. **📤 Push** to the branch (`git push origin feature/AmazingFeature`)
5. **🔄 Open** a Pull Request

### 🐛 **Found a Bug?**

Please [create an issue](https://github.com/Rajibkd1/EduConnect/issues) with detailed information.

### 📋 **Development Guidelines**

-   Follow PSR-12 coding standards
-   Write comprehensive tests for new features
-   Update documentation for any API changes
-   Ensure Laravel 12 compatibility

---

## 📚 **Documentation**

-   [Implementation Summary](IMPLEMENTATION_SUMMARY.md) - Detailed feature implementation
-   [Bilingual Support](BILINGUAL_IMPLEMENTATION_SUMMARY.md) - Language support details
-   [Missing Features Analysis](MISSING_FEATURES_ANALYSIS.md) - Future development roadmap
-   [Mail Setup Guide](MAIL_SETUP.md) - Email configuration guide
-   [API Documentation](docs/API.md) _(Coming Soon)_
-   [Database Schema](docs/DATABASE.md) _(Coming Soon)_

---

## 🔧 **Environment Configuration**

⚙️ Sample .env Configuration

```env
APP_NAME=EduConnect
APP_ENV=local
APP_KEY=base64:your-app-key-here
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=educonnect
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@educonnect.com"
MAIL_FROM_NAME="${APP_NAME}"

# Google Translate API (for content translation)
GOOGLE_TRANSLATE_API_KEY=your-google-translate-api-key
```

### 📧 **Email Configuration**
For OTP verification and notifications, configure your email settings:
- Gmail: Use app-specific passwords
- Other providers: Configure SMTP settings accordingly

---

## 📞 **Connect With Us**

<div align="center">

[![GitHub](https://img.shields.io/badge/GitHub-Rajibkd1-181717?style=for-the-badge&logo=github)](https://github.com/Rajibkd1)
[![Email](https://img.shields.io/badge/Email-Contact-EA4335?style=for-the-badge&logo=gmail&logoColor=white)](mailto:rajib2516@student.nstu.edu.bd)

</div>

## 🚀 **Current Features**

### ✅ **Implemented & Working**
- **Multi-role Authentication** (Student, Tutor, Guardian, Admin)
- **Session Management** (Create, manage, track sessions)
- **Session Request System** (Request, approve, reject workflow)
- **Real-time Messaging** (Direct messages between users)
- **Notification System** (In-app notifications for all activities)
- **Feedback & Rating System** (Rate tutors, provide feedback)
- **Tutor Search & Filtering** (Advanced search with multiple criteria)
- **Favorites Management** (Save and manage favorite tutors)
- **Profile Management** (Comprehensive user profiles)
- **Bilingual Support** (English/Bangla with seamless switching)
- **Email Verification** (OTP-based email verification)
- **Password Reset** (Secure password reset with OTP)

### 🔄 **API Endpoints Available**
- User authentication and management
- Session CRUD operations
- Messaging system APIs
- Notification management
- Feedback and rating APIs
- Search and filtering APIs

---

<div align="center">

**Made with ❤️ for the Education Community using Laravel 12**

**🌍 Supporting English & বাংলা Languages**

---

### ⭐ **If you find this project helpful, please give it a star!** ⭐

</div>
