<?php


namespace EM\ItineraryManagement\PortAdapter;


use EM\ItineraryManagement\Domain\Ticket;
use EM\ItineraryManagement\Domain\Tickets;
use EM\ItineraryManagement\Domain\TicketSortingAlgorithm;

class TicketSortingAlgorithmB implements TicketSortingAlgorithm
{
    public function __construct()
    {
    }

    public function sort(Tickets $initialTickets): Tickets
    {
        $sortedTickets = $this->sortB(iterator_to_array($initialTickets));
        return $initialTickets->recreate(...$sortedTickets);
    }

    /**
     * @param Ticket[] $unsorted
     * @param Ticket[] $sorted
     * @return array
     */
    public function sortB(array $unsorted, array $sorted = []): array
    {
        if(empty($sorted)) {
            $sorted[] = array_pop($unsorted);
        }

        if(empty($unsorted)) {
            return $sorted;
        }

        $firstElem = current($sorted);
        $lastElem = end($sorted);
        $elements = count($unsorted);
        foreach($unsorted as $k=> $v) {
            if($v->to() === $firstElem->from()) {
                unset($unsorted[$k]);
                array_unshift($sorted, $v);
                continue;
            }
            if($v->from() === $lastElem->to()) {
                unset($unsorted[$k]);
                $sorted[] = $v;
                continue;
            }
            if($elements - count($unsorted) === 2) {
                continue;
            }
        }

        return $this->sortB($unsorted, $sorted);
    }
}