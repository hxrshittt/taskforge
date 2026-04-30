# 🚀 TaskForge

TaskForge is a web-based project and task management system built using PHP and MySQL. It allows administrators to create projects, assign tasks, and track progress, while members can view their assigned projects and update task statuses.

---

## 📌 Features

### 🔐 Authentication
- User registration and login
- Role-based access (Admin & Member)

### 📁 Project Management
- Admin can create projects
- Members can view only assigned projects

### ✅ Task Management
- Admin assigns tasks to users
- Members can update task status (Pending, In Progress, Completed)
- Tasks include deadlines

### 📊 Dashboard
- Total tasks
- Pending tasks
- In-progress tasks
- Completed tasks
- Overdue tasks

### 🔗 Project-Task Flow
- Members see projects → then tasks
- Clean and structured workflow

---

## 🛠️ Tech Stack

- Frontend: HTML, CSS, Bootstrap  
- Backend: PHP  
- Database: MySQL  

---

## 🗄️ Database Tables

- `users` → stores user details and roles  
- `projects` → project information  
- `tasks` → task details and assignments  
- `project_members` → relation between users and projects  

---

## ⚙️ Installation (Local Setup)

1. Clone the repository:
```bash
git clone https://github.com/hxrshittt/taskforge.git
