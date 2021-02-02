<?php
namespace EM\ItineraryManagement;

interface TicketSortingAlgorithm
{
    public function sort(Tickets $initialTickets): Tickets;
}