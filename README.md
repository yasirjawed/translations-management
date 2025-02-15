# **Laravel Translation Management System**

## **Overview**

The **Laravel Translation Management System** is a RESTful API built with **Laravel 11** to manage multilingual translations efficiently. It follows **SOLID principles**, utilizes **optimized SQL queries**, and includes features like **token-based authentication, OpenAPI documentation, and high test coverage**.

## **Features**

**RESTful API for managing translations**  
**Token-based authentication using Laravel Sanctum**  
**Optimized SQL queries & pagination**  
**JSON export of translations for external use**
**High test coverage (>95%) with PestPHP & PHPUnit**  
**Swagger/OpenAPI documentation for API reference**  
**Queue handling using Redis for background jobs**

---

## **Installation & Setup**

### **1. Clone the Repository**

```bash
git clone https://github.com/yasirjawed/translations-management.git
cd translations-management
```

### **2. Install Dependencies**

```bash
composer install
```

### **3. Set Up Environment**

Copy the `.env.example` file and configure the database settings:

```bash
cp .env.example .env
```

Edit `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=translation_db
DB_USERNAME=root
DB_PASSWORD=secret
```

### **4. Run Migrations & Seed Database**

```bash
php artisan migrate --seed
```

### **5. Generate API Documentation (Swagger/OpenAPI)**

```bash
php artisan l5-swagger:generate
```

Access the documentation at:  
👉 `http://localhost/api/documentation`

### **6. Start the Development Server**

```bash
php artisan serve
```

API is now accessible at:  
👉 `http://localhost/api`

---

## **Authentication (Sanctum Token-Based Login)**

### **Register a User**

```bash
curl -X POST "http://localhost/api/register" \
-H "Content-Type: application/json" \
-d '{"name": "John Doe", "email": "john@example.com", "password": "password"}'
```

### **Login and Get Token**

```bash
curl -X POST "http://localhost/api/login" \
-H "Content-Type: application/json" \
-d '{"email": "john@example.com", "password": "password"}'
```

_Response:_

```json
{
    "token": "your-access-token"
}
```

Use this token in the `Authorization` header for protected endpoints.

---

## **API Endpoints**

### **Public Endpoints**

| Method | Endpoint        | Description                   |
| ------ | --------------- | ----------------------------- |
| POST   | `/api/register` | Register a new user           |
| POST   | `/api/login`    | Authenticate user & get token |

### **Protected Endpoints (Require Token)**

| Method | Endpoint                   | Description                    |
| ------ | -------------------------- | ------------------------------ |
| GET    | `/api/translations`        | Fetch all translations         |
| POST   | `/api/translations`        | Create a new translation       |
| PUT    | `/api/translations/{id}`   | Update an existing translation |
| GET    | `/api/translations/export` | Export translations as JSON    |

For detailed API usage, refer to the **Swagger Documentation**:  
👉 `http://localhost/api/documentation`

---

## **Running Tests**

To run **unit & feature tests**:

```bash
php artisan test
```

Or, using **PestPHP**:

```bash
vendor/bin/pest
```

---

## **Docker Setup (Optional for Deployment)**

If you want to use **Docker**, run:

```bash
docker-compose up -d
```

---

## **Contributing**

Feel free to fork this repository and submit pull requests!  
For major changes, please open an issue first to discuss what you'd like to change.

---

## **License**

This project is licensed under the **MIT License**.

---

## **Contact**

👨‍💻 **Yasir M. Jawed**  
📧 Email: [Your Email]  
🔗 GitHub: [https://github.com/yasirjawed](https://github.com/yasirjawed)
