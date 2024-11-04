## ola-ke-hace-xela Backend

This project is a REST API created with Laravel, that helps us to interact with a MariaDB Database environment running in Xampp.
This API REST, helps us to manage all the logic of a Server Side Event Publishing Application.

--------------------------------------------------------

## Sofware and Versions used in the Project.


* #### Xampp: v3.3.0
  * It contains Apache v2.4.58 that help us to run PHPMyAdmin. And MariaDB.
  
* #### MariaDB: v10.4.32
  * It's the Relational Database Engine that we used in this project.
  
* #### PHP: v8.2
  * We've chosen PHP since is a general-purpose scripting language and interpreter that is freely available and widely used for web development.
  
* #### Laravel: v11.9
  * This framework helped us to map the database with their models and makes easier with his ORM to interact with the database.
  
* #### Laravel Sanctum: v4.0
  * This middleware, help us to manage Server Side authenticaion. With tokens.
  
----------------------------------------
## API REST Endpoints

### Users
- `GET /v1/user`
- `GET /v1/user/{id}`
- `POST /v1/user`
- `PUT /v1/user/{id}`
- `DELETE /v1/user/{id}`

### Posts
- `GET /v1/post`
- `GET /v1/post/{id}`
- `GET /v1/post-approved`
- `GET /v1/post-notApproved`
- `POST /v1/post`
- `PUT /v1/post/{id}`
- `PUT /v1/post/increase-strike/{id}`
- `PUT /v1/post/approve-post/{id}`
- `DELETE /v1/post/{id}`

### User Roles
- `GET /v1/role`
- `GET /v1/role/{id}`
- `POST /v1/role`
- `PUT /v1/role/{id}`
- `DELETE /v1/role/{id}`

### Reports
- `GET /v1/report`
- `GET /v1/report/{id}`
- `GET /v1/report/post/{post_id}`
- `POST /v1/report`
- `PUT /v1/report/{id}`
- `DELETE /v1/report/{id}`

### Post Categories
- `GET /v1/post-category`
- `GET /v1/post-category/{id}`
- `POST /v1/post-category`
- `PUT /v1/post-category/{id}`
- `DELETE /v1/post-category/{id}`

### Notifications
- `GET /v1/notification`
- `GET /v1/notification/{id}`
- `GET /v1/notification/byUserId/{id}`
- `POST /v1/notification`
- `PUT /v1/notification/{id}`
- `PUT /v1/notification/markAllAsRead/{id}`
- `DELETE /v1/notification/{id}`

### Attendances
- `GET /v1/attendance`
- `GET /v1/attendance/byUsername/{user_username}`
- `GET /v1/attendance/byPost/{post_id}`
- `POST /v1/attendance`
- `PUT /v1/attendance/{id}`
- `DELETE /v1/attendance/{id}`

### Approved Posts
- `GET /v1/postsApproved`
- `GET /v1/postsApproved/{id}`
- `POST /v1/postsApproved`
- `PUT /v1/postsApproved/{id}`
- `DELETE /v1/postsApproved/{id}`

### Authentication
- `POST /login`
- `POST /register`
- `POST /profile`

### Password update
- `GET /update-passwords`

---------------------------------------------

## Helpful Tools

* #### Postman
  * You can use this software to test locally each endpoint. You must save the Bearer Token of the login endpoint response.

------------------------------------------------

## Ports

* #### This REST API runs locally in port 8000.
* #### You can run the Application by running this command in your console:
  * php artisan serve

------------------------------------------------

## Full Documentation

* #### For a full documentation experience, please read the file under Docs Folder with the name "Technical Manual".
    
--------------------------------------------------

## License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).

--------------------------------------------------

## Author

* #### Diego José Maldonado Monterroso.
* #### Carné: 201931811.
* #### Date: November 2024.
