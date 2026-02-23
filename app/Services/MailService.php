<?php

namespace App\Services;

class MailService
{
    /**
     * Send email using PHP mail() function if allowed.
     */
    public static function sendEnquiryMail($data)
    {
        if (env('ALLOW_MAIL_SEND', false) === false) {
            return false;
        }

        $to = config('gyf.contact.email');
        $subject = "New Enquiry from " . $data['name'];
        
        $message = "You have received a new enquiry:

";
        $message .= "Name: " . $data['name'] . "
";
        $message .= "Email: " . $data['email'] . "
";
        $message .= "Phone: " . $data['phone'] . "
";
        $message .= "Business Name: " . ($data['business_name'] ?? 'N/A') . "
";
        $message .= "Company Type: " . ($data['company_type'] ?? 'N/A') . "
";
        $message .= "Travelers: " . ($data['number_of_travelers'] ?? 'N/A') . "
";
        $message .= "Date: " . ($data['travel_date'] ?? 'N/A') . "
";
        $message .= "Destination: " . ($data['destination'] ?? 'N/A') . "
";
        $message .= "Message: " . ($data['message'] ?? 'N/A') . "
";

        $headers = "From: webmaster@gyfholidays.com" . "
" .
                   "Reply-To: " . $data['email'] . "
" .
                   "X-Mailer: PHP/" . phpversion();

        return mail($to, $subject, $message, $headers);
    }
}
