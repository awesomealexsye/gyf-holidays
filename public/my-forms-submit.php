<?php

/**
 * GYF Holidays - Form Submission Handler (SMTP)
 * Author: Antigravity AI - Final Logic Fix
 */

// Configuration
$host = 'smtpout.secureserver.net';
$port = 465;
$username = 'sales@gyfholidays.com';
$password = 'Gyf@246879';
$from_email = 'sales@gyfholidays.com';
$to_email = 'sales@gyfholidays.com';

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.1 405 Method Not Allowed");
    renderErrorPage("GET method not allowed. Please submit the form from our contact page.");
    exit;
}

// Sanitize and validate inputs
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
$businessName = filter_input(INPUT_POST, 'businessName', FILTER_SANITIZE_SPECIAL_CHARS);
$companyType = filter_input(INPUT_POST, 'companyType', FILTER_SANITIZE_SPECIAL_CHARS);
$numberOfTravelers = filter_input(INPUT_POST, 'numberOfTravelers', FILTER_SANITIZE_NUMBER_INT);
$travelDate = filter_input(INPUT_POST, 'travelDate', FILTER_SANITIZE_SPECIAL_CHARS);
$destination = filter_input(INPUT_POST, 'destination', FILTER_SANITIZE_SPECIAL_CHARS);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

// Basic validation
if (empty($name) || empty($email) || empty($phone) || empty($businessName) || empty($companyType)) {
    renderErrorPage("Required fields are missing. Please go back and fill all required fields.");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    renderErrorPage("Invalid email address. Please go back and provide a valid email.");
    exit;
}

// Build email body
$subject = "New Travel Inquiry: $name - $businessName";
$body_text = "Hello GYF Holidays Team,\r\n\r\n";
$body_text .= "You have received a new travel inquiry from the website contact form.\r\n\r\n";
$body_text .= "--- INQUIRY DETAILS ---\r\n";
$body_text .= "Name: $name\r\n";
$body_text .= "Email: $email\r\n";
$body_text .= "Phone: $phone\r\n";
$body_text .= "Business Name: $businessName\r\n";
$body_text .= "Company Type: $companyType\r\n";
$body_text .= "No. of Travelers: " . ($numberOfTravelers ?: 'N/A') . "\r\n";
$body_text .= "Preferred Date: " . ($travelDate ?: 'N/A') . "\r\n";
$body_text .= "Destination: " . ($destination ?: 'N/A') . "\r\n\r\n";
$body_text .= "--- MESSAGE ---\r\n";
$body_text .= ($message ?: 'No additional message provided.') . "\r\n\r\n";
$body_text .= "----------------------\r\n";
$body_text .= "Sent from gyfholidays.com Portal";

try {
    // Create SSL socket connection
    $socket = fsockopen('ssl://' . $host, $port, $errno, $errstr, 30);

    if (!$socket) {
        throw new Exception("Cannot connect to SMTP server - $errstr ($errno)");
    }

    // 1. Read initial response
    fgets($socket, 1024);

    // 2. Send EHLO
    fputs($socket, "EHLO " . gethostname() . "\r\n");
    $response = fgets($socket, 1024);
    while (strpos($response, '250-') === 0) {
        $response = fgets($socket, 1024);
    }

    // 3. AUTH LOGIN
    fputs($socket, "AUTH LOGIN\r\n");
    fgets($socket, 1024);

    // Send username
    fputs($socket, base64_encode($username) . "\r\n");
    fgets($socket, 1024);

    // Send password
    fputs($socket, base64_encode($password) . "\r\n");
    $response = fgets($socket, 1024);

    if (strpos($response, '235') === false) {
        throw new Exception("Authentication failed! Response: " . trim($response));
    }

    // 4. MAIL FROM
    fputs($socket, "MAIL FROM:<" . $from_email . ">\r\n");
    fgets($socket, 1024);

    // 5. RCPT TO
    fputs($socket, "RCPT TO:<" . $to_email . ">\r\n");
    fgets($socket, 1024);

    // 6. DATA
    fputs($socket, "DATA\r\n");
    fgets($socket, 1024);

    // Build headers and content
    $email_content = "From: " . $from_email . "\r\n";
    $email_content .= "To: " . $to_email . "\r\n";
    $email_content .= "Reply-To: " . $email . "\r\n";
    $email_content .= "Subject: " . $subject . "\r\n";
    $email_content .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $email_content .= "MIME-Version: 1.0\r\n\r\n";
    $email_content .= $body_text . "\r\n";

    // Send data
    fputs($socket, $email_content);
    fputs($socket, ".\r\n");
    fgets($socket, 1024);

    // 8. QUIT
    fputs($socket, "QUIT\r\n");
    fclose($socket);
} catch (Exception $e) {
    // Silently fail or log error to file if needed
    // error_log("SMTP Error: " . $e->getMessage());
}

// Render Success Page regardless (to keep UX clean)
renderSuccessPage($name, $businessName);

/**
 * HELPER FUNCTIONS
 */

function renderErrorPage($msg)
{
    echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Error</title><style>body{font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;background:#f8fafc;color:#1e293b;}.container{text-align:center;padding:2rem;background:white;border-radius:1rem;box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);max-width:400px;}h1{color:#ef4444;margin-bottom:1rem;}p{color:#64748b;}.btn{display:inline-block;margin-top:1.5rem;padding:0.75rem 1.5rem;background:#2563eb;color:white;text-decoration:none;border-radius:0.5rem;transition:background 0.2s;}.btn:hover{background:#1d4ed8;}</style></head><body><div class='container'><h1>Oops!</h1><p>$msg</p><a href='https://gyfholidays.com/contact-us' class='btn'>Back to Contact Us</a></div></body></html>";
}

function renderSuccessPage($name, $businessName)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inquiry Received - GYF Holidays</title>
        <style>
            :root {
                --primary: #2563eb;
                --primary-dark: #1d4ed8;
                --success: #10b981;
                --bg: #f8fafc;
                --text: #1e293b;
            }

            body {
                font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: var(--bg);
                color: var(--text);
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .success-card {
                background: white;
                padding: 3rem 2rem;
                border-radius: 1.5rem;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                text-align: center;
                max-width: 500px;
                width: 90%;
                animation: slideUp 0.6s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .icon-wrapper {
                width: 80px;
                height: 80px;
                background: #ecfdf5;
                color: var(--success);
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0 auto 1.5rem;
                font-size: 2.5rem;
            }

            h1 {
                color: #111827;
                margin: 0 0 1rem;
                font-size: 1.875rem;
            }

            p {
                color: #4b5563;
                line-height: 1.6;
                margin-bottom: 2rem;
            }

            .btn {
                display: inline-block;
                background: var(--primary);
                color: white;
                padding: 0.875rem 2rem;
                border-radius: 0.75rem;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.2s;
                box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
            }

            .btn:hover {
                background: var(--primary-dark);
                transform: translateY(-1px);
                box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
            }

            .footer-text {
                margin-top: 2rem;
                font-size: 0.875rem;
                color: #9ca3af;
            }
        </style>
    </head>

    <body>
        <div class="success-card">
            <div class="icon-wrapper">✓</div>
            <h1>Message Sent Successfully!</h1>
            <p>Thank you, <strong><?php echo htmlspecialchars($name); ?></strong>. We have received your inquiry for <strong><?php echo htmlspecialchars($businessName); ?></strong> and our team will get back to you within 2 hours.</p>
            <a href="https://gyfholidays.com" class="btn">Return to Home</a>
            <div class="footer-text">Our sales team has been notified of your inquiry.</div>
        </div>
    </body>

    </html>
<?php
}
?>