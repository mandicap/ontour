<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\Tour;
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
}
