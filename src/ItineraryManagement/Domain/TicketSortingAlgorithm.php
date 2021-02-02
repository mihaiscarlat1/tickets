<?php
namespace EM\ItineraryManagement\Domain;

interface TicketSortingAlgorithm
{
    public function sort(Tickets $initialTickets): Tickets;
}