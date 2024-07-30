<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Aquí podrías almacenar el mensaje en una base de datos o enviarlo por correo electrónico
    // Por ejemplo, enviar por correo electrónico:
    $to = "tu_correo@example.com"; // Reemplaza con tu correo
    $headers = "From: " . $email;
    $fullMessage = "Nombre: $name\nCorreo: $email\nAsunto: $subject\nMensaje:\n$message";

    if (mail($to, $subject, $fullMessage, $headers)) {
        http_response_code(200); // Envío exitoso
    } else {
        http_response_code(500); // Error en el envío
    }
} else {
    http_response_code(405); // Método no permitido
}
?>
