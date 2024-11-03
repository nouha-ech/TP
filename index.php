<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tpform</title>
    <script>
        function generatePassword(event) {
            event.preventDefault();
            var size = document.getElementById('size').value;
            let pwd = "";
            let str = 'abcdefghijklmnopqrstuvwxyz0123456789@#$';

            for (let i = 1; i <= size; i++) {
                let char = Math.floor(Math.random() * str.length);
                pwd += str.charAt(char);
            }

            document.getElementById('passwordgenerated').textContent = pwd;
            document.getElementById('generatedPassword').value = pwd;
        }
    </script>
</head>

<body>
    <h2>Generate Password</h2>
    <form action="register.php" method="POST">
        <fieldset>
            <legend>Password Generating</legend>

            <label for="size">Size:</label><br><br>
            <input type="number" id="size" name="size" placeholder="10"><br><br>
            <button onclick="generatePassword(event)">Generate Password</button>
            <br><br>
            <input type="hidden" id="generatedPassword" name="generatedPassword">
            <input type="submit" value="Register">
        </fieldset>
    </form>
    <h2 id="passwordgenerated"></h2>
</body>

</html>