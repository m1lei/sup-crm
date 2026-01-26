<?php

namespace App\Service;

use App\Models\Contact;
use App\Models\User;

class ContactService
{
    /**
     * Фильтрация записей в зависимости от прав пользователя
     * Params: App\Models\User Текущий пользователь
     * Return: Если пользователь role=admin то возращает все записи,
     * Если обычный user то только его записи
     */

    public function getContractsForUsers(User $user)
    {
        $query = Contact::query();

        if (!$user->isAdmin()){
            return $query->where('user_id', $user->id)->paginate(10);
        }
        return $query->latest()->paginate(10);
    }

    /**
     * Создание Contract по $data и его $user_id
     * @param array $data данные от пользователя
     * @param int $user_id id пользователя
     * @return Contact
     */
    public function CreateContracts(array $data, int $user_id)
    {
        $payload = [
            'user_id' => $user_id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'company' => $data['company'],
            'note' => $data['note'],
        ];
        return Contact::create($payload);
    }

    /**
     * Обновляет текущий контакт
     * @param Contact $contact текущая запись пользователя
     * @param array $data новые данные для обновления
     * @return void удаляет текущую запись
     */
    public function updateContract(Contact $contact, array $data)
    {
        $contact->update($data);

    }

    public function deleteContract(Contact $contact)
    {
        $contact->delete();
    }
}
