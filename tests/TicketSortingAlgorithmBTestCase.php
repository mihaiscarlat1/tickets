<?php

namespace Test;

use EM\ItineraryManagement\Algorithm\TicketSortingAlgorithmA;
use EM\ItineraryManagement\Algorithm\TicketSortingAlgorithmB;
use EM\ItineraryManagement\Exception\DuplicateTicketsException;
use EM\ItineraryManagement\Exception\UnconnectableTicketsException;
use EM\ItineraryManagement\Ticket\Tickets;
use PHPUnit\Framework\TestCase;

class TicketSortingAlgorithmBTestCase extends TestCase
{
    use TestTicketSortingAlgorithmTestingTrait;

    /**
     * @dataProvider inputDataProvider
     */
    public function testSortingB($ticketsArray)
    {
        $ticketsArtificialArray = $ticketsArray;
        shuffle($ticketsArtificialArray);

        $ticketsCorrectOrder = new Tickets(...$ticketsArray);
        $ticketsShuffled = new Tickets(...$ticketsArtificialArray);

        $ticketSortingAlgo = new TicketSortingAlgorithmB();
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

        $ticketSortingAlgo = new TicketSortingAlgorithmB();
        $ticketSortingAlgo->sort($ticketsShuffled);
    }

    /**
     * @dataProvider duplicateTicketsDataProvider
     */
    public function testDuplicateTicketsThrowException($ticketsArray)
    {
        $this->expectException(DuplicateTicketsException::class);

        $ticketSortingAlgo = new TicketSortingAlgorithmB();
        $ticketSortingAlgo->sort(new Tickets(...$ticketsArray));

        print_r($ticketsArray);
    }
}