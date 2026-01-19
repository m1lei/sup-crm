<?php

namespace App\Actions\Activity;

use App\Models\Activity;

class UpdateActivityAction
{
    public function handle(array $data, Activity $activity)
    {
        return $activity->update($data);
    }
}
