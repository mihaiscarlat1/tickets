<?php

namespace EM\ItineraryManagement;

use EM\ItineraryManagement\Exception\DuplicateTicketsException;
use EM\ItineraryManagement\Exception\UnconnectableTicketsException;
use EM\ItineraryManagement\Ticket\Ticket;
use EM\ItineraryManagement\Ticket\Tickets;
use EM\ItineraryManagement\Algorithm\TicketSortingAlgorithm;
use EM\ItineraryManagement\Exception\InvalidArgumentException;

class ApplicationService implements ItineraryManager
{
    private TicketSortingAlgorithm $sortingAlgorithm;

    public function __construct(TicketSortingAlgorithm $ticketSortingAlgorithm)
    {
        $this->sortingAlgorithm = $ticketSortingAlgorithm;
    }

    /**
     * @param Ticket[] $tickets
     * @return Ticket[]
     * @throws InvalidArgumentException
     * @throws UnconnectableTicketsException
     * @throws DuplicateTicketsException
     */
    public function sort(array $tickets): array
    {
        foreach($tickets as $ticket) {
            if(!$ticket instanceof Ticket) {
                throw new InvalidArgumentException('You can only sort objects of type Ticket');
            }
        }

        $ticketsStack = new Tickets(...$tickets);
        return iterator_to_array($this->sortingAlgorithm->sort($ticketsStack));
    }
}