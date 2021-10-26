<?php

namespace Tests\Feature;

use App\Models\Artist;
use Illuminate\Http\Response;
use Tests\TestCase;

class ArtistsTest extends TestCase
{
    public function testReturnsAllArtistsInValidFormat()
    {
        $this->json('get', 'api/artists')
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonStructure([
                 '*' => [
                     'id',
                     'name',
                     'on_tour',
                     'created_at',
                     'updated_at'
                 ]
             ]);
    }

    public function testNewArtistIsCreatedSuccessfully()
    {
        $payload = [
            'name' => $this->faker->name,
            'on_tour' => $this->faker->boolean()
        ];

        $this->json('post', 'api/artists', $payload)
             ->seeStatusCode(Response::HTTP_CREATED)
             ->seeJsonStructure([
                 'id',
                 'name',
                 'on_tour',
                 'created_at',
                 'updated_at'
             ]);

        $this->seeInDatabase('artists', $payload);
    }

    public function testReturnsSpecifiedArtistInValidFormat()
    {
        $artist = Artist::factory()->create()->first();

        $this->json('get', "api/artists/$artist->id")
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonEquals([
                 'id' => $artist->id,
                 'name' => $artist->name,
                 'on_tour' => $artist->on_tour,
                 'created_at' => $artist->created_at,
                 'updated_at' => $artist->updated_at
             ]);
    }

    public function testExistingArtistIsUpdatedSuccessfully()
    {
        $artist = Artist::factory()->create()->first();

        $payload = [
            'name' => $this->faker->name,
            'on_tour' => $this->faker->boolean()
        ];

        $this->json('put', "api/artists/$artist->id", $payload)
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonEquals([
                 'id' => $artist->id,
                 'name' => $payload['name'],
                 'on_tour' => $payload['on_tour'],
                 'created_at' => $artist->created_at,
                 'updated_at' => $artist->updated_at
             ]);
    }

    public function testExistingArtistIsDeletedSuccessfully()
    {
        $artist = Artist::factory()->create()->first();

        $this->json('delete', "api/artists/$artist->id")
             ->seeStatusCode(Response::HTTP_NO_CONTENT);

        $this->notSeeInDatabase('artists', $artist->toArray());
    }
}
