<?php
use PHPUnit\Framework\TestCase;
use App\Entity\Room;
use App\Entity\User;
use App\Entity\Bookings;
use DateTime;

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

    public function dataProviderForTestcheckCanPay() : array
    {

        return [
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), 15, true],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 18:05:05'), 5, false],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 10:05:05'), 500, true],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:25:05'), 2, false]
        ];
    }
     /**
     * function has to start with Test
     * @dataProvider dataProviderForTestcheckCanPay
     */
    public function testCheckCanPay(DateTime $start, DateTime $end, int $credit, bool $expectedOutput)
    {
        $user = new User(true); 
        $this->assertEquals($expectedOutput, $user->checkCredit($credit, $start, $end));
    }


    public function dataProviderForTestSameBooming()
    {
        return [
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 11:05:05'), new DateTime('2020-12-12 15:05:05'), false],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 09:05:05'), new DateTime('2020-12-12 13:05:05'), false],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 18:05:05'), true],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 06:05:05'), new DateTime('2020-12-12 10:05:05'), true],
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderForTestSameBooming
     */
    public function testSameBooming(DateTime $start1, DateTime $end1, DateTime $start2, DateTime $end2, bool $expectedOutput)
    {
        $booking = new Bookings();
        $this->assertEquals($expectedOutput, $booking->checkSameBooking($start1, $end1, $start2, $end2));

    }

}