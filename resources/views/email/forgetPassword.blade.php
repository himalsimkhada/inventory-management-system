<!doctype html>
<html lang="en">
<head>
    <title>Forget Password</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear {{ $name }}, </td>
        </tr>
        <tr>
            <td>Your Password has successfully changed. Your New Password is: </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>New Password: {{ $password }}</td>
        </tr>
    </table>
</body>
</html>
