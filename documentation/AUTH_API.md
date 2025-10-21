# Authentication API Documentation

This document describes the authentication endpoints for the Jos Metro BOSS system.

## Base URL
```
http://localhost:8000/api
```

## Endpoints

### 1. Register
**POST** `/auth/register`

Register a new user account.

#### Request Body
```json
{
  "name": "string (required)",
  "email": "string (required, valid email format)",
  "password": "string (required, minimum 8 characters)",
  "password_confirmation": "string (required, must match password)",
  "phone": "string (optional)"
}
```

#### Success Response
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+2341234567890",
      "role": null,
      "points": 0,
      "avatar": null,
      "google_id": null,
      "email_verified_at": null,
      "created_at": "2025-10-20T10:00:00.000000Z",
      "updated_at": "2025-10-20T10:00:00.000000Z"
    }
  }
}
```

### 2. Login
**POST** `/auth/login`

Authenticate a user and start a session.

#### Request Body
```json
{
  "email": "string (required)",
  "password": "string (required)"
}
```

#### Success Response
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+2341234567890",
      "role": null,
      "points": 0,
      "avatar": null,
      "google_id": null,
      "email_verified_at": null,
      "created_at": "2025-10-20T10:00:00.000000Z",
      "updated_at": "2025-10-20T10:00:00.000000Z"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz1234567890"
  }
}
```

### 3. Get User
**GET** `/user`

Get the authenticated user's information.

#### Headers
```
Authorization: Bearer {token}
```

#### Success Response
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+2341234567890",
      "role": null,
      "points": 0,
      "avatar": null,
      "google_id": null,
      "email_verified_at": null,
      "created_at": "2025-10-20T10:00:00.000000Z",
      "updated_at": "2025-10-20T10:00:00.000000Z"
    }
  }
}
```

### 4. Logout
**POST** `/logout`

Log out the authenticated user.

#### Headers
```
Authorization: Bearer {token}
```

#### Success Response
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

### 5. Forgot Password
**POST** `/auth/forgot-password`

Send a password reset link to the user's email.

#### Request Body
```json
{
  "email": "string (required)"
}
```

#### Success Response
```json
{
  "success": true,
  "message": "Password reset link sent to your email"
}
```

### 6. Resend Verification Email
**POST** `/auth/resend-verification`

Resend the email verification link to the user's email.

#### Headers
```
Authorization: Bearer {token}
```

#### Success Response
```json
{
  "success": true,
  "message": "Verification email resent successfully"
}
```

### 7. Verify Email
**GET** `/auth/verify-email/{id}/{hash}`

Verify a user's email address.

#### Success Response
```json
{
  "success": true,
  "message": "Email verified successfully"
}
```

### 8. Google OAuth Redirect
**GET** `/auth/redirect`

Redirect user to Google for authentication.

#### Success Response
Redirects to Google OAuth page.

## Error Responses

### Validation Errors (422)
```json
{
  "success": false,
  "message": "Validation errors",
  "errors": {
    "field_name": [
      "Error message"
    ]
  }
}
```

### Authentication Errors (401)
```json
{
  "success": false,
  "message": "Invalid credentials",
  "errors": {
    "email": [
      "The provided credentials are incorrect."
    ]
  }
}
```

## Environment Variables

For Google OAuth to work, you need to set the following environment variables in your `.env` file:

```
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/api/auth/callback
```
