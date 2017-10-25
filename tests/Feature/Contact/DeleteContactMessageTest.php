<?php


namespace Tests\Feature\Contact;


use App\Contact\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteContactMessageTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_contact_message_can_be_deleted()
    {
        $this->disableExceptionHandling();
        $message = factory(ContactMessage::class)->create();

        $response = $this->asLoggedInUser()->delete("/admin/inquiries/{$message->id}");
        $response->assertStatus(302);
        $response->assertRedirect('/admin/inquiries');

        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }
}