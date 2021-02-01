<?php


interface TicketSortingAlgorithm
{
    public function sort(string $start): Tickets;
}