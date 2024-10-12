## How to Run
1. Clone the repository
2. Install Project Dependencies
```bash
composer install
php artisan jwt:secret
```
3. Create a database and update the .env file
4. Migrate the database
```bash
php artisan migrate
```
5. Start the server
```bash
php artisan serve
```

## API Endpoints
1. Register a new user
```bash
POST /api/register
```
2. Login a user
```bash
POST /api/login
```
3. Create Checklist
```bash
POST /api/todo-lists
```
4. Get all Checklists
```bash
GET /api/todo-lists
```
5. Get a single Checklist
```bash
GET /api/todo-lists/{id}
```
6. Update a Checklist
```bash
PUT /api/todo-lists/{id}
```
7. Delete a Checklist
```bash
DELETE /api/todo-lists/{id}
```
8. Create Item
```bash
POST /api/todo-lists/{id}/items
```
9. Get all Items
```bash
GET /api/todo-lists/{id}/items
```
10. Get a single Item
```bash
GET /api/todo-lists/{id}/items/{item_id}
```
11. Update an Item
```bash
PUT /api/todo-lists/{id}/items/{item_id}
```
12. Delete an Item
```bash
DELETE /api/todo-lists/{id}/items/{item_id}
```
13. Mark an Item as completed
```bash
PATCH /api/todo-lists/{id}/items/{item_id}
```