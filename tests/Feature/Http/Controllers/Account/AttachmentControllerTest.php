<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\Attachment;
use App\Models\Uploader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\AttachmentController
 */
final class AttachmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $attachments = Attachment::factory()->count(3)->create();

        $response = $this->get(route('attachments.index'));

        $response->assertOk();
        $response->assertViewIs('attachment.index');
        $response->assertViewHas('attachments');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('attachments.create'));

        $response->assertOk();
        $response->assertViewIs('attachment.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\AttachmentController::class,
            'store',
            \App\Http\Requests\Account\AttachmentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $uploader = Uploader::factory()->create();
        $title = $this->faker->sentence(4);
        $path = $this->faker->word();
        $mime_type = $this->faker->word();
        $size = $this->faker->numberBetween(-10000, 10000);
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('attachments.store'), [
            'uploader_id' => $uploader->id,
            'title' => $title,
            'path' => $path,
            'mime_type' => $mime_type,
            'size' => $size,
            'position' => $position,
        ]);

        $attachments = Attachment::query()
            ->where('uploader_id', $uploader->id)
            ->where('title', $title)
            ->where('path', $path)
            ->where('mime_type', $mime_type)
            ->where('size', $size)
            ->where('position', $position)
            ->get();
        $this->assertCount(1, $attachments);
        $attachment = $attachments->first();

        $response->assertRedirect(route('attachments.index'));
        $response->assertSessionHas('attachment.id', $attachment->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $attachment = Attachment::factory()->create();

        $response = $this->get(route('attachments.show', $attachment));

        $response->assertOk();
        $response->assertViewIs('attachment.show');
        $response->assertViewHas('attachment');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $attachment = Attachment::factory()->create();

        $response = $this->get(route('attachments.edit', $attachment));

        $response->assertOk();
        $response->assertViewIs('attachment.edit');
        $response->assertViewHas('attachment');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\AttachmentController::class,
            'update',
            \App\Http\Requests\Account\AttachmentUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $attachment = Attachment::factory()->create();
        $uploader = Uploader::factory()->create();
        $title = $this->faker->sentence(4);
        $path = $this->faker->word();
        $mime_type = $this->faker->word();
        $size = $this->faker->numberBetween(-10000, 10000);
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('attachments.update', $attachment), [
            'uploader_id' => $uploader->id,
            'title' => $title,
            'path' => $path,
            'mime_type' => $mime_type,
            'size' => $size,
            'position' => $position,
        ]);

        $attachment->refresh();

        $response->assertRedirect(route('attachments.index'));
        $response->assertSessionHas('attachment.id', $attachment->id);

        $this->assertEquals($uploader->id, $attachment->uploader_id);
        $this->assertEquals($title, $attachment->title);
        $this->assertEquals($path, $attachment->path);
        $this->assertEquals($mime_type, $attachment->mime_type);
        $this->assertEquals($size, $attachment->size);
        $this->assertEquals($position, $attachment->position);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $attachment = Attachment::factory()->create();

        $response = $this->delete(route('attachments.destroy', $attachment));

        $response->assertRedirect(route('attachments.index'));

        $this->assertModelMissing($attachment);
    }
}
