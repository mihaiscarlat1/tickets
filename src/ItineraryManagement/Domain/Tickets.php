<?php


namespace EM\ItineraryManagement\Domain;


use Iterator;

interface Tickets extends Iterator
{
    public function current(): Ticket;

    public function recreate(Ticket ...$ticket): self;
}