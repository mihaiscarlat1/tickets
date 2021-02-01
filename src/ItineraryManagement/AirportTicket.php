<?php


namespace EM\ItineraryManagement;


class AirportTicket extends Ticket
{
    private string $ticketNr;
    private string $gate;
    private string $seat;
    private bool $selfLuggage;

    public function __construct(string $from, string $to, string $ticketNr, string $gate, string $seat, bool $selfLuggage)
    {
        parent::__construct($from, $to);
        $this->ticketNr = $ticketNr;
        $this->gate = $gate;
        $this->seat = $seat;
        $this->selfLuggage = $selfLuggage;
    }

    /**
     * @return string
     */
    public function getTicketNr(): string
    {
        return $this->ticketNr;
    }

    /**
     * @return string
     */
    public function getGate(): string
    {
        return $this->gate;
    }

    /**
     * @return string
     */
    public function getSeat(): string
    {
        return $this->seat;
    }

    /**
     * @return bool
     */
    public function isSelfLuggage(): bool
    {
        return $this->selfLuggage;
    }
}