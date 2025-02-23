# PlusMove - Delivery Tracking System

## Overview
**PlusMove** is a Laravel-based **delivery tracking system** designed to streamline package assignments, tracking, and status updates for deliveries. It includes two main user roles:

- **Admin**: Manages orders, assigns drivers, and tracks deliveries.
- **Driver**: Views assigned deliveries, updates delivery progress, and completes orders.

This document provides a step-by-step guide on how to install, configure, and use the PlusMove system.

---

## Installation Guide
This guide assumes you are setting up Laravel for the first time.

### **1. System Requirements**
Ensure your system meets the following requirements:
- PHP 8.1 or later
- Composer installed ([Download Composer](https://getcomposer.org/download/))
- MySQL or PostgreSQL database
- Node.js & npm (for frontend assets)
- Laravel 11 installed

### **2. Clone the Repository**
```sh
git clone https://github.com/your-repo/plusmove.git
cd plusmove
```

### **3. Install Dependencies**
```sh
composer install
npm install && npm run build
```

### **4. Configure Environment**
Copy the example `.env` file and update database credentials:
```sh
cp .env.example .env
```
Edit `.env` and set:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=plusmove
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### **5. Generate Application Key**
```sh
php artisan key:generate
```

### **6. Run Database Migrations & Seeders**
```sh
php artisan migrate --seed
```
This will create tables and seed the database with default admin and driver roles.

### **7. Start the Server**
```sh
php artisan serve
```
Your application will be available at `http://127.0.0.1:8000/`

---

## Admin Guide

### **Admin Dashboard**
- **Login as Admin** using credentials from the seeder (`Admin User` email: `admin@example.com`, password: `password`).
- View statistics like total orders, pending deliveries, and available drivers.

### **Managing Orders**
- **Create Orders**: Add a new order, specifying package weight, warehouse, and destination.
- **Assign Drivers**: Orders are initially marked as "Orders" until assigned a driver, then they become "Deliveries".
- **Edit Orders**: Modify details before assignment.
- **Delete Orders**: Remove orders if necessary.

### **Tracking Deliveries**
- Click on any **Tracking Code** to view its progress.
- Delivery status updates are recorded when drivers make changes.
- A delivery is considered complete once the driver marks it as "Customer Signed".

---

## Driver Guide

### **Driver Dashboard**
- **Login as Driver** using credentials created during registration.
- View assigned deliveries, including pickup and destination locations.

### **Updating Delivery Progress**
Drivers update the delivery status with:
1. **Delivery Picked Up**
2. **On the Way**
3. **Customer Received**
4. **Customer Signed** (Final Step)
5. **Failed to Deliver** (Shows in red on admin dashboard)

---

## **SMTP Email Setup**
The system sends notifications when orders are created. To configure SMTP with Gmail:

### **1. Enable Gmail SMTP**
- Go to **Google Account Security** ([click here](https://myaccount.google.com/security)).
- Enable **2-Step Verification**.
- Generate an **App Password** for Laravel.

### **2. Update `.env` File**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="PlusMove Notifications"
```

---

## **Troubleshooting**
### **1. Error: Route [dashboard] Not Defined**
Run:
```sh
php artisan route:clear
php artisan config:clear
```
### **2. Migrations Fail with Foreign Key Errors**
Run:
```sh
php artisan migrate:fresh --seed
```
### **3. CSS/JS Not Loading**
Run:
```sh
npm run build
```

---



