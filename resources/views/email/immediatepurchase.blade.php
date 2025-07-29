<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">
            <p style="font-size:1.1em">Hello,</p>
            <p>Your verification code:</p>
            <h2
                style="background: #E9B434;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                {{ $otp }}</h2>
            <p>The verification code will be valid for 60 minutes. Please do not share this code with anyone.
                If you did not initiate this operation, click the link below to contact OTT Customer Service:
            </p>
            <a href="{{route('contact-us')}}" target="_blank"><span
                    style='color:#E9B434'>{{route('contact-us')}}</span></a></span></p>
            <p style="font-size:0.9em;">Regards,<br /> OTT Team.</p>
            <hr style="border:none;border-top:1px solid #eee" />
            <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                <p>OTT Team.</p>
                <p>Automated message. Please do not reply.</p>
            </div>
        </div>
    </div>
</body>

</html>
