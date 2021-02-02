<?php


namespace EM\ItineraryManagement\Example;


use EM\ItineraryManagement\Domain\Ticket;

class AirportBusTicket extends Ticket
{
    private ?string $seatNr;
    const HUMAN_READABLE = 'Board the airport bus from %s to %s. %s';
    const SEAT_NUMBER_OUTPUT = 'Seat number %s';
    const NO_SEAT_OUTPUT = 'No seat assignment';

    public function __construct(string $from, string $to, ?string $seatNr = '')
    {
        parent::__construct($from, $to);
        $this->seatNr = $seatNr;
    }

    /**
     * @return string|null
     */
    public function seatNr(): ?string
    {
        return $this->seatNr;
    }

    public function humanReadable(): string
    {
        return sprintf(
            self::HUMAN_READABLE,
            $this->from,
            $this->to,
            $this->getSeatOutput()
        );
    }

    private function getSeatOutput(): string
    {
        if($this->seatNr) {
            return sprintf(self::SEAT_NUMBER_OUTPUT, $this->seatNr);
        } else {
            return self::NO_SEAT_OUTPUT;
        }
    }
}