<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos del formulario de forma segura
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Tu dirección de correo electrónico a la que se enviarán los mensajes
    $to = "rulo_dev@outlook.com"; // ¡IMPORTANTE: Reemplaza con tu dirección de correo!

    // Asunto del correo que recibirás
    $email_subject = "Nuevo Mensaje de Contacto: " . $subject;

    // Cuerpo del correo
    $email_body = "Has recibido un nuevo mensaje desde el formulario de contacto de tu sitio web.\n\n";
    $email_body .= "Nombre: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    if (!empty($phone)) {
        $email_body .= "Teléfono: " . $phone . "\n";
    }
    $email_body .= "Asunto: " . $subject . "\n";
    $email_body .= "Mensaje:\n" . $message . "\n";

    // Cabeceras del correo
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    // Envía el correo electrónico
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Redirige al usuario a una página de éxito
        header("Location: thank_you.html"); // Crea una página de "Gracias por tu mensaje"
        exit();
    } else {
        // Redirige al usuario a una página de error si algo sale mal
        header("Location: error.html"); // Crea una página de "Hubo un error"
        exit();
    }
} else {
    // Si alguien intenta acceder directamente a send_email.php sin enviar el formulario
    header("Location: contacto.html"); // O la página de tu formulario
    exit();// Siempre usa exit() después de una redirección
}
?>