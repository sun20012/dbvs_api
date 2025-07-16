# 會員系統 API 測試文件

## 基礎 URL
```
http://localhost:8000/api
```

## 1. 會員註冊
**POST** `/auth/register`

**請求內容：**
```json
{
    "email": "test@example.com",
    "nickname": "測試會員",
    "password": "Test123!",
    "password_confirmation": "Test123!"
}
```

**回應範例：**
```json
{
    "success": true,
    "message": "註冊成功，請查收信箱進行驗證",
    "data": {
        "member_id": 4,
        "email": "test@example.com",
        "nickname": "測試會員"
    }
}
```

## 2. 會員登入
**POST** `/auth/login`

**請求內容：**
```json
{
    "email": "admin@example.com",
    "password": "Admin123!"
}
```

**回應範例：**
```json
{
    "success": true,
    "message": "登入成功",
    "data": {
        "token": "1|abc123...",
        "member": {
            "id": 1,
            "email": "admin@example.com",
            "nickname": "超級管理員",
            "level": "超級管理員",
            "last_login_at": "2025-07-10T13:45:00.000000Z"
        }
    }
}
```

## 3. 信箱驗證
**POST** `/auth/verify-email`

**請求內容：**
```json
{
    "token": "驗證令牌"
}
```

**回應範例：**
```json
{
    "success": true,
    "message": "信箱驗證成功",
    "data": {
        "member_id": 4,
        "email": "test@example.com"
    }
}
```

## 4. 重新發送驗證信件
**POST** `/auth/resend-verification`

**請求內容：**
```json
{
    "email": "test@example.com"
}
```

**回應範例：**
```json
{
    "success": true,
    "message": "驗證信件已重新發送"
}
```

## 5. 取得會員資料
**GET** `/auth/profile`

**Headers：**
```
Authorization: Bearer {token}
```

**回應範例：**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "email": "admin@example.com",
        "nickname": "超級管理員",
        "level": "超級管理員",
        "email_verified_at": "2025-07-10T13:30:00.000000Z",
        "last_login_at": "2025-07-10T13:45:00.000000Z",
        "created_at": "2025-07-10T13:30:00.000000Z"
    }
}
```

## 6. 會員登出
**POST** `/auth/logout`

**Headers：**
```
Authorization: Bearer {token}
```

**回應範例：**
```json
{
    "success": true,
    "message": "登出成功"
}
```

## 測試帳號
- **超級管理員**: admin@example.com / Admin123!
- **一般管理員**: manager@example.com / Manager123!
- **一般會員**: user@example.com / User123!

## 注意事項
1. 所有密碼必須包含大小寫字母、數字，且至少 8 個字元
2. 註冊後需要驗證信箱才能登入
3. 驗證令牌有效期限為 24 小時
4. API Token 用於後續的認證請求 