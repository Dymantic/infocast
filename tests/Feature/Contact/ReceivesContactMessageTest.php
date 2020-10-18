<?php


namespace Tests\Feature\Contact;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ReceivesContactMessageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        Notification::fake();
    }

    /**
     * @test
     */
    public function a_contact_message_can_be_received()
    {
        $this->disableExceptionHandling();

        $response = $this->json('POST', "/contact", [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => 'TEST LAST NAME',
            'email'      => 'TEST EMAIL',
            'phone'      => 'TEST PHONE',
            'inquiry'    => 'TEST MESSAGE',
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('contact_messages', [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => 'TEST LAST NAME',
            'email'      => 'TEST EMAIL',
            'phone'      => 'TEST PHONE',
            'inquiry'    => 'TEST MESSAGE',
        ]);
    }

    /**
     *@test
     */
    public function successful_receipt_of_a_contact_message_responds_with_a_redirect_url()
    {
        $this->disableExceptionHandling();

        $response = $this->json('POST', "/contact", [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => 'TEST LAST NAME',
            'email'      => 'TEST EMAIL',
            'phone'      => 'TEST PHONE',
            'inquiry'    => 'TEST MESSAGE',
        ]);
        $response->assertStatus(200);



        $this->assertEquals('/thank-you?name=TEST+FIRST+NAME+TEST+LAST+NAME&type=inquiry', $response->json()['redirect_url']);
    }

    /**
     *@test
     */
    public function either_the_first_or_last_names_are_required()
    {
        $response = $this->json('POST', "/contact", [
            'first_name' => '',
            'last_name'  => '',
            'email'      => 'TEST EMAIL',
            'phone'      => 'TEST PHONE',
            'inquiry'    => 'TEST MESSAGE',
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('first_name', $response->json()['errors']);
        $this->assertArrayHasKey('last_name', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function either_the_phone_or_email_is_required()
    {
        $response = $this->json('POST', "/contact", [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => 'TEST LAST NAME',
            'email'      => '',
            'phone'      => '',
            'inquiry'    => 'TEST MESSAGE',
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('phone', $response->json()['errors']);
        $this->assertArrayHasKey('email', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_inquiry_is_required()
    {
        $response = $this->json('POST', "/contact", [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => 'TEST LAST NAME',
            'email'      => 'TEST EMAIL',
            'phone'      => 'TEST PHONE',
            'inquiry'    => '',
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('inquiry', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_first_name_must_be_under_255_characters()
    {
        $response = $this->json('POST', "/contact", [
            'first_name' => str_repeat('X', 257),
            'last_name'  => 'TEST LAST NAME',
            'email'      => 'TEST EMAIL',
            'phone'      => 'TEST PHONE',
            'inquiry'    => 'TEST INQUIRY',
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('first_name', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_last_name_must_be_under_255_characters()
    {
        $response = $this->json('POST', "/contact", [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => str_repeat('X', 257),
            'email'      => 'TEST EMAIL',
            'phone'      => 'TEST PHONE',
            'inquiry'    => 'TEST INQUIRY',
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('last_name', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_phone_must_be_under_255_characters()
    {
        $response = $this->json('POST', "/contact", [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => 'TEST LAST NAME',
            'email'      => 'TEST EMAIL',
            'phone'      => str_repeat('X', 257),
            'inquiry'    => 'TEST INQUIRY',
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('phone', $response->json()['errors']);
    }

    /**
     *@test
     */
    public function the_email_must_be_under_255_characters()
    {
        $response = $this->json('POST', "/contact", [
            'first_name' => 'TEST FIRST NAME',
            'last_name'  => 'TEST LAST NAME',
            'email'      => str_repeat('X', 257),
            'phone'      => 'TEST PHONE',
            'inquiry'    => 'TEST INQUIRY',
        ]);
        $response->assertStatus(422);

        $this->assertArrayHasKey('email', $response->json()['errors']);
    }
}