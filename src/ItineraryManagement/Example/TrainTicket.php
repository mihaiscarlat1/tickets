<?php


namespace EM\ItineraryManagement\Example;


use EM\ItineraryManagement\Domain\Ticket;

class TrainTicket extends Ticket
{
    const HUMAN_READABLE = 'Board train %s, Platform %s from %s to %s. %s.';

    const SEAT_NUMBER_HR = 'Seat number %s';
    const NO_SEAT_HR = 'No seat assignment';

    private string $trainNr;
    private string $platform;
    private ?string $seatNr;

    public function __construct($from, $to, string $trainNr, string $platform, ?string $seatNr)
    {
        parent::__construct($from, $to);
        $this->trainNr = $trainNr;
        $this->platform = $platform;
        $this->seatNr = $seatNr;
    }

    /**
     * @return string
     */
    public function trainNr(): string
    {
        return $this->trainNr;
    }

    /**
     * @return string
     */
    public function platform(): string
    {
        return $this->platform;
    }

    /**
     * @return ?string
     */
    public function seatNr(): ?string
    {
        return $this->seatNr;
    }

    public function hasSeatNr(): bool
    {
        return null !== $this->seatNr;
    }

    public function humanReadable(): string
    {
        return sprintf(
            self::HUMAN_READABLE,
            $this->trainNr,
            $this->platform,
            $this->from,
            $this->to,
            self::getSeatOutput()
        );
    }

    private function getSeatOutput(): string
    {
        if($this->seatNr) {
            return sprintf(self::SEAT_NUMBER_HR, $this->seatNr);
        } else {
            return self::NO_SEAT_HR;
        }
    }
}