# Project Documentation: Mathematics Platform

The project is an interactive math learning platform that allows teachers to assign tasks, and students to solve them and track their statistics.

---

## 🛠 Technologies
- **Backend:** PHP 8.x + Laravel 8
- **Frontend:** Blade, Tailwind CSS 3, Alpine.js, Laravel Mix
- **Database:** SQLite
- **Styling:** Custom CSS stylesheets (`site.css`, `card.css`, etc.) integrated with Tailwind.

---

## 🚀 How to Run the Project
If you already have PHP, Composer, and Node.js installed, follow these steps in the `project/` directory:

1. **Install PHP dependencies:**
   ```bash
   composer install
   ```
2. **Install JS dependencies and compile:**
   ```bash
   npm install
   npm run dev
   ```
3. **Environment configuration:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Database (SQLite):**
   ```bash
   touch database/database.sqlite
   php artisan migrate:fresh --seed
   ```
5. **Start the server:**
   ```bash
   php artisan serve
   ```
   The application will be available at: `http://127.0.0.1:8000`

---

## 🐍 Python in the Project (Graded Assignment)

This mathematics platform is part of a **graded assignment for a Python programming course**. This language plays a key role as an analytical and supporting backend, expanding the capabilities of the main application written in PHP.

**Main areas of Python usage in the project:**
- **Data Analysis and Statistics:** Processing and aggregating student results, generating advanced statistics (e.g., using libraries such as `pandas` or `matplotlib`), which supports the teacher's dashboard.
- **Automated Support Scripts:** Streamlining development processes, automating the evaluation of solutions, and managing the database (including batch loading of tasks).
- **Background Processing:** Executing tasks with high computational complexity without overloading the main HTTP server in Laravel.

**Instructions for running and configuring the Python environment:**
- Running support scripts should always be done in an isolated virtual environment (recommended: `venv` or `conda`).
- A full list of dependencies can be found in the `requirements.txt` file. Install them using the command: `pip install -r requirements.txt`.
- For the sake of order and code integrity, environment folders (e.g., `venv/`, `.env/`) and sensitive configuration/test files are automatically ignored by the version control system (`.gitignore`).

---

## 📝 Features
- Solving tasks (Closed, Open, True/False).
- Previewing student statistics.
- Teacher dashboard for managing the list of students and tasks.
- Random task on the main page for logged-in users.

---
**Author:** Adamiak Filip

---

## 📖 Detailed View Specification

### Welcome:
- Start view with a description of the site, its functionality, and login/register buttons.

### Registration:
- Initial view with a choice of student/teacher, information on what the given permissions do, and a "next" button which, depending on the role, displays the student/teacher registration.
- **Student registration:** first name, last name, teacher_id, email, password, password confirmation, register button.
- **Teacher registration:** first name, last name, email, password, password confirmation, register button.

### Login:
- Form with email, password fields and a login button (or a sliding login on the welcome page – done in JavaScript).

### Main Page:
#### Student:
- Brief description of the site and its purpose.
- ?Random task to solve (ABCD only, probably one per login – only one task to solve during a single session - after submission, correct answer marked green and incorrect red, and border color changed to green/red depending on the task correctness)?
- Top menu bar: statistics, my tasks, and logo/"hello first name last name", logout.
- Quick summary.

#### Teacher:
- Brief description of the site and its purpose.
- List of students assigned to the teacher (or a few students with the option to go to a page displaying the full list of students – next to each student, the ability to preview the student's page view from the teacher's perspective (!different from what the student sees!) with tasks to do/solved, "delete task" button and statistics);
- Top menu bar: statistics, tasks, logo/"hello first name last name", teacher_id, logout.
- Quick summary.

### My Tasks:
#### Student:
- Displaying the first few tasks to do with a "show all" option -> using javascript, solve the task and submit the answer.
- Displaying the first few completed and graded tasks with a "show all" option -> using javascript, display the solved task with the submitted answer and the correct answer (title, instruction, given answer, due date, submission date, correct answer).
- After clicking "show all", redirect to the task list page (`index.blade.php`).

#### Teacher:
- View tasks -> list of all tasks added by a given teacher with the ability to view, edit, and delete a task.
- "Assign task" button -> form:
- Displaying a list of students as checkboxes.
- Task title selection.
- Due date.
- Create task -> form:
	- First view with task type selection.
	- Depending on the selection, redirect to a page with the appropriate form (task title, task content, ?correct answer?, in ABCD: incorrect answers, submit).
- Review submitted tasks (display three with the option to go to the list).

### Statistics: (separate or on the main page depending on the number of charts)
- Quick summary once again at the top of the page.
- Various charts, etc.
