<?php


namespace EM\ItineraryManagement;


class AirportBusTicket extends Ticket
{
    private ?string $seatNr;

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
}