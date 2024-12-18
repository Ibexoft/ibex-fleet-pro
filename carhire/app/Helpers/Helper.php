<?php
function email($data)
{
    try {
        $url = 'https://api.brevo.com/v3/smtp/email';
        $apiKey = env('BREVO_API_KEY');
        $data = [
            'sender' => [
                'name' => env('BREVO_MAIL_FROM_NAME'),
                'email' => env('BREVO_MAIL_FROM_ADDRESS')
            ],
            'to' => [
                ['email' => env('BREVO_MAIL_TO_ADDRESS')],
            ],
            'htmlContent' => $data['html'],
            'subject' => $data['subject'],
        ];

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
            "api-key: $apiKey"
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
    } catch (\Exception $e) {
        return false;
    }
    return true;
}
