<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_submission_stores_data_and_sends_email(): void
    {
        Mail::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
        ];

        $response = $this->post(route('contact.store'), $data);

        $response->assertRedirect(route('contact.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_submissions', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'type' => 'contact',
        ]);

        Mail::assertSent(ContactFormSubmitted::class, function ($mail) use ($data) {
            return $mail->submission->email === $data['email'] &&
                $mail->submission->type === 'contact';
        });
    }

    public function test_join_form_submission_stores_data_and_sends_email(): void
    {
        Mail::fake();

        $data = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '987654321',
            'message' => 'I want to join.',
        ];

        $response = $this->post(route('join.store'), $data);

        $response->assertRedirect(route('join.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_submissions', [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'type' => 'join',
        ]);

        Mail::assertSent(ContactFormSubmitted::class, function ($mail) use ($data) {
            return $mail->submission->email === $data['email'] &&
                $mail->submission->type === 'join';
        });
    }
}
