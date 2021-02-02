<?php


namespace EM\ItineraryManagement;


class TicketSortingAlgorithmB implements TicketSortingAlgorithm
{
    public function __construct()
    {
    }

    public function sort(Tickets $initialTickets): Tickets
    {
        $sortedTickets = $this->sortB(iterator_to_array($initialTickets));
        return New Tickets(...$sortedTickets);
    }

    /**
     * @param Ticket[] $a
     * @param Ticket[] $sorted
     * @return array
     */
    public function sortB(array $a, array $sorted = []): array
    {
        if(empty($sorted)) {
            $sorted[] = array_pop($a);
        }

        if(empty($a)) {
            return $sorted;
        }

        $firstElem = current($sorted);
        $lastElem = end($sorted);
        $elements = count($a);
        foreach($a as $k=>$v) {
            if($v->to() === $firstElem->from()) {
                unset($a[$k]);
                array_unshift($sorted, $v);
                continue;
            }
            if($v->from() === $lastElem->to()) {
                unset($a[$k]);
                $sorted[] = $v;
                continue;
            }
            if($elements - count($a) === 2) {
                continue;
            }
        }

        return $this->sortB($a, $sorted);
    }
}