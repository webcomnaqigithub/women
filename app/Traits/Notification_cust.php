<?php

namespace App\Traits;

use App\Models\Notification;
use Illuminate\Support\Facades\File;

trait Notification_cust
{

    protected function sendNotification($sender_id, $receiver_id, $receiver_name, $receiver_image, $content, $product_name, $path)
    {
        Notification::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'receiver_name' => $receiver_name,
            'receiver_image' => $receiver_image,
            'content' => $content,
            'product_name' => $product_name,
            'path' => $path,
        ]);
    }
}