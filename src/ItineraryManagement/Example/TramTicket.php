<?php


namespace EM\ItineraryManagement\Example;


use EM\ItineraryManagement\Domain\Ticket;

class TramTicket extends Ticket
{
    const HUMAN_READABLE = 'Board the Tram %s from %s to %s.';

    private string $ticketNr;

    public function __construct(string $from, string $to, string $ticketNr)
    {
        parent::__construct($from, $to);
        $this->ticketNr = $ticketNr;
    }

    /**
     * @return string
     */
    public function ticketNr(): string
    {
        return $this->ticketNr;
    }

    public function humanReadable(): string
    {
        return sprintf(
            self::HUMAN_READABLE,
            $this->ticketNr,
            $this->from,
            $this->to,
        );
    }
}