# 會員系統測試帳號

## 測試帳號清單

### 管理員帳號
| 等級 | 信箱 | 密碼 | 綽號 | 狀態 |
|------|------|------|------|------|
| 超級管理員 | admin@example.com | Test123 | 超級管理員 | 已驗證，啟用 |
| 一般管理員 | manager@example.com | Test123 | 一般管理員 | 已驗證，啟用 |

### 一般會員帳號
| 信箱 | 密碼 | 綽號 | 狀態 |
|------|------|------|------|
| user@example.com | Test123 | 一般會員 | 已驗證，啟用 |
| test@example.com | Test123 | 測試 | 已驗證，啟用 |
| test1@example.com | Test123 | 測試會員1 | 已驗證，啟用 |
| test2@example.com | Test123 | 測試會員2 | 已驗證，啟用 |

### 特殊狀態帳號
| 信箱 | 密碼 | 綽號 | 狀態 | 說明 |
|------|------|------|------|------|
| unverified@example.com | Test123 | 未驗證會員 | 未驗證，啟用 | 測試信箱驗證功能 |
| disabled@example.com | Test123 | 停用會員 | 已驗證，停用 | 測試停用帳號功能 |

## API 測試範例

### 1. 會員登入（成功案例）
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "Test123"
  }'
```

### 2. 會員登入（未驗證信箱）
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "unverified@example.com",
    "password": "Test123"
  }'
```

### 3. 會員登入（停用帳號）
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "disabled@example.com",
    "password": "Test123"
  }'
```

### 4. 會員註冊（新帳號）
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "email": "newuser@example.com",
    "nickname": "新會員",
    "password": "NewUser123",
    "password_confirmation": "NewUser123"
  }'
```

## 測試重點

1. **正常登入**：使用 admin@example.com 或 user@example.com
2. **信箱驗證**：使用 unverified@example.com 測試未驗證登入限制
3. **帳號停用**：使用 disabled@example.com 測試停用帳號登入限制
4. **權限測試**：比較不同等級會員的權限差異
5. **信箱驗證流程**：註冊新帳號後測試驗證流程

## 注意事項

- 所有測試帳號的密碼都是 `Test123`
- 新註冊的會員預設為「一般會員」等級
- 未驗證信箱的會員無法正常登入
- 停用的會員無法登入
- 所有 API 回應都包含 `success` 欄位表示操作結果 