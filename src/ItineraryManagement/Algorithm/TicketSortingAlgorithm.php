<?php
namespace EM\ItineraryManagement\Algorithm;

use EM\ItineraryManagement\Exception\UnconnectableTicketsException;
use EM\ItineraryManagement\Ticket\Tickets;

interface TicketSortingAlgorithm
{
    /** @throws UnconnectableTicketsException */
    public function sort(Tickets $initialTickets): Tickets;
}