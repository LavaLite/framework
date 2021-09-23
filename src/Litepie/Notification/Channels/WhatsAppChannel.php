<?php

namespace Litepie\Notification\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Litepie\Notification\Messages\WhatsAppMessage;

class WhatsAppChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toWhatsApp')) {
            $params = $notification->toWhatsApp($notifiable);
        }
        $this->sendNotification($params);
    }

    private function sendNotification(WhatsAppMessage $message)
    {
        $data = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        // ->withOptions([])
            ->withToken(config('services.whatsapp.token'))
            ->withBody($this->prepareBody($message), 'application/json')
            ->post($this->getUrl());
        dd($data->body());

        return $data;
    }

    private function getUrl()
    {
        return config('services.whatsapp.url').'/'.
        config('services.whatsapp.version').'/api/whatsapp/'.
        config('services.whatsapp.appid').'/notification';
    }

    private function prepareBody(WhatsAppMessage $message)
    {
        $array = [
            'storage'     => 'full',
            'destination' => [
                'integrationId' => config('services.whatsapp.integrationid'),
                'destinationId' => $message->to(),
            ],
            'author' => [
                'name'  => config('app.name'),
                'email' => config('mail.from.address'),
                'role'  => 'appMaker',
            ],
            'messageSchema' => 'whatsapp',
            'message'       => [
                'type'     => 'template',
                'template' => [
                    'namespace' => $message->namespace(),
                    'name'      => $message->template(),
                    'language'  => [
                        'policy' => 'deterministic',
                        'code'   => 'en',
                    ],
                    'components' => [
                        [
                            'type'       => 'body',
                            'parameters' => $message->params(),
                        ],
                    ],
                ],
            ],
        ];

        return json_encode($array);
    }
}
