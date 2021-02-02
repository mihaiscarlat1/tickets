<?php
namespace EM\ItineraryManagement\PortAdapter;

use EM\ItineraryManagement\Domain\Tickets;
use EM\ItineraryManagement\Domain\TicketSortingAlgorithm;

class TicketSortingAlgorithmA implements TicketSortingAlgorithm
{
    public function __construct()
    {
    }

    public function sort(Tickets $initialTickets): Tickets
    {
        $newArrayFrom = $orderedArray = $ticketToArray = [];
        foreach($initialTickets as $ticket) {
            $newArrayFrom[$ticket->from()] = $ticket;
            $ticketToArray[] = $ticket->to();
        }

        $startLocation = current(array_diff(array_keys($newArrayFrom), $ticketToArray));
        $orderedArray[] = $newArrayFrom[$startLocation];
        $initialTicketsCount = count(iterator_to_array($initialTickets));
        for($i=0; $i<$initialTicketsCount; $i++) {
            $prev = end($orderedArray);
            if(isset($newArrayFrom[$prev->to()])) {
                $orderedArray[] = $newArrayFrom[$prev->to()];
            }
        }

        return $initialTickets->recreate(...$orderedArray);
    }
}