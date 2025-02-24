<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Business Case Submitted</title>
    <style>
        body{
            width: 650px;
            font-family: "Work Sans", sans-serif;
            background-color: #f6f7fb;
            display: block;
            margin: 30px auto;
        }
        a {
            text-decoration: none;
        }
        span {
            font-size: 14px;
        }
        p {
            font-size: 13px;
            line-height: 1.7;
            letter-spacing: 0.7px;
            margin-top: 0;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<table style="width: 100%">
    <tbody>
    <tr>
        <td>
            <table style="background-color: #f6f7fb; width: 100%">
                <tbody>
                <tr>
                    <td>
                        <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                            <tbody>
                            <tr>
                                <td></td>
                                <td style="text-align: right; color:#999"><span>Risk Ranking 2025</span></td>
                            </tr>
                            </tbody>
                        </table>
                        <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                            <tbody>
                            <tr>
                                <td style="padding: 30px">
                                    <p>Dear Elfriani,</p>
                                    <p>We would like to inform you that a new business case has been submitted with the following details:</p>

                                    <p><b>Title:</b> {{ $data->project_name }}</p>
                                    <p><b>Originator:</b> {{ $data->bc_originator }}</p>
                                    <p><b>Presenter:</b> {{$data->bc_presenter}}</p>
                                    <p><b>Owner:</b> {{$data->ownersProject?->name}}</p>
                                    <p><b>Sponsor:</b> {{$data?->sponsorsProject?->name}}</p>

                                    <p>Please review the submission at your earliest convenience.</p>

                                    <p><i>This is an automated message. <b>Please do not reply to this email.</b>
                                    <p style="margin-bottom: 0">Best regards,<br><b>Risk Ranking 2026-2030 Team</b></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
