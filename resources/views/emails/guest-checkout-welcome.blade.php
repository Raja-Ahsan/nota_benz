<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ __('Your order & account') }}</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f8;font-family:system-ui,-apple-system,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;line-height:1.5;color:#1a1a1a;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;background-color:#f4f6f8;">
    <tr>
        <td align="center" style="padding:40px 16px;">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:560px;border-collapse:collapse;background-color:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.06);">
                <tr>
                    <td style="padding:28px 32px;border-bottom:1px solid #e8ecf0;">
                        <p style="margin:0;font-size:13px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#64748b;">{{ config('app.name', 'NOTaBENZ') }}</p>
                        <h1 style="margin:8px 0 0;font-size:22px;font-weight:700;color:#0f172a;">{{ __('Thanks for your order') }}</h1>
                    </td>
                </tr>
                <tr>
                    <td style="padding:28px 32px;">
                        <p style="margin:0 0 16px;font-size:15px;color:#334155;">
                            {{ __('Hi :name,', ['name' => $user->name]) }}
                        </p>
                        <p style="margin:0 0 16px;font-size:15px;color:#334155;">
                            {{ __('We created an account for you so you can track orders and manage your profile. Your temporary password is below you can sign in and change it.') }}
                        </p>

                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:20px 0;border-collapse:collapse;background-color:#f1f5f9;border-radius:6px;">
                            <tr>
                                <td style="padding:16px 20px;">
                                    <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">{{ __('Order number') }}</p>
                                    <p style="margin:0;font-size:17px;font-weight:700;color:#0ea5e9;">{{ $order->publicOrderNumber() }}</p>
                                    <p style="margin:12px 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">{{ __('Email') }}</p>
                                    <p style="margin:0;font-size:15px;color:#0f172a;">{{ $user->email }}</p>
                                    <p style="margin:12px 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">{{ __('Temporary password') }}</p>
                                    <p style="margin:0;font-size:18px;font-weight:700;font-family:ui-monospace,Consolas,monospace;letter-spacing:0.02em;color:#0f172a;">{{ $plainPassword }}</p>
                                </td>
                            </tr>
                        </table>

                        <table role="presentation" cellspacing="0" cellpadding="0" style="margin:24px 0;border-collapse:collapse;">
                            <tr>
                                <td style="border-radius:6px;background-color:#0ea5e9;">
                                    <a href="{{ route('login', absolute: true) }}" style="display:inline-block;padding:12px 24px;font-size:14px;font-weight:600;color:#ffffff;text-decoration:none;">
                                        {{ __('Sign in') }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px 32px;background-color:#f8fafc;border-top:1px solid #e8ecf0;">
                        <p style="margin:0;font-size:12px;color:#94a3b8;">
                            {{ __('This email was sent because you placed an order at :app.', ['app' => config('app.name')]) }}
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
