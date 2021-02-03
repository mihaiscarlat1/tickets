<?php


namespace EM\ItineraryManagement\Algorithm;


use EM\ItineraryManagement\Exception\UnconnectableTicketsException;
use EM\ItineraryManagement\Ticket\Ticket;
use EM\ItineraryManagement\Ticket\Tickets;

class TicketSortingAlgorithmB implements TicketSortingAlgorithm
{
    public function sort(Tickets $initialTickets): Tickets
    {
        $sortedTickets = $this->sortB(iterator_to_array($initialTickets));
        return new Tickets(...$sortedTickets);
    }

    /**
     * @param Ticket[] $unsorted
     * @param Ticket[] $sorted
     * @return array
     * @throws UnconnectableTicketsException
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
        $elementsCount = count($unsorted);
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
            if($elementsCount - count($unsorted) === 2) {
                continue;
            }
        }
        if(count($unsorted) === $elementsCount) {
            throw new UnconnectableTicketsException();
        }

        return $this->sortB($unsorted, $sorted);
    }
}