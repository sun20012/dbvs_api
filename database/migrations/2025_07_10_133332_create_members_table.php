<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 執行 migration
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->comment('會員信箱');
            $table->string('nickname')->comment('會員綽號');
            $table->string('password')->comment('會員密碼');
            $table->enum('level', ['一般會員', '管理員', '超級管理員'])->default('一般會員')->comment('會員等級');
            $table->timestamp('email_verified_at')->nullable()->comment('信箱驗證時間');
            $table->string('email_verification_token')->nullable()->comment('信箱驗證令牌');
            $table->timestamp('email_verification_expires_at')->nullable()->comment('信箱驗證令牌過期時間');
            $table->boolean('is_active')->default(true)->comment('是否啟用');
            $table->timestamp('last_login_at')->nullable()->comment('最後登入時間');
            $table->rememberToken();
            $table->timestamps();
            
            // 建立索引
            $table->index(['email', 'is_active']);
            $table->index('level');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('member_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * 回滾 migration
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('members');
    }
};
