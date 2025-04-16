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
                                    @if($data->version  == 1)
                                        <p>We would like to inform you that a new business case has been submitted with the following details:</p>

                                        <p><b>Title:</b>  <a href="{{ url('/project/'.$data->id) }}"> {{ $data->project_name }} </a></p>
                                        <p><b>Originator:</b> {{ $data->bc_originator }}</p>
                                        <p><b>Presenter:</b> {{$data->bc_presenter}}</p>
                                        <p><b>Owner:</b> {{$data->ownersProject?->name}}</p>
                                        <p><b>Sponsor:</b> {{$data?->sponsorsProject?->name}}</p>
                                    @endif

                                    @if($data->version  > 1)
                                        <p>We would like to inform you that the business case titled “{{$data->project_name}}” has been updated to version [<b>{{$data->version}}</b>] with new information and now requires your review again.</p>

                                        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 13px;">
                                            <thead>
                                            <tr style="background-color: #f2f2f2; color: #333;">
                                                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Revision No.</th>
                                                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Revision Date</th>
                                                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Summary of Changes</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($log && !empty(json_decode($log->changes)))
                                                <tr>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $log->revision }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $log->date }}</td>
                                                    <td style="padding: 10px; border: 1px solid #ddd;">
                                                        <ul style="list-style-type: disc; padding-left: 20px; margin: 0;">
                                                            @foreach(json_decode($log->changes) as $item)
                                                                @if($item->field == 'preliminary_design')
                                                                    <li>Adjusted the file preliminary design</li>
                                                                @else
                                                                    @if(isset($item->oldValue))
                                                                        <li>Adjusted the {{ $item->field }} from <b>{{ $item->oldValue }}</b> to <b>{{ $item->newValue }}</b>.</li>
                                                                    @else
                                                                        <li>Added a new file/value for {{ $item->field }}: <b>{{ $item->newValue }}</b></li>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                   @endif
                        <br>
                        <p>Please review the submission <a href="{{ url('/project/'.$data->id) }}"> here </a> at your earliest convenience.</p>

                        <p><i>This is an automated message. <b>Please do not reply to this email.</b></i>
                        <p style="margin-bottom: 0">Best regards,</br><b>Risk Ranking 2026-2030 Team</b></p>
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
