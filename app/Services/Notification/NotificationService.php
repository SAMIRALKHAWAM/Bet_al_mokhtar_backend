<?php

namespace App\Services\Notification;

class NotificationService
{


    public function sendNotification($fcm_token, $title = 'title', $body = 'body')
    {
        try {
            $factory = (new \Kreait\Firebase\Factory())
                ->withServiceAccount('betalmoktar-d72dca543861.json');

            $messaging = $factory->createMessaging();


            $message = [
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'token' => $fcm_token,
            ];


            $response = $messaging->send($message);



        } catch (\Kreait\Firebase\Exception\MessagingException $e) {
            return \response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        } catch (\Throwable $e) {

            return \response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }


    }

}
