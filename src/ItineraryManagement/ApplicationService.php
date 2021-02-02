<?php

namespace EM\ItineraryManagement;

use EM\ItineraryManagement\Domain\Tickets;
use EM\ItineraryManagement\Domain\TicketSortingAlgorithm;

class ApplicationService
{
    private TicketSortingAlgorithm $sortingAlgorithm;

    public function __construct(TicketSortingAlgorithm $ticketSortingAlgorithm)
    {
        $this->sortingAlgorithm = $ticketSortingAlgorithm;
    }

    public function sort(Tickets $tickets)
    {
        return $this->sortingAlgorithm->sort($tickets);
    }
}