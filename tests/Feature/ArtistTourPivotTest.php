<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\Tour;
use Illuminate\Http\Response;
use Tests\TestCase;

class ArtistTourPivotTest extends TestCase
{
    public function testCanAttachATourToAnExistingArtist()
    {
        $artist = Artist::factory()->create()->first();

        $tour = $artist->tours()->create([
            'name' => $this->faker->sentence(),
            'active' => $this->faker->boolean()
        ]);

        $this->seeInDatabase('artist_tour', [
            'artist_id' => $artist->id,
            'tour_id' => $tour->id
        ]);
    }

    public function testCanAttachAnArtistToAnExistingTour()
    {
        $tour = Tour::factory()->create()->first();

        $artist = $tour->artists()->create([
            'name' => $this->faker->name,
            'on_tour' => $this->faker->boolean()
        ]);

        $this->seeInDatabase('artist_tour', [
            'artist_id' => $artist->id,
            'tour_id' => $tour->id
        ]);
    }

    public function testReturnsSpecifiedArtistWithToursInValidFormat()
    {
        $artist = Artist::factory()->create()->first();

        $artist->tours()->create([
            'name' => $this->faker->sentence(),
            'active' => $this->faker->boolean()
        ]);

        $this->json('get', "api/artists/$artist->id")
             ->seeStatusCode(Response::HTTP_OK)
             ->seeJsonEquals([
                'id' => $artist->id,
                'name' => $artist->name,
                'on_tour' => $artist->on_tour,
                'created_at' => $artist->created_at,
                'updated_at' => $artist->updated_at,
                'tours' => $artist->tours()->get()
             ]);
    }

    public function testReturnsSpecifiedTourWithArtistsInValidFormat()
    {
        $tour = Tour::factory()->create()->first();

        $tour->artists()->create([
            'name' => $this->faker->name,
            'on_tour' => $this->faker->boolean()
        ]);

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
}
