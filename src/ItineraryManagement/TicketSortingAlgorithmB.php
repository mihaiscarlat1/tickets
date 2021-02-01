<?php


namespace EM\ItineraryManagement;


class TicketSortingAlgorithmB implements TicketSortingAlgorithm
{
    private Tickets $initialTickets;

    public function __construct(Tickets $initialTickets)
    {
        $this->initialTickets = $initialTickets;
    }

    public function sort(string $start): Tickets
    {
        $sortedTickets = $this->sortB(iterator_to_array($this->initialTickets));
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
        }

        return $this->sortB($a, $sorted);
    }
}