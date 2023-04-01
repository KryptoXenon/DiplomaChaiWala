<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.4/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
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
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?,?,?)');
            $result = $stmt->execute([$username, $email, $password]);
            // var_dump($stmt->execute([$username, $email, $password]));
            if($result){
                header('location: /Diploma%20Chai%20Wala/index.php');
            } else {
                header('location: /Diploma%20Chai%20Wala/signup.php');
            }
        }

    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    ?>
    <div class="max-w-md mx-auto py-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl mb-6 text-gray-800">Create an account</h2>
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="username">
                        Username
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" name="username" type="text" placeholder="johndoe">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" name="email" type="email" placeholder="john.doe@example.com">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" name="password" type="password" placeholder="********">
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit" name="submit">
                        Signup
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>