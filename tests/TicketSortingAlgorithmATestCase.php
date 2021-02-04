<?php

namespace Test;

use EM\ItineraryManagement\Algorithm\TicketSortingAlgorithmA;
use EM\ItineraryManagement\Algorithm\TicketSortingAlgorithmB;
use EM\ItineraryManagement\Exception\DuplicateTicketsException;
use EM\ItineraryManagement\Exception\UnconnectableTicketsException;
use EM\ItineraryManagement\Ticket\Tickets;
use PHPUnit\Framework\TestCase;

class TicketSortingAlgorithmATestCase extends TestCase
{
    use TestTicketSortingAlgorithmTestingTrait;

    /**
     * @dataProvider inputDataProvider
     */
    public function testSortingA($ticketsArray)
    {
        $ticketsToBeShuffled = $ticketsArray;
        shuffle($ticketsToBeShuffled);

        $ticketsCorrectOrder = new Tickets(...$ticketsArray);
        $ticketsShuffled = new Tickets(...$ticketsToBeShuffled);

        $ticketSortingAlgo = new TicketSortingAlgorithmA();
        $orderedTickets = $ticketSortingAlgo->sort($ticketsShuffled);

        while($ticketsCorrectOrder->valid()) {
            self::assertTrue($orderedTickets->valid());
            $ticket = $ticketsCorrectOrder->current();
            self::assertEqualsCanonicalizing($ticket, $orderedTickets->current());

            $ticketsCorrectOrder->next();
            $orderedTickets->next();
        }
    }

    /**
     * @dataProvider inputDataProvider
     */
    public function testTicketsNotConnectingThrowException($ticketsArray)
    {
        $this->expectException(UnconnectableTicketsException::class);

        array_splice($ticketsArray, 1, 2);
        $ticketsToBeShuffled = $ticketsArray;
        shuffle($ticketsToBeShuffled);

        $ticketsShuffled = new Tickets(...$ticketsToBeShuffled);

        $ticketSortingAlgo = new TicketSortingAlgorithmA();
        $ticketSortingAlgo->sort($ticketsShuffled);
    }

    /**
     * @dataProvider duplicateTicketsDataProvider
     */
    public function testDuplicateTicketsThrowException($ticketsArray)
    {
        $this->expectException(DuplicateTicketsException::class);

        $ticketSortingAlgo = new TicketSortingAlgorithmA();
        $ticketSortingAlgo->sort(new Tickets(...$ticketsArray));
    }
}