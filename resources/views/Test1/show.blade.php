<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form action="register" method="POST">
    @csrf
    <table align="center">
        <tr>
            <td>用户名:</td>
            <td><input type="text" name="uname"></td>
        </tr>
        <tr>
            <td>密码:</td>
            <td><input type="password" name="pwd"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="注册"></td>
        </tr>
    </table>
</form>
</body>
</html>
