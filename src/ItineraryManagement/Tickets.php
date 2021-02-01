<?php
namespace EM\ItineraryManagement;

use Iterator;

class Tickets implements Iterator
{
    private array $tickets;

    public function __construct(Ticket ...$tickets)
    {
        foreach($tickets as $ticket) {
            $this->tickets[] = $ticket;
        }
    }

    public function current()
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

    public function valid()
    {
        return $this->key() !== null;
    }

    public function rewind()
    {
        return reset($this->tickets);
    }
}