<?php
namespace EM\ItineraryManagement\Domain;

class TicketsStack implements Tickets
{
    private array $tickets;

    public function __construct(Ticket ...$tickets)
    {
        foreach($tickets as $ticket) {
            $this->tickets[] = $ticket;
        }
    }

    public function current(): Ticket
    {
        return current($this->tickets);
    }

    public function next()
    {
        return next($this->tickets);
    }

    public function key()
    {
        return key($this->tickets);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function rewind()
    {
        return reset($this->tickets);
    }

    public function recreate(Ticket ...$tickets): Tickets
    {
        return new static(...$tickets);
    }
}