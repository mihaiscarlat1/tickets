<?php


namespace EM\ItineraryManagement\Algorithm;


use EM\ItineraryManagement\Exception\DuplicateTicketsException;
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

    private function serializeTicket(Ticket $ticket): string
    {
        return $ticket->from().'_'.$ticket->to();
    }

    /**
     * @param Ticket[] $unsorted
     * @param Ticket[] $sorted
     * @param string[] $duplicateMemo
     * @throws DuplicateTicketsException
     * @throws UnconnectableTicketsException
     */
    public function sortB(array $unsorted, array $sorted = [], array $duplicateMemo = []): array
    {
        if(empty($sorted)) {
            $ticket = array_pop($unsorted);
            $duplicateMemo[] = $this->serializeTicket($ticket);
            $sorted[] = $ticket;
        }

        if(empty($unsorted)) {
            return $sorted;
        }

        $firstTicket = $sorted[0];
        $lastTicket = end($sorted);
        $ticketCount = count($unsorted);
        foreach($unsorted as $k => $unsortedTicket) {
            if($unsortedTicket->sameRoute($firstTicket) // handle duplication
                || $unsortedTicket->sameRoute($lastTicket)
                || in_array($this->serializeTicket($unsortedTicket), $duplicateMemo)
            ){
                throw new DuplicateTicketsException();
            }

            if($unsortedTicket->to() === $firstTicket->from()) {
                unset($unsorted[$k]);
                $duplicateMemo[] = $this->serializeTicket($unsortedTicket);
                array_unshift($sorted, $unsortedTicket);
                break;
            }

            if($unsortedTicket->from() === $lastTicket->to()) {
                unset($unsorted[$k]);
                $duplicateMemo[] = $this->serializeTicket($unsortedTicket);
                $sorted[] = $unsortedTicket;
                break;
            }
        }
        if(count($unsorted) === $ticketCount) {
            throw new UnconnectableTicketsException(); // if the duplicates
        }

        return $this->sortB($unsorted, $sorted, $duplicateMemo);
    }
}