# Laravel 8.X REST API With API Authentication
A PHP Laravel Authentication API with username, password verification, developed with Laravel 8.x framework.

## Application screen

- Login
    ![Login screen](loginscreen.PNG "Login screen")
    
- Login Validation
    ![Login with_validation](loginValidation.PNG "Login with validation")
    
- Register new member
    ![register_new_member](registerNewMember.PNG "Register new member")
    
- Homepage
    ![home_page](homePageTest.PNG "Register new member")

## Resources

This project was created in 2 parts
- <b>Backend</b>: Use laravel framework 8.x to create API, using JWT for Authentication
- <b>Frontend</b>: Use Vue, Vuex, Vue-router, Bootstrap... to call API from backend

## Installation steps

Follow the bellow steps to install and set up the application.

**Step 1: Clone the Application**<br>
You can download the ZIP file or git clone from my repo into your project  directory.

**Step 2: Configure the Application**<br>
After you clone the repo in to your project folder the project need to be set up by following commands-

- In terminal go to your project directory and Run 
    
        composer install 
    
- Then copy the .env.example file to .env file in the project root folder

- Edit the .env file and fill all required data for the bellow variables
    
        APP_URL=http://localhost //your application domain URL go here
    
        DB_HOST=127.0.0.1 // Your DB host IP. Here we are assumed it to be local host
        DB_PORT=3306 //Port if you are using except the default
        DB_DATABASE=name_of_your_database
        DB_USERNAME=db_user_name
        DB_PASSWORD=db_password
    
- To set the Application key run the bellow command in your terminal.
    
        php artisan key:generate

**Step 3: Run docker environment (by default your environment has docker installed)**<br>

- Fill default data if your need by running bellow command.

        ./vendor/bin/sail up
        
- The next, check docker container running in server
        
        docker ps
    
        
**Step 4: Run migration**<br>

- Make your storage and bootstrapp folder writable by your application user.

- Create all the necessary tables need for the application by runing the bellow command.
    
        php artisan migrate


## API Endpoints and Routes

Laravel follows the Model View Controller (MVC) pattern I have created models associated with each resource. You can check in the **routes/api.php** file for all the routes that map to controllers in order to send out JSON data that make requests to our API.

Bellow are the all resources API endpoints - 

        POST    | api/regis/regis-account
        ```
        {
            "username": "test",
            "password": "Abc@123456789#"
        }
        ```
        
        POST    | api/auth/login
        ```
        {
            "username": "test",
            "password": "Abc@123456789#"
        }
        
        
        POST    | api/auth/logout
        ```
        Authorization: `Bearer access_token_result_after_login `
        ```

## Install for frontend

- Fill default data if your need by running bellow command.

        npm i

- The next for run application

        npm run dev
        
Open application in browser for use       
Thats all! The application is configured now.
