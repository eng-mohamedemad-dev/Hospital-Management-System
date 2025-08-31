<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كود التفعيل</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            direction: rtl;
            text-align: right;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .code-container {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            margin: 30px 0;
        }
        .code {
            font-size: 36px;
            font-weight: bold;
            color: white;
            letter-spacing: 5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        .code-label {
            color: white;
            font-size: 14px;
            margin-top: 10px;
            opacity: 0.9;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #e9ecef;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .content {
                padding: 30px 20px;
            }
            .code {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 نظام إدارة المستشفى</h1>
        </div>
        
        <div class="content">
            <div class="greeting">
                مرحباً {{ $user->name ?? 'عزيزي المستخدم' }},
            </div>
            
            <div class="message">
              {{ $type === 'email_verification' ? 'شكراً لك على التسجيل في نظام إدارة المستشفى. لتفعيل حسابك، يرجى استخدام كود التفعيل التالي:' : 'شكراً لك على التسجيل في نظام إدارة المستشفى. لإسترجاع كلمة السرية، يرجى استخدام كود الإسترجاع التالي:' }}
            </div>
            
            <div class="code-container">
                <div class="code">{{ $code }}</div>
                <div class="code-label">كود  {{ $type == 'email_verification' ? 'التفعيل' : 'إسترجاع الكلمة السرية' }}</div>
            </div>
            
            <div class="warning">
                <strong>تنبيه:</strong> هذا الكود صالح لمدة {{ $expires_at->diffForHumans() }} .
                لا تشارك هذا الكود مع أي شخص آخر.
            </div>
            
            <div class="message">
                إذا لم تقم بإنشاء حساب معنا، يرجى تجاهل هذا الإيميل.
            </div>
        </div>
        
        <div class="footer">
            <p>
                مع تحيات فريق نظام إدارة المستشفى<br>
                <a href="mailto:support@hospital.com">support@hospital.com</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px; color: #adb5bd;">
                تم إرسال هذا الإيميل تلقائياً، يرجى عدم الرد عليه.
            </p>
        </div>
    </div>
</body>
</html>
