<?php

namespace App\Actions\Activity;

use App\Models\Activity;

class CreateActivityActions
{
    public function handle(array $data, int $userId): Activity
    {
        $payload = [
            'deal_id' => $data['deal_id'],
            'user_id' => $userId,
            'type' => $data['type'],
            'note' => $data['note'],
            'happened_at' => $data['happened_at']
        ];
        return Activity::create($payload);
    }
}
