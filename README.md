<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>




### Installation

After cloning the repository to your local machine, run the following commands to install the dependencies and set up the environment:
```sh
composer install 
```
```sh
php -r "file_exists('.env') || copy('.env.example', '.env');"
```
```sh
php artisan key:generate
```
###### I'm using sqlite as the database for this project. To create the database file, run the following command:
```sh
php artisan migrate
```
### Running the application
```sh
php artisan serve
```
### Testing
To run the tests, run the following command:
```sh
php artisan test
```
___

## Todo API Endpoints

Below is a list of API endpoints and their expected input and output:
### GET /todos
- Returns a list of all Todo items in the database.
- Each Todo item is represented as a JSON object with the following fields:
  - `id`: The unique identifier of the Todo item.
  - `title`: The title of the Todo item.
  - `completed`: A boolean indicating whether the Todo item is completed.
  - `created_at`: The date and time when the Todo item was created.
  - `updated_at`: The date and time when the Todo item was last updated

### POST /todos
- Creates a new Todo item in the database.
- Expects a JSON object with the following fields:
  - `title` (required): The title of the Todo item.
  - `completed` (optional): A boolean indicating whether the Todo item is completed.

### GET /todos/{id}
- Retrieves the Todo item with the specified ID.
- Returns a JSON object with the following fields:
  - `id`: The unique identifier of the Todo item.
  - `title`: The title of the Todo item.
  - `completed`: A boolean indicating whether the Todo item is completed.
  - `created_at`: The date and time when the Todo item was created.
  - `updated_at`: The date and time when the Todo item was last updated


### PUT /todos/{id}
- Updates the Todo item with the specified ID.
- Expects a JSON object with one or more of the following fields:
  - `title` (optional): The new title of the Todo item.
  - `completed` (optional): A boolean indicating whether the Todo item is completed.

### DELETE /todos/{id}
- Deletes the Todo item with the specified ID.
- Returns a 204 success response.

# Additional features to be added
- Dockerization
- Authentication
- Search
- Sorting
- Filtering
- Pagination
- Deployment
- Rate limiting
- Caching
- Logging

# License
This project is licensed under the MIT License 

