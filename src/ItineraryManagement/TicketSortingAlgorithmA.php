<?php


class TicketSortingAlgorithmA implements TicketSortingAlgorithm
{
    private Tickets $initialTickets;

    public function __construct(Tickets $initialTickets)
    {
        $this->initialTickets = $initialTickets;
    }

    public function sort(string $start): Tickets
    {
        $newArrayFrom = $orderedArray = [];
        foreach($this->initialTickets as $ticket) {
            $newArrayFrom[$ticket->from()] = $ticket;
        }
        $orderedArray[] = $newArrayFrom[$start];
        foreach($this->initialTickets as $ticket) {
            $prev = end($orderedArray);
            if(isset($newArrayFrom[$prev->to()]))
                $orderedArray[] = $newArrayFrom[$prev->to()];
        }

        return new Tickets(...$orderedArray);
    }
}