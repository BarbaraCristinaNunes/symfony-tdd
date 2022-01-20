<?php

namespace App\Entity;

use App\Repository\BookingsRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: BookingsRepository::class)]
class Bookings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $user_id;

    #[ORM\Column(type: 'integer')]
    private $room_id;

    #[ORM\Column(type: 'date')]
    private $start_date;

    #[ORM\Column(type: 'datetime')]
    private $start_time;

    #[ORM\Column(type: 'date')]
    private $end_date;

    #[ORM\Column(type: 'datetime')]
    private $end_time;
    

    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getRoomId(): ?int
    {
        return $this->room_id;
    }

    public function setRoomId(int $room_id): self
    {
        $this->room_id = $room_id;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeInterface $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function checkTime(DateTime $start, DateTime $end): bool
    {
        $diffInterval = $end->diff($start);
        $diffDay = $diffInterval->d;
        $diffMonth = $diffInterval->m;
        $diffYear = $diffInterval->y;
        $diffHours = $diffInterval->h;
        $diffMinutes = $diffInterval->i;
        
        $time = ($diffHours * 60) + $diffMinutes;
        
        
        var_dump("day: ", $diffDay);
        var_dump("month: ", $diffMonth);
        var_dump("year: ", $diffYear);
        var_dump("hour: ", $diffHours);
        var_dump("min: ", $diffMinutes);
        var_dump("min to hour: ", $time);
        if($diffDay == 0 && $diffMonth == 0 && $diffYear == 0 && $time >= 0 && $time <= 240){

           return true;

        }
        return false;
    }

    public  function checkSameBooking(DateTime $start1, DateTime $end1, DateTime $start2, DateTime $end2)
    {
        
        $startTime1 = $start1->gettimestamp();
        $startTime2 = $start2->gettimestamp();
        $endTime1 = $end1->gettimestamp();
        $endTime2 = $end2->gettimestamp();

        if($startTime2 > $startTime1 && $startTime2 < $endTime1 && $endTime2 > $endTime1){
            return false;
        }elseif($startTime2 > $startTime1 - 14400000 && $startTime2 < $startTime1 && $endTime2 > $startTime1){
            return false;
        }else{
            return true;
        }
    }
}
