<?php

namespace App\Service;

use App\Models\Deal;
use App\Models\User;

class DealService
{
    public function GetDeals(User $user)
    {
        $query = Deal::query();
        if (!$user->isAdmin()) {
            return $query->where('user_id', $user->id)->latest()->paginate(10);
        }
        return $query->latest()->paginate(10);
    }

    public function CreateDeal(array $data, int $user_id)
    {
        $payload = [
            'user_id' => $user_id,
            'title' => $data['title'],
            'status' => $data['status'],
            'amount' => $data['amount'],
            'deadline_at' => $data['deadline_at'],
            'contact_id' => $data['contact_id'],
        ];
        return Deal::create($payload);
    }

    public function UpdateDeal(array $data, Deal $deal)
    {
        $deal->update($data);
    }

    public function DeleteDeal(Deal $deal)
    {
        $deal->delete();
    }
}
