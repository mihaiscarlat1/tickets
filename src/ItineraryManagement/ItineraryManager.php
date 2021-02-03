<?php


namespace EM\ItineraryManagement;


use EM\ItineraryManagement\Exception\InvalidArgumentException;
use EM\ItineraryManagement\Ticket\Ticket;

interface ItineraryManager
{
    /**
     * @param Ticket[] $tickets
     * @return Ticket[]
     * @throws InvalidArgumentException
     * @throws Exception\UnconnectableTicketsException
     */
    public function sort(array $tickets): array;
}