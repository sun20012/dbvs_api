<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 會員等級常數
     */
    const LEVEL_NORMAL = '一般會員';
    const LEVEL_ADMIN = '管理員';
    const LEVEL_SUPER_ADMIN = '超級管理員';

    /**
     * 可填充的欄位
     */
    protected $fillable = [
        'email',
        'nickname',
        'password',
        'level',
        'email_verified_at',
        'email_verification_token',
        'email_verification_expires_at',
        'is_active',
        'last_login_at',
    ];

    /**
     * 隱藏的欄位
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verification_token',
    ];

    /**
     * 轉換的欄位
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_verification_expires_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * 取得會員等級列表
     */
    public static function getLevels(): array
    {
        return [
            self::LEVEL_NORMAL,
            self::LEVEL_ADMIN,
            self::LEVEL_SUPER_ADMIN,
        ];
    }

    /**
     * 檢查是否為管理員
     */
    public function isAdmin(): bool
    {
        return in_array($this->level, [self::LEVEL_ADMIN, self::LEVEL_SUPER_ADMIN]);
    }

    /**
     * 檢查是否為超級管理員
     */
    public function isSuperAdmin(): bool
    {
        return $this->level === self::LEVEL_SUPER_ADMIN;
    }

    /**
     * 檢查信箱是否已驗證
     */
    public function isEmailVerified(): bool
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * 產生信箱驗證令牌
     */
    public function generateEmailVerificationToken(): string
    {
        $token = Str::random(64);
        $this->update([
            'email_verification_token' => $token,
            'email_verification_expires_at' => now()->addHours(24),
        ]);
        return $token;
    }

    /**
     * 驗證信箱
     */
    public function verifyEmail(string $token): bool
    {
        if ($this->email_verification_token !== $token) {
            return false;
        }

        if ($this->email_verification_expires_at && $this->email_verification_expires_at->isPast()) {
            return false;
        }

        $this->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_expires_at' => null,
        ]);

        return true;
    }

    /**
     * 更新最後登入時間
     */
    public function updateLastLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }
}
