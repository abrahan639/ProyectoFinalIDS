<?php
// Iniciar sesión
session_start();

// Variables para mensajes de error
$errors = [];
$username = $email = $password = '';

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar los datos
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validaciones
    if (empty($username)) {
        $errors['username'] = 'El nombre de usuario es requerido';
    } elseif (strlen($username) < 4) {
        $errors['username'] = 'El nombre debe tener al menos 4 caracteres';
    }

    if (empty($email)) {
        $errors['email'] = 'El correo electrónico es requerido';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Por favor ingresa un correo electrónico válido';
    }

    if (empty($password)) {
        $errors['password'] = 'La contraseña es requerida';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'La contraseña debe tener al menos 6 caracteres';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Las contraseñas no coinciden';
    }

    // Si no hay errores, procesar el registro
    if (empty($errors)) {
        // Aquí iría la conexión a la base de datos y el registro
        // Por ahora solo simulamos el éxito
        $_SESSION['message'] = '¡Registro exitoso! Bienvenido/a ' . htmlspecialchars($username);
        header('Location: welcome.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Cursos en Línea</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 24px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 6px;
            color: #2c3e50;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        input:focus {
            border-color: #3498db;
            outline: none;
        }
        
        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }
        
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #7f8c8d;
        }
        
        .login-link a {
            color: #3498db;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Regístrate</h1>
        
        <?php if (!empty($errors)): ?>
            <div style="color: #e74c3c; margin-bottom: 15px;">
                Por favor corrige los siguientes errores:
            </div>
        <?php endif; ?>
        
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <?php if (isset($errors['username'])): ?>
                    <div class="error"><?php echo $errors['username']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <div class="error"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
                <?php if (isset($errors['password'])): ?>
                    <div class="error"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <?php if (isset($errors['confirm_password'])): ?>
                    <div class="error"><?php echo $errors['confirm_password']; ?></div>
                <?php endif; ?>
            </div>
            
            <button type="submit">Registrarse</button>
        </form>
        
        <div class="login-link">
            ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a>
        </div>
    </div>
</body>
</html>