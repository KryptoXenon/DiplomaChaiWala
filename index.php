<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.4/dist/tailwind.min.css">
</head>

<body class="bg-gray-200 font-sans leading-normal tracking-normal">
    <?php
    $host = 'localhost';
    $dbname = 'diplo_chai';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        if (isset($_POST['submit'])) {
            // Retrieve the values from the form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute([$username]);

            // Check if a row was returned
            if ($row = $stmt->fetch()) {
                // Verify the password
                if (strcmp($password, $row['password']) == 0) {
                    // Password is correct, so start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;

                    // Redirect to homepage
                    header('Location: home.html');
                    exit;
                } else {
                    // Password is not correct
                    echo '<script> alert("Invalid username or password"); </script>';
                }
            } else {
                // Username doesn't exist
                echo '<script> alert("Username not existing"); </script>';
            }
        }
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }    
    ?>
    <div class="flex flex-col justify-center sm:w-96 sm:m-auto mx-5 mb-5 space-y-8">
        <h2 class="font-bold text-2xl text-gray-800 text-center pt-6">Diploma Chai Wala - Login</h2>
        <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="username">
                    Username
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username" name="username" type="text" placeholder="Enter your username" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="password">
                    Password
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="password" name="password" type="password" placeholder="Enter your password" required>
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit" name="submit">
                    Sign In
                </button>
            </div>
        </form>
        <div class="text-center">
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/Diploma%20Chai%20Wala/signup.php">
                New user? Sign in!
            </a>
        </div>
    </div>
</body>

</html>