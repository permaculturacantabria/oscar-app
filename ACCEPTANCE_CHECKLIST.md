# Oscar App - Feature Tests Acceptance Checklist

## Prerequisites
- [ ] Laravel application installed and configured
- [ ] Database configured and migrations run
- [ ] Queue system configured (sync for testing)
- [ ] Postman collection imported

## Setup Commands
```bash
# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Run seeders (if any)
php artisan db:seed

# Start the application
php artisan serve
```

## Feature Tests

### 1. Crear Proceso ⇒ 10 sesiones pendientes con nombres correctos y mismo usuario/escucha

**Test Case:** `ProcesoTest::test_creating_proceso_creates_ten_pending_sessions_with_correct_names_and_same_user_escucha`

**API Call:**
```bash
POST /api/v1/procesos
Authorization: Bearer {token}
Content-Type: application/json

{
  "escucha_id": 1,
  "nombre_proceso": "Test Process"
}
```

**Expected Response (201):**
```json
{
  "id": 1,
  "usuario_id": 1,
  "escucha_id": 1,
  "nombre_proceso": "Test Process",
  "fecha_creacion": "2024-01-01T00:00:00.000000Z",
  "escucha": {
    "id": 1,
    "nombre_asignado": "Test Escucha"
  }
}
```

**Database Assertions:**
- [ ] Proceso created with correct usuario_id, escucha_id, nombre_proceso
- [ ] 10 Sesiones created with:
  - Same usuario_id and escucha_id as proceso
  - Correct names: "Tema – Test Process", "Memorias tempranas – Test Process", etc.
  - tipo_sesion: "proceso_10_pasos"
  - estado: "pendiente"
  - fecha: incremental from today
  - hora: "10:00"
  - duracion: 60

### 2. Vinculación por teléfono: crear Escucha y luego Usuario con mismo número ⇒ se completa id_usuario_real

**Test Case:** `PhoneLinkingTest::test_creating_user_with_same_phone_as_existing_escucha_links_them`

**API Calls:**
```bash
# First, create Escucha (assuming authenticated user)
POST /api/v1/escuchas
Authorization: Bearer {token}
Content-Type: application/json

{
  "nombre_asignado": "Test Escucha",
  "telefono": "+34612345678"
}

# Then register User with same phone
POST /api/v1/register
Content-Type: application/json

{
  "telefono": "+34612345678",
  "email": "test@example.com",
  "nombre": "Test User",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Expected Response (201):**
```json
{
  "user": {
    "id": 2,
    "telefono": "+34612345678",
    "email": "test@example.com",
    "nombre": "Test User"
  },
  "token": "..."
}
```

**Database Assertions:**
- [ ] Escucha's id_usuario_real field updated to match the new User's id

### 3. Crear Sesión con "texto nuevo" de un catálogo ⇒ se crea entrada y se asigna FK (scoped por usuario)

**Test Case:** `SesionTest::test_creating_sesion_with_new_catalog_text_creates_entry_and_assigns_fk_scoped_by_user`

**API Call:**
```bash
POST /api/v1/sesiones
Authorization: Bearer {token}
Content-Type: application/json

{
  "usuario_id": 1,
  "escucha_id": 1,
  "nombre_sesion": "Test Session",
  "tipo_sesion": "individual",
  "estado": "pendiente",
  "fecha": "2024-01-01",
  "hora": "10:00",
  "duracion": 60,
  "tema": "New Theme Text",
  "restimulacion": "New Restimulation Text"
}
```

**Expected Response (201):**
```json
{
  "id": 1,
  "usuario_id": 1,
  "escucha_id": 1,
  "nombre_sesion": "Test Session",
  "tema_id": 1,
  "restimulacion_id": 1,
  ...
}
```

**Database Assertions:**
- [ ] Sesion created with tema_id and restimulacion_id set
- [ ] Tema record created with texto="New Theme Text" and user_id matching authenticated user
- [ ] Restimulacion record created with texto="New Restimulation Text" and user_id matching authenticated user

### 4. Seguridad: un usuario no puede ver/modificar recursos de otro

**Test Cases:**
- `ProcesoTest::test_user_cannot_create_proceso_for_escucha_they_dont_own`
- `ProcesoTest::test_user_cannot_view_another_users_procesos`
- `SesionTest::test_user_cannot_create_sesion_for_escucha_they_dont_own`
- `SesionTest::test_user_cannot_view_another_users_sesiones`
- `SesionTest::test_user_cannot_update_another_users_sesion`

**API Calls to Test:**
```bash
# Try to create proceso for another user's escucha
POST /api/v1/procesos
Authorization: Bearer {user1_token}
Content-Type: application/json

{
  "escucha_id": 2,  // belongs to user2
  "nombre_proceso": "Unauthorized Process"
}
```

**Expected Response (404):**
```json
{
  "error": "Escucha not found or does not belong to user"
}
```

```bash
# Try to view another user's procesos
GET /api/v1/procesos
Authorization: Bearer {user1_token}
```

**Expected Response (200):** Only user's own procesos returned, none from user2

## Running Tests

```bash
# Run all feature tests
php artisan test --testsuite=Feature

# Run specific test class
php artisan test tests/Feature/Api/V1/ProcesoTest.php

# Run specific test method
php artisan test --filter test_creating_proceso_creates_ten_pending_sessions_with_correct_names_and_same_user_escucha
```

## Postman Collection

Import `postman_collection.json` into Postman to test the API endpoints interactively.

**Environment Variables:**
- `base_url`: http://localhost:8000
- `token`: Set this after login/register to authenticate requests

## Additional Notes

- All catalog entries are scoped by user_id to ensure data isolation
- Phone linking happens automatically via observers when users or escuchas are created/updated
- Security is enforced through policies and controller validation
- The 10-step process creates sessions with specific naming convention and scheduling