<?php
namespace EM\ItineraryManagement\Ticket;

abstract class Ticket implements Printable
{
    protected string $from;
    protected string $to;

    public function __construct(string $from,string $to)
    {
        $this->to = $to;
        $this->from = $from;
    }

    public function from(): string
    {
        return $this->from;
    }

    public function to(): string
    {
        return $this->to;
    }

    public function sameRoute(Ticket $ticket): bool
    {
        return $this->to === $ticket->to();
    }

    abstract public function humanReadable(): string;
}