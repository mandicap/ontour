<?php

namespace Tests\Feature;

use App\Models\Artist;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;

class ArtistsTest extends TestCase
{
    public function testReturnsAllArtistsInValidFormat()
    {
        $this->json('get', 'api/artists')
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonStructure([
                 'data' => [
                     '*' => [
                         'id',
                         'name',
                         'created_at',
                         'updated_at'
                     ]
                 ]
             ]);
    }

    public function testNewArtistIsCreatedSuccessfully()
    {
        $payload = [
            'name' => $this->faker->name
        ];

        $this->json('post', 'api/artists', $payload)
             ->seeStatusCode(Response::HTTP_CREATED)
             ->seeJsonStructure([
                 'data' => [
                     'id',
                     'name',
                     'created_at',
                     'updated_at'
                 ]
             ]);

        $this->seeInDatabase('artists', $payload);
    }

    public function testReturnsSpecifiedArtistInValidFormat()
    {
        $artist = Artist::factory()->create()->first();

        $this->json('get', "api/artists/$artist->id")
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonEquals([
                 'data' => [
                    'id' => $artist->id,
                    'name' => $artist->name,
                    'created_at' => $artist->created_at,
                    'updated_at' => $artist->updated_at
                 ]
             ]);
    }

    public function testExistingArtistIsUpdatedSuccessfully()
    {
        $artist = Artist::factory()->create()->first();

        $payload = [
            'name' => $this->faker->name
        ];

        $this->json('put', "api/artists/$artist->id", $payload)
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonEquals([
                 'data' => [
                    'id' => $artist->id,
                    'name' => $payload['name'],
                    'created_at' => $artist->created_at,
                    'updated_at' => $artist->updated_at
                 ]
             ]);
    }

    public function testExistingArtistIsDeletedSuccessfully()
    {
        $artist = Artist::factory()->create()->first();

        $this->json('delete', "api/artists/$artist->id")
             ->seeStatusCode(Response::HTTP_NO_CONTENT);

        $this->notSeeInDatabase('artists', $artist);
    }
}
