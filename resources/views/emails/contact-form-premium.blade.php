<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.notification_title') }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f7f6;
            padding-bottom: 40px;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            color: #4a4a4a;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #134e4a;
            padding: 40px 20px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin: 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .content {
            padding: 40px 30px;
        }

        .intro-text {
            font-size: 16px;
            line-height: 24px;
            margin-bottom: 30px;
            color: #666666;
        }

        .data-card {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .data-row {
            margin-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 10px;
        }

        .data-row:last-child {
            margin-bottom: 0;
            border-bottom: none;
            padding-bottom: 0;
        }

        .label {
            font-weight: bold;
            color: #0f766e;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }

        .value {
            font-size: 16px;
            color: #1f2937;
        }

        .message-box {
            background-color: #ffffff;
            border-left: 4px solid #ff9800;
            padding: 20px;
            margin-top: 20px;
            font-style: italic;
            color: #374151;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #9ca3af;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .button {
            background-color: #ff9800;
            color: #ffffff !important;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .accent-bar {
            height: 4px;
            background: linear-gradient(to right, #134e4a, #ff9800);
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <center>
            <table class="main" width="100%">
                <tr>
                    <td>
                        <div class="accent-bar"></div>
                        <div class="header">
                            <h1>Novisi El Kartea</h1>
                        </div>
                        <div class="content">
                            <!-- DIAGNOSTIC VERSION 2.0 - HTML FORCE -->
                            <p class="intro-text">
                                {{ __('emails.greeting') }}<br><br>
                                {{ __('emails.intro') }}
                            </p>

                            <div class="data-card">
                                <div class="data-row">
                                    <span class="label">{{ __('emails.form_type') }}</span>
                                    <span class="value">{{ \App\Models\ContactSubmission::TYPES[$submission->type] ?? $submission->type }}</span>
                                </div>
                                <div class="data-row">
                                    <span class="label">{{ __('emails.full_name') }}</span>
                                    <span class="value">{{ $submission->name }}</span>
                                </div>
                                <div class="data-row">
                                    <span class="label">{{ __('emails.email_address') }}</span>
                                    <span class="value">{{ $submission->email }}</span>
                                </div>
                                @if($submission->phone)
                                <div class="data-row">
                                    <span class="label">{{ __('emails.phone') }}</span>
                                    <span class="value">{{ $submission->phone }}</span>
                                </div>
                                @endif
                                @if($submission->subject)
                                <div class="data-row">
                                    <span class="label">{{ __('emails.subject') }}</span>
                                    <span class="value">{{ $submission->subject }}</span>
                                </div>
                                @endif

                                <div class="data-row" style="border-bottom: none;">
                                    <span class="label">{{ __('emails.message') }}</span>
                                    <div class="message-box">
                                        {{ $submission->message }}
                                    </div>
                                </div>
                            </div>

                            <div class="button-container">
                                <a href="{{ config('app.url') }}/cpanel" class="button">{{ __('emails.button_dashboard') }}</a>
                            </div>
                        </div>
                        <div class="footer">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('emails.footer_copy') }}
                        </div>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</body>

</html>