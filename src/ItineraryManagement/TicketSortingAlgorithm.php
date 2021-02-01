<?php
namespace EM\ItineraryManagement;

interface TicketSortingAlgorithm
{
    public function sort(string $start): Tickets;
}