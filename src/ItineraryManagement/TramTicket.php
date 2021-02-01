<?php


namespace EM\ItineraryManagement;


class TramTicket extends Ticket
{
    private string $ticketNr;

    public function __construct(string $from, string $to, string $ticketNr)
    {
        parent::__construct($from, $to);
        $this->ticketNr = $ticketNr;
    }

    /**
     * @return string
     */
    public function getTicketNr(): string
    {
        return $this->ticketNr;
    }
}