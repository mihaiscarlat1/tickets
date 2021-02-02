<?php

namespace EM\ItineraryManagement;

use EM\ItineraryManagement\PortAdapter\Printer;

class ApplicationService
{
    private Printer $printer;
    private TicketSortingAlgorithm $sortingAlgorithm;

    public function __construct(Printer $printer, TicketSortingAlgorithm $ticketSortingAlgorithm)
    {
        $this->printer = $printer;
        $this->sortingAlgorithm = $ticketSortingAlgorithm;
    }

    public function sort(Tickets $tickets)
    {
        return $this->sortingAlgorithm($tickets);
    }
}