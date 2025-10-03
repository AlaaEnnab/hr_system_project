# HR System

The **HR System** is a simple web-based Human Resource Management application. It allows managing employees, departments, leaves, and attendance. Built with **PHP** and **MySQL**, and styled using **Bootstrap 5** for a modern and responsive interface.

---

## 📌 Key Features

1. **Employee Management**  
   - Add, edit, and delete employees  
   - View employees by department

2. **Department Management**  
   - Add, edit, and delete departments  
   - View employees in each department

3. **Attendance System**  
   - Record daily attendance of employees  
   - View attendance records by employee

4. **Leave Management**  
   - Employees can request leaves  
   - Admin can approve or reject leave requests

5. **Dashboard**  
   - Quick statistics for employees, departments, and leaves  
   - Interactive cards with hover effects

6. **Modern User Interface**  
   - Responsive design using Bootstrap 5  
   - Fixed sidebar with icons for navigation  
   - Simple and clean footer

---

## 🛠️ Requirements

- PHP 7.4 or higher  
- MySQL 5.7 or higher  
- XAMPP or any local server supporting PHP/MySQL  
- Modern web browser (Chrome, Firefox, Edge)  

---

## 🔧 How to Run

1. **Import the Database**  
   - Open `phpMyAdmin` or MySQL Workbench  
   - Create a new database (or use the provided SQL file)  
   - Import `hr_system.sql` using the **Import** option  

2. **Configure Database Connection**  
   - Open `config.php`  
   - Update MySQL credentials:
     ```php
     private $host = "localhost";
     private $db_name = "hr_system";
     private $username = "root";
     private $password = "";
     ```

3. **Run the Project on Local Server**  
   - Place the project files inside `htdocs` (for XAMPP)  
   - Open your browser and go to:
     ```
     http://localhost/HR_PROJECT/dashboard.php
     ```

4. **Login**  
   - Use the admin account (example):  
     - Email: `alaa@example.com`  
     - Password: as set in the database

---

## 🗂️ Project Structure

