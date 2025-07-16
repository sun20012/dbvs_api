# Laravel 會員系統

這是一個完整的 Laravel 會員系統，支援前後端分離架構，提供 RESTful API 介面。

## 功能特色

### 🔐 會員管理
- **會員註冊**：支援 email、綽號、密碼註冊
- **會員登入**：使用 email 和密碼登入
- **信箱驗證**：註冊後需要驗證信箱才能正常登入
- **會員等級**：支援一般會員、管理員、超級管理員三種等級
- **API Token 認證**：使用 Laravel Sanctum 進行 API 認證

### 📧 信箱功能
- **自動發送驗證信件**：註冊後自動發送驗證信件
- **重新發送驗證**：支援重新發送驗證信件
- **驗證令牌過期**：驗證令牌 24 小時後自動過期
- **自訂郵件模板**：美觀的 HTML 郵件模板

### 🛡️ 安全性
- **密碼加密**：使用 Laravel 內建的 Hash 功能
- **密碼規則**：要求包含大小寫字母、數字，至少 8 字元
- **API Token 管理**：支援登出時清除 Token
- **信箱驗證**：防止未驗證信箱的會員登入

## 資料庫結構

### members 資料表
```sql
- id (主鍵)
- email (信箱，唯一)
- nickname (綽號)
- password (密碼，加密)
- level (會員等級：一般會員/管理員/超級管理員)
- email_verified_at (信箱驗證時間)
- email_verification_token (信箱驗證令牌)
- email_verification_expires_at (驗證令牌過期時間)
- is_active (是否啟用)
- last_login_at (最後登入時間)
- remember_token (記住我令牌)
- created_at, updated_at (時間戳記)
```

## API 端點

### 公開端點（無需認證）
- `POST /api/auth/register` - 會員註冊
- `POST /api/auth/login` - 會員登入
- `POST /api/auth/verify-email` - 信箱驗證
- `POST /api/auth/resend-verification` - 重新發送驗證信件

### 需要認證的端點
- `GET /api/auth/profile` - 取得會員資料
- `POST /api/auth/logout` - 會員登出

## 安裝與設定

### 1. 環境需求
- PHP 8.1+
- Laravel 10+
- MySQL 5.7+ 或 SQLite

### 2. 資料庫設定
在 `.env` 檔案中設定資料庫連線：
```env
DB_CONNECTION=mysql
DB_HOST=your_host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. 信箱設定
在 `.env` 檔案中設定信箱服務：
```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=dbvs506@gmail.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=dbvs506@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. 執行 Migration
```bash
php artisan migrate:fresh
```

### 5. 建立測試資料
```bash
php artisan db:seed --class=MemberSeeder
```

## 使用範例

### 會員註冊
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "nickname": "測試會員",
    "password": "Test123!",
    "password_confirmation": "Test123!"
  }'
```

### 會員登入
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "Admin123!"
  }'
```

### 取得會員資料
```bash
curl -X GET http://localhost:8000/api/auth/profile \
  -H "Authorization: Bearer YOUR_TOKEN"
```

## 測試帳號

系統預設建立以下測試帳號：

| 等級 | 信箱 | 密碼 | 綽號 |
|------|------|------|------|
| 超級管理員 | admin@example.com | Admin123! | 超級管理員 |
| 一般管理員 | manager@example.com | Manager123! | 一般管理員 |
| 一般會員 | user@example.com | User123! | 一般會員 |

## 開發注意事項

### 1. 信箱驗證
- 註冊後會自動發送驗證信件到 `dbvs506@gmail.com`
- 驗證連結會導向前端頁面進行驗證
- 前端需要實作驗證頁面來處理驗證流程

### 2. 會員等級
- 新註冊會員預設為「一般會員」
- 可以透過資料庫或管理介面升級會員等級
- 系統提供 `isAdmin()` 和 `isSuperAdmin()` 方法檢查權限

### 3. API 認證
- 使用 Laravel Sanctum 進行 API 認證
- 登入成功後會回傳 API Token
- 後續請求需要在 Header 中加入 `Authorization: Bearer {token}`

### 4. 錯誤處理
- 所有 API 都包含完整的錯誤處理
- 回傳統一的 JSON 格式
- 包含詳細的錯誤訊息和狀態碼

## 擴展功能

### 可擴展的功能
- 密碼重設功能
- 會員資料編輯
- 會員頭像上傳
- 登入記錄追蹤
- 會員權限管理
- 管理員後台介面

### 建議的改進
- 加入 Rate Limiting 防止暴力破解
- 實作 JWT Token 支援
- 加入雙因素認證 (2FA)
- 實作 OAuth 登入
- 加入會員活動日誌

## 授權

此專案採用 MIT 授權條款。 