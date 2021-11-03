<?php

namespace Tests\Feature;

use App\Models\Tour;
use Illuminate\Http\Response;
use Tests\TestCase;

class ToursTest extends TestCase
{
    public function testReturnsAllToursInValidFormat()
    {
        $this->json('get', 'api/tours')
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

    public function testNewTourIsCreatedSuccessfully()
    {
        $payload = [
            'name' => $this->faker->name,
            'active' => $this->faker->boolean()
        ];

        $this->json('post', 'api/tours', $payload)
             ->seeStatusCode(Response::HTTP_CREATED)
             ->seeJsonStructure([
                 'id',
                 'name',
                 'active',
                 'created_at',
                 'updated_at'
             ]);

        $this->seeInDatabase('tours', $payload);
    }

    public function testReturnsSpecifiedTourInValidFormat()
    {
        $tour = Tour::factory()->create()->first();

        $this->json('get', "api/tours/$tour->id")
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonEquals([
                 'id' => $tour->id,
                 'name' => $tour->name,
                 'active' => $tour->active,
                 'created_at' => $tour->created_at,
                 'updated_at' => $tour->updated_at,
                 'artists' => $tour->artists()->get()
             ]);
    }

    public function testExistingTourIsUpdatedSuccessfully()
    {
        $tour = Tour::factory()->create()->first();

        $payload = [
            'name' => $this->faker->name,
            'active' => $this->faker->boolean()
        ];

        $this->json('put', "api/tours/$tour->id", $payload)
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonEquals([
                 'id' => $tour->id,
                 'name' => $payload['name'],
                 'active' => $payload['active'],
                 'created_at' => $tour->created_at,
                 'updated_at' => $tour->updated_at
             ]);
    }

    public function testExistingTourIsDeletedSuccessfully()
    {
        $tour = Tour::factory()->create()->first();

        $this->json('delete', "api/tours/$tour->id")
             ->seeStatusCode(Response::HTTP_NO_CONTENT);

        $this->notSeeInDatabase('tours', $tour->toArray());
    }
}
