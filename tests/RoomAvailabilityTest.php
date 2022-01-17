<?php

class CheckRoomAvailabilityTest extends TestCase
{
    /**
     * function has to start with Test
     */
    public function testPremiumRoom(): void
    {
        $room = new Room(false);
        $user = new User(false);

        $this->assertTrue($room->canBook($user));

        $room = new Room(true);//premium room, with no premium user
        $user = new User(false);

        $this->assertFalse($room->canBook($user));
    }
}