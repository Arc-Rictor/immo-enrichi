<?php
header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Honeypot check
if (!empty($_POST['website'])) {
    echo json_encode(['success' => true, 'message' => 'Thank you!']);
    exit;
}

// Rate limiting via session
session_start();
$now = time();
if (isset($_SESSION['last_contact']) && ($now - $_SESSION['last_contact']) < 60) {
    http_response_code(429);
    $locale = isset($_POST['locale']) && $_POST['locale'] === 'fr' ? 'fr' : 'en';
    $msg = $locale === 'fr'
        ? 'Veuillez patienter une minute avant de renvoyer un message.'
        : 'Please wait one minute before sending another message.';
    echo json_encode(['success' => false, 'message' => $msg]);
    exit;
}

// Validate inputs
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');
$locale  = ($_POST['locale'] ?? 'en') === 'fr' ? 'fr' : 'en';

$errors = [];

if ($name === '' || strlen($name) > 100) {
    $errors[] = $locale === 'fr' ? 'Le nom est requis.' : 'Name is required.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = $locale === 'fr' ? 'Adresse email invalide.' : 'Invalid email address.';
}
if ($message === '' || strlen($message) > 2000) {
    $errors[] = $locale === 'fr' ? 'Le message est requis.' : 'Message is required.';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Sanitize
$name    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$phone   = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Build email
$to      = 'imf-info@mail.com';
$subject = "[Immo-Allie] New Contact: $name";
$body    = "Name: $name\n";
$body   .= "Email: $email\n";
if ($phone !== '') {
    $body .= "Phone: $phone\n";
}
$body   .= "Locale: $locale\n\n";
$body   .= "Message:\n$message\n";

$headers  = "From: noreply@immobiliermatrixfrance.fr\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send
$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    $_SESSION['last_contact'] = $now;
    $msg = $locale === 'fr'
        ? 'Merci ! Votre message a bien été envoyé.'
        : 'Thank you! Your message has been sent.';
    echo json_encode(['success' => true, 'message' => $msg]);
} else {
    http_response_code(500);
    $msg = $locale === 'fr'
        ? 'Une erreur est survenue. Veuillez réessayer.'
        : 'Something went wrong. Please try again.';
    echo json_encode(['success' => false, 'message' => $msg]);
}
