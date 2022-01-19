<?php
use PHPUnit\Framework\TestCase;
use App\Entity\Room;
use App\Entity\User;
use App\Entity\Bookings;
use DateTime;
// use Doctrine\Persistence\ManagerRegistry;

class CheckRoomAvailabilityTest extends TestCase
{
    /**
     * function has to start with Test
     */

    public function dataProviderForPremiumRoom() : array
    {
        return [
            [true, true, true],
            [false, false, true],
            [false, true, true],
            [true, false, false]
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderForPremiumRoom
     */
    public function testPremiumRoom(bool $roomVar, bool $userVar, bool $expectedOutput): void
    {

        $room = new Room($roomVar);
        $user = new User($userVar);

        $this->assertEquals($expectedOutput, $room->canBook($user));
    }


    public function dataProviderForBookingTime() : array
    {
        new DateTime();

        return [
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), true],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 18:05:05'), false],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 10:05:05'), true],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:25:05'), false]
        ];
    }
     /**
     * function has to start with Test
     * @dataProvider dataProviderForBookingTime
     */
    public function testBookingTime(DateTime $start, DateTime $end, bool $expectedOutput)
    {
        $booking = new Bookings();
        $this->assertEquals($expectedOutput, $booking->checkTime($start, $end));
    }

    public function checkCanPay()
    {
        
    }
}