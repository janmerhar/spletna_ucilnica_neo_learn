# Spletna Učilnica Neo Learn Documentation

Spletna Učilnica Neo Learn is a web-based learning platform designed to facilitate online education. The platform offers a range of features to enhance the learning experience for both educators and students.

## Table of Contents

- [Spletna Učilnica Neo Learn Documentation](#spletna-učilnica-neo-learn-documentation)
  - [Table of Contents](#table-of-contents)
  - [Installation and Setup](#installation-and-setup)
    - [Prerequisites](#prerequisites)
    - [Steps](#steps)
  - [Features](#features)
    - [User authentication and registration](#user-authentication-and-registration)
      - [Login](#login)
      - [Registration](#registration)
      - [Confirmation email](#confirmation-email)
    - [Creation of online classrooms](#creation-of-online-classrooms)
      - [Private classrooms](#private-classrooms)
    - [Exam creation and grading](#exam-creation-and-grading)
      - [Exam creation](#exam-creation)
      - [Exam management](#exam-management)
      - [Exam grades view](#exam-grades-view)
      - [Exam taking](#exam-taking)
    - [Content management for each classroom](#content-management-for-each-classroom)
      - [Classroom content](#classroom-content)
    - [User roles and permissions](#user-roles-and-permissions)
      - [Classroom owner content overview](#classroom-owner-content-overview)
      - [Enrolled students overview](#enrolled-students-overview)
  - [ER diagram](#er-diagram)
  - [Directory Structure](#directory-structure)
  - [Usage](#usage)
  - [Contributing](#contributing)

## Installation and Setup

### Prerequisites

- PHP
- Composer
- Node.js

### Steps

1. **Clone the Repository**:

   ```bash
   git clone https://github.com/janmerhar/spletna_ucilnica_neo_learn.git
   ```

1. **Navigate to the Project Directory**:

   ```bash
   cd spletna_ucilnica_neo_learn
   ```

1. **Install PHP Dependencies**:

   ```bash
   cd php
   composer install
   ```

1. **Install JavaScript Dependencies**:

   ```bash
   cd src
   npm install
   ```

1. **Compile the Vue App**:
   Vue uses a build system to compile the app into static assets that can be served by any web server. To compile and minify the app for production, run:

   ```bash
   npm run build
   ```

   This command will create a `dist/` directory containing the compiled assets.

1. **Run the SQL Script**:
   Execute the SQL script located in `_SQL/learn.sql` to set up the database.

1. **Configure the Database Connection**:
   Update the database connection details in `php/libraries/dbconnect.php`.

1. **Start the Application**:
   Depending on your setup, you can use a local server or a dedicated server to serve the application. Ensure that the server points to the dist/ directory (or wherever your compiled assets are located) for the frontend and appropriately routes API requests to the PHP backend.

## Features

### User authentication and registration

Spletna Učilnica Neo Learn offers user authentication and registration. Users can register for a new account and log in to the application. The application uses JSON Web Tokens (JWT) for authentication.

#### Login

The login page allows users to log in to the application. Users can log in using their username and password.

![Login page](./docs/screenshots/AuthLogin.png?raw=true "Login page")

#### Registration

The registration page allows users to register for a new account.

![Registration page](./docs/screenshots/AuthRegister.png?raw=true "Registration page")

If the username is already taken, the user will be notified to choose a different username.

![Username taken](./docs/screenshots/AuthRegisterUsernameTaken.png?raw=true "Username taken")

#### Confirmation email

When a user registers for a new account, a confirmation email is sent to the user's email address. The email contains a link that the user can click to confirm their email address.

![Confirmation email](./docs/screenshots/AuthRegisterEmail.png?raw=true "Confirmation email")

### Creation of online classrooms

![Home page](./docs/screenshots/HomePage.png?raw=true "Home page")

Users can create online classrooms. The classrooms can be used to share content and exams with students. The classrooms can be public or private. Public classrooms are visible to all users, while private classrooms are only visible to the classroom owner and the students that have been added to the classroom.

![Classroom creation](./docs/screenshots/ClassroomCreate.png?raw=true "Classroom creation")

#### Private classrooms

In order for users to be able to join a private classroom, they need to know the classroom code. The classroom code is generated when the classroom is created and can be found in the classroom settings.

![Classroom code](./docs/screenshots/ClassroomPrivateForm.png?raw=true "Classroom code")

### Exam creation and grading

Classroom owners can create exams for their students. The exams can be graded automatically or manually.

#### Exam creation

Classroom owners can create exams for their students. The exams will be graded automatically based on the correct answers provided by the classroom owner.

![Exam creation](./docs/screenshots/ExamCreate.png?raw=true "Exam creation")

#### Exam management

Classroom owners can view and manage the exams they have created. They can view the results of the exams and grade them manually if necessary.

![Exam control panel](./docs/screenshots/ExamControlPanel.png?raw=true "Exam control panel")

#### Exam grades view

Students can view the results of the exams they have taken. They also can view what exams are available to them.

![Exam overview](./docs/screenshots/ExamOverview.png?raw=true "Exam overview")

#### Exam taking

Students can take the exams that are available to them. The exams are graded automatically.

![Exam taking](./docs/screenshots/ExamTakeAssesment.png?raw=true "Exam taking")

### Content management for each classroom

#### Classroom content

Each classroom can contain content. The content can be in the form of text, images, or files. The content can be added to the classroom by the classroom owner. The content can be viewed by the students that have been added to the classroom.

![Classroom content](./docs/screenshots/ClassroomNoContent.png?raw=true "Classroom content")

### User roles and permissions

The application has two user roles: student and classroom owner. Classroom owners can create classrooms, add content to the classrooms, create exams, and view the results of the exams. Students can view the content of the classrooms they have been added to and take the exams that are available to them.

#### Classroom owner content overview

Classroom owners can modify the classroom content, create exams, and view the results of the exams.

![Classroom owner overview](./docs/screenshots/ClassroomWithContent.png?raw=true "Classroom owner overview")

#### Enrolled students overview

Classroom owners can view the students that have been added to the classroom. They also have ability to remove students from the classroom.

![Enrolled students overview](./docs/screenshots/ClassroomEnrolledStudents.png?raw=true "Enrolled students overview")

## ER diagram

![ER diagram](./docs/diagrams/database/ERDiagram.png?raw=true "ER diagram")

## Directory Structure

- `_SQL/`: SQL script for database setup.
- `_uploads/`: Directory for uploaded files.
- `php/`: Contains PHP scripts for backend functionality.
- `public/`: Public assets like CSS and images.

- `src/`: Vue.js frontend source code.
  - `components/`: Vue components used throughout the application.
  - `views/`: Vue views or pages.
  - `routes/`: Vue Router routes.
  - `store/`: Vuex store for state management.

## Usage

1. Start PHP and MySQL servers
2. Open appliaction in browser
3. Register a new account
4. Create a new classroom
5. Add content to the classroom
6. Add students to the classroom
7. Create a test
8. Take the test
9. Grade the test
10. View the results

## Contributing

To contribute to this project follow these steps:

1. Fork the repository
2. Create feature branch (`git checkout -b feature/NewFeature`)
3. Commit changes (`git commit -m 'Add some changes'`)
4. Push to the branch (`git push origin feature/NewFeature`)
5. Open a pull request
