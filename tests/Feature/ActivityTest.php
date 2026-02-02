<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    /** @test */
    public function an_activity_linked_to_deal()
    {
        $this->withoutExceptionHandling();//показывается реальные ошибки

        $user = User::factory()->create();
        $deal = Deal::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)//авторизация юзера
            ->post(route('activity.store', [
                'subject_id' => $deal->id,
                'subject_type' => 'deal',
                'type' => 'call',
                'note' => 'Test deal activity',
                'happened_at' => now()->toDateTimeString(),
            ]));

        //проверяем запись в бд
        $this->assertDatabaseHas('activities', [
            'subject_id' => $deal->id,
            'subject_type' => 'deal',
            'note' => 'Test deal activity',
        ]);
    }

    /** @test */
    public function an_activity_linked_to_contact()
    {
        $this->withoutExceptionHandling();//показывается реальные ошибки

        $user = User::factory()->create();
        $contact = Contact::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->post(route('activity.store', [
                'subject_id' => $contact->id,
                'subject_type' => 'contact',
                'type' => 'call',
                'note' => 'Test contact activity',
                'happened_at' => now()->toDateTimeString(),
            ]));

        $this->assertDatabaseHas('activities', [
            'subject_id' => $contact->id,
            'subject_type' => 'contact',
            'note' => 'Test contact activity',
        ]);
    }
}
