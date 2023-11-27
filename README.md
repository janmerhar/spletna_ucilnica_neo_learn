# Spletna Učilnica Neo Learn Documentation

## Table of Contents

- [Spletna Učilnica Neo Learn Documentation](#spletna-učilnica-neo-learn-documentation)
  - [Table of Contents](#table-of-contents)
  - [Introduction](#introduction)
  - [Installation and Setup](#installation-and-setup)
    - [Prerequisites](#prerequisites)
    - [Steps](#steps)
  - [Features](#features)
  - [ER diagram](#er-diagram)
  - [Directory Structure](#directory-structure)
  - [Usage](#usage)
  - [Contributing](#contributing)

## Introduction

"Spletna Učilnica Neo Learn" is a web-based learning platform designed to facilitate online education. The platform offers a range of features to enhance the learning experience for both educators and students.

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

- User authentication and registration
- Creation and management of online classrooms
- Test creation and grading
- Content management for each classroom
- User roles and permissions

## ER diagram

![ER diagram]('./../docs/ERDiagram.png')

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
