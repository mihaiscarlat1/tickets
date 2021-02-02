<?php

namespace Test;

use EM\ItineraryManagement\Tickets;
use EM\ItineraryManagement\TicketSortingAlgorithmA;
use PHPUnit\Framework\TestCase;

class TicketSortingAlgorithmATestCase extends TestCase
{
    use TestTicketSortingAlgorithmTestingTrait;

    /**
     * @dataProvider inputDataProvider
     */
    public function testSortingA($start, $ticketsArray)
    {
        $ticketsToBeShuffled = $ticketsArray;
        shuffle($ticketsToBeShuffled);

        $ticketsCorrectOrder = new Tickets(...$ticketsArray);
        $ticketsShuffled = new Tickets(...$ticketsToBeShuffled);

        $ticketSortingAlgo = new TicketSortingAlgorithmA($start);
        $orderedTickets = $ticketSortingAlgo->sort($ticketsShuffled);

        while($ticketsCorrectOrder->valid()) {
            self::assertTrue($orderedTickets->valid());
            $ticket = $ticketsCorrectOrder->current();
            self::assertEqualsCanonicalizing($ticket, $orderedTickets->current());

            $ticketsCorrectOrder->next();
            $orderedTickets->next();
        }
    }
}