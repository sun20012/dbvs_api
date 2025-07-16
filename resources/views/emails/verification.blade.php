<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>信箱驗證通知</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>信箱驗證通知</h1>
    </div>
    
    <div class="content">
        <p>親愛的 {{ $member->nickname }}，</p>
        
        <p>感謝您註冊我們的服務！為了確保您的帳號安全，請點擊下方的按鈕來驗證您的信箱：</p>
        
        <div style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">驗證信箱</a>
        </div>
        
        <p>如果按鈕無法點擊，請複製以下連結到瀏覽器：</p>
        <p style="word-break: break-all; color: #007bff;">{{ $verificationUrl }}</p>
        
        <p><strong>注意事項：</strong></p>
        <ul>
            <li>此驗證連結將在 24 小時後失效</li>
            <li>如果您沒有註冊此服務，請忽略此信件</li>
            <li>驗證完成後，您就可以正常登入使用我們的服務</li>
        </ul>
    </div>
    
    <div class="footer">
        <p>此信件由系統自動發送，請勿回覆。</p>
        <p>如有任何問題，請聯繫我們的客服團隊。</p>
    </div>
</body>
</html> 