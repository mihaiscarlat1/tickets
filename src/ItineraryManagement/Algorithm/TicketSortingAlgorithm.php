<?php
namespace EM\ItineraryManagement\Algorithm;

use EM\ItineraryManagement\Exception\DuplicateTicketsException;
use EM\ItineraryManagement\Exception\UnconnectableTicketsException;
use EM\ItineraryManagement\Ticket\Tickets;

interface TicketSortingAlgorithm
{
    /**
     * @throws UnconnectableTicketsException
     * @throws DuplicateTicketsException
     */
    public function sort(Tickets $initialTickets): Tickets;
}