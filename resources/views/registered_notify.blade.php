<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <p>Hi, <strong>{{$name}}</strong>!</p>
    <p>A sign in attempt requires further verification since we did not recognize your device. To complete the sign in, please enter the otp verification code in the bellow.</p>
    <p><strong>User Information</strong></p>
    <table style="border-collapse: collapse; width: 100%;" border="0">
        <tbody>
            <tr>
                <td style="width: 25.2437%;">Name</td>
                <td style="width: 74.7563%;">: {{$name}}</td>
            </tr>
            <tr>
                <td style="width: 25.2437%;">Email</td>
                <td style="width: 74.7563%;">: {{$email}}</td>
            </tr>
            <tr>
                <td style="width: 25.2437%;">OTP Code</td>
                <td style="width: 74.7563%;">: {{$otp}}</td>
            </tr>
        </tbody>
    </table>
    <p>Best regards,</p>
    <p>Thank You</p>
    <br>
    <p><strong>The Administrator Team</strong></p>
</body>

</html>