# **Kanban Board** 🏗️

A dynamic Kanban board built with Laravel and Vue.js to manage tasks efficiently across multiple columns.

## **Features** ✨

✅ Create, edit, and delete tasks  
✅ Drag and drop tasks between columns
✅ RESTful API for task management

## **Tech Stack** 🛠️

-   **Backend:** Laravel
-   **Frontend:** Vue.js
-   **Database:** MySQL

## **Screenshots** 📸

Take a look at some of the key features:

![Dashboard View](resources/screenshots/dashboard.png)  
_Overview of the Kanban dashboard_

![Kanban Board](resources/screenshots/kanban.png)  
_Tasks organized in columns, ready for drag and drop_

![Theme Customization](resources/screenshots/theme.png)  
_Theme customization options_

![User Management](resources/screenshots/user.png)  
_Manage user profiles and permissions_

## **Installation** ⚙️

1. Clone the repository:
    ```sh
    git clone https://github.com/ilxBoschetto/kan-ban_laravel_vue.git
    cd kan-ban_laravel_vue
    ```
2. Install dependencies:
    ```sh
    composer install
    npm install
    ```
3. Configure the environment file:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```
4. Set up the database and run migrations:
    ```sh
    php artisan migrate --seed
    ```
5. Start the development server:
    ```sh
    php artisan serve
    npm run dev
    ```

## **Usage** 🚀

-   Create columns for different stages of work
-   Add tasks to specific columns
-   Drag and drop tasks between columns to update their status
-   Delete tasks when completed
-   Have a generic dashboard
-   Change user settings
-   Change theme
