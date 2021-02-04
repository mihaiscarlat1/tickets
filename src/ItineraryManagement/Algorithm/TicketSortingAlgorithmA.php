<?php
namespace EM\ItineraryManagement\Algorithm;

use EM\ItineraryManagement\Exception\DuplicateTicketsException;
use EM\ItineraryManagement\Exception\UnconnectableTicketsException;
use EM\ItineraryManagement\Ticket\Tickets;

class TicketSortingAlgorithmA implements TicketSortingAlgorithm
{
    public function sort(Tickets $initialTickets): Tickets
    {
        $newArrayFrom = $orderedArray = $ticketToArray = [];
        foreach($initialTickets as $ticket) {
            if(isset($newArrayFrom[$ticket->from()]) || in_array($ticket->to(), $ticketToArray)) {
                throw new DuplicateTicketsException();
            }
            $newArrayFrom[$ticket->from()] = $ticket;
            $ticketToArray[] = $ticket->to();
        }

        $unchainedLocations = array_diff(array_keys($newArrayFrom), $ticketToArray);
        if(count($unchainedLocations) !== 1) {
            throw new UnconnectableTicketsException();
        }
        $startLocation = current($unchainedLocations);
        $orderedArray[] = $newArrayFrom[$startLocation];
        $initialTicketsCount = count(iterator_to_array($initialTickets));
        for($i=0; $i<$initialTicketsCount; $i++) {
            $prev = end($orderedArray);
            if(isset($newArrayFrom[$prev->to()])) {
                $orderedArray[] = $newArrayFrom[$prev->to()];
            }
        }

        return new Tickets(...$orderedArray);
    }
}