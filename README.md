# blogapp

```markdown
# Blog Application

Welcome to the Blog Application! This is a fully functional blog platform built using HTML, CSS, JavaScript, PHP, and SQL. IconScout is used for the icons throughout the application.

## Table of Contents
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features
- User authentication (sign up, login, logout)
- Create, read, update, and delete blog posts
- Comment on blog posts
- Responsive design
- User profile management
- Search functionality
- Rich text editor for creating posts
- IconScout icons for enhanced UI

## Technologies Used
- **Frontend**:
  - HTML5
  - CSS3
  - JavaScript (ES6)
  - IconScout (for icons)
  
- **Backend**:
  - PHP
  - SQL (MySQL or SQLite)
  
- **Tools and Libraries**:
  - TinyMCE (for rich text editing)
  - PHP PDO (for database interaction)
  - IconScout (for icons)

## Installation

### Prerequisites
- A web server with PHP support (e.g., Apache, Nginx)
- A database server (e.g., MySQL, SQLite)
- Composer (for dependency management)

### Steps
1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/blog-application.git
   cd blog-application
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up the database**:
   - Create a database and import the SQL schema:
     ```sql
     CREATE DATABASE blog_db;
     USE blog_db;
     SOURCE path/to/schema.sql;
     ```

4. **Configure the application**:
   - Copy the `.env.example` file to `.env` and update the configuration settings:
     ```env
     DB_HOST=localhost
     DB_NAME=blog_db
     DB_USER=root
     DB_PASS=password
     ```

5. **Start the development server**:
   - If using PHP's built-in server, run:
     ```bash
     php -S localhost:8080
     ```

## Usage
- **Home Page**: Displays the latest blog posts.
- **Sign Up / Login**: Allows users to create an account and log in.
- **Create Post**: Authenticated users can create new blog posts using a rich text editor.
- **Edit/Delete Post**: Authenticated users can edit or delete their own posts.
- **Comment on Post**: Users can comment on blog posts.
- **User Profile**: Users can view and edit their profile information.
- **Search**: Users can search for blog posts by keywords.

## Contributing
1. **Fork the repository**
2. **Create a new branch**:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. **Make your changes**
4. **Commit your changes**:
   ```bash
   git commit -m "Add some feature"
   ```
5. **Push to the branch**:
   ```bash
   git push origin feature/your-feature-name
   ```
6. **Create a pull request**

## License
No License.

## Acknowledgements
- Icons by [IconScout](https://iconscout.com)
```
