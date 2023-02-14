<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;

class XenditController extends Controller
{
    private $token = 'xnd_development_fw0zlBcZGyjwpZ3djCQj7MVV03XjSw98aVufisV1fexGHWIHhSLM8SbzgqdQmuh'; // staging

    public function createInvoice($trans, $customer, $item, $successUrl, $failurUrl)  {
        Xendit::setApiKey('xnd_development_fw0zlBcZGyjwpZ3djCQj7MVV03XjSw98aVufisV1fexGHWIHhSLM8SbzgqdQmuh'); //staging

        $params = [
            'external_id' => $trans['invoice'],
            'amount' => $trans['amount'],
            'description' => $trans['description'],
            'invoice_duration' => $trans['duration'],
            'customer' => $customer,
            'customer_notification_preference' => [
                'invoice_created' => [
                    'whatsapp',
                    'sms',
                    'email'
                ],
                'invoice_reminder' => [
                    'whatsapp',
                    'sms',
                    'email'
                ],
                'invoice_paid' => [
                    'whatsapp',
                    'sms',
                    'email'
                ],
                'invoice_expired' => [
                    'whatsapp',
                    'sms',
                    'email'
                ]
            ],
            'success_redirect_url' => $successUrl,
            'failure_redirect_url' => $failurUrl,
            'currency' => 'IDR',
            'items' => $item,
            'fees' => [
                
            ]
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        return $createInvoice;
    }
}
