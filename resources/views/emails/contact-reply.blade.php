<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Foresight CGC</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
</head>
<body style="margin-top: 0; margin-bottom: 0; margin-left: 0; margin-right: 0; padding-top: 0; padding-bottom: 0; padding-left: 0; padding-right: 0;">

    <!-- Wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f5f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <tr>
            <td align="center" style="padding-top: 40px; padding-bottom: 40px; padding-left: 20px; padding-right: 20px;">

                <!-- Email Container -->
                <!--[if (gte mso 9)|(IE)]><table width="600" align="center" cellpadding="0" cellspacing="0" border="0"><tr><td><![endif]-->
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="width: 100%;" width="600">

                    <!-- Header -->
                    <tr>
                        <td style="background-color: #0a1628; padding-top: 32px; padding-bottom: 32px; padding-left: 40px; padding-right: 40px; text-align: center;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding-bottom: 12px;">
                                        <img src="{{ $message->embed(public_path('images/foresightcgc1.png')) }}" alt="Foresight CGC" width="48" height="48" style="display: block; width: 48px; height: 48px; border: 0;">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <h1 style="margin-top: 0; margin-bottom: 0; margin-left: 0; margin-right: 0; color: #ffffff; font-size: 22px; font-weight: bold; letter-spacing: 0.5px;">
                                            Foresight
                                        </h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 4px;">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #c8a960; font-size: 10px; letter-spacing: 3px; font-weight: bold;">
                                            CORPORATE GOVERNANCE CONSULTING
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Gold Accent Line -->
                    <tr>
                        <td style="background-color: #c8a960; height: 3px; font-size: 1px; line-height: 1px;">&nbsp;</td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="background-color: #ffffff; padding-top: 48px; padding-bottom: 40px; padding-left: 40px; padding-right: 40px;">

                            <!-- Greeting -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-bottom: 8px;">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #0a1628; font-size: 20px; font-weight: bold;">
                                            Dear {{ $submission->name }},
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 28px;">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #6c80a4; font-size: 14px; line-height: 22px;">
                                            Thank you for reaching out to Foresight Corporate Governance Consulting. We appreciate your inquiry and are pleased to respond.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Gold Divider -->
                            <table role="presentation" width="60" cellpadding="0" cellspacing="0" border="0" style="padding-bottom: 28px;">
                                <tr>
                                    <td style="background-color: #c8a960; height: 3px; font-size: 1px; line-height: 1px;">&nbsp;</td>
                                </tr>
                            </table>

                            <!-- Reply Message -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-bottom: 36px; color: #1d3a6b; font-size: 15px; line-height: 26px;">
                                        {!! nl2br(e($replyMessage)) !!}
                                    </td>
                                </tr>
                            </table>

                            <!-- Original Message Box -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-bottom: 36px;">
                                <tr>
                                    <td style="border-left: 3px solid #c8a960;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="background-color: #f8f9fb; padding-top: 20px; padding-bottom: 20px; padding-left: 24px; padding-right: 24px;">
                                                    <p style="margin-top: 0; margin-bottom: 8px; color: #6c80a4; font-size: 11px; letter-spacing: 1.5px; font-weight: bold;">
                                                        YOUR ORIGINAL MESSAGE
                                                    </p>
                                                    @if($submission->subject)
                                                        <p style="margin-top: 0; margin-bottom: 8px; color: #0a1628; font-size: 13px; font-weight: bold;">
                                                            Re: {{ $submission->subject }}
                                                        </p>
                                                    @endif
                                                    <p style="margin-top: 0; margin-bottom: 0; color: #4d6591; font-size: 13px; line-height: 21px; font-style: italic;">
                                                        &ldquo;{{ $submission->message }}&rdquo;
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Closing -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-bottom: 4px;">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #1d3a6b; font-size: 14px;">
                                            Warm regards,
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 4px;">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #0a1628; font-size: 15px; font-weight: bold;">
                                            Foresight Corporate Governance Consulting
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 32px;">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #6c80a4; font-size: 12px;">
                                            Strategy &bull; Solutions &bull; Operations
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center">
                                <tr>
                                    <td align="center" style="background-color: #c8a960;">
                                        <a href="{{ url('/') }}" target="_blank" style="display: inline-block; padding-top: 14px; padding-bottom: 14px; padding-left: 36px; padding-right: 36px; color: #0a1628; font-size: 12px; font-weight: bold; letter-spacing: 2px; text-decoration: none;">
                                            VISIT OUR WEBSITE
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #0a1628; padding-top: 28px; padding-bottom: 28px; padding-left: 40px; padding-right: 40px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding-bottom: 6px;">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #6c80a4; font-size: 12px; line-height: 18px;">
                                            Foresight Corporate Governance Consulting
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom: 12px;">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #4d6591; font-size: 11px;">
                                            Calgary, Alberta, Canada &bull; admin@foresightcosec.com &bull; 4036671396
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <p style="margin-top: 0; margin-bottom: 0; color: #2d4a7e; font-size: 10px;">
                                            &copy; {{ date('Y') }} Foresight CGC. All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->

            </td>
        </tr>
    </table>

</body>
</html>
