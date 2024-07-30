<?php
session_start();
include 'db_config.php'; // Incluye la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $birth_date = $conn->real_escape_string($_POST['birth_date']);
    $dni = $conn->real_escape_string($_POST['dni']);
    $institution = isset($_POST['institution']) ? $conn->real_escape_string($_POST['institution']) : '';

    // Inserta los datos del usuario en la base de datos
    $sql = "INSERT INTO users (full_name, email, phone, birth_date, dni, institution) 
            VALUES ('$full_name', '$email', '$phone', '$birth_date', '$dni', '$institution')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del usuario recién creado
        $user_id = $conn->insert_id;

        // Establecer variables de sesión para el usuario registrado
        $_SESSION['user_id'] = $user_id;
        $_SESSION['full_name'] = $full_name;

        // Redirigir al perfil del usuario
        header("Location: profile.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
