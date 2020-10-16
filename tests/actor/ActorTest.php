<?php

use App\Models\Actor;

class ActorTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_a_actor()
    {
        $actor = Actor::factory()->create();
        $this->assertNotNull($actor->id);
        $this->seeInDatabase('actors', [
            'username' => $actor->username
        ]);
    }

    /**
     * @test
     */
    public function it_can_get_list_of_users()
    {
        Actor::factory()->count(50)->create();
        $response = $this->get($this->url())->seeStatusCode(200);
        $content = $this->getContent($response);
        $this->assertNotEmpty($content->data);
        $this->assertSame(50, $content->extra->count);
    }


    /**
    * @test
    */
    public function it_can_assign_to_an_actor() {
        $this->withoutExceptionHandling();
        $actor = Actor::factory()->create();
        $this->post($this->url())->seeStatusCode(201);
    }

    private function url(): string
    {
        return 'api/v1/actor';
    }

}
