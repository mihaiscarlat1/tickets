<?php
namespace EM\ItineraryManagement;

class TicketSortingAlgorithmA implements TicketSortingAlgorithm
{
    private string $start;

    public function __construct(string $start)
    {
        $this->start = $start;
    }

    public function sort(Tickets $initialTickets): Tickets
    {
        $newArrayFrom = $orderedArray = [];
        foreach($initialTickets as $ticket) {
            $newArrayFrom[$ticket->from()] = $ticket;
        }
        $orderedArray[] = $newArrayFrom[$this->start];
        $initialTicketsCount = count(iterator_to_array($initialTickets));
        for($i=0; $i<$initialTicketsCount; $i++) {
            $prev = end($orderedArray);
            if(isset($newArrayFrom[$prev->to()]))
                $orderedArray[] = $newArrayFrom[$prev->to()];
        }

        return new Tickets(...$orderedArray);
    }
}