<?php

namespace Test;

use EM\ItineraryManagement\Tickets;
use EM\ItineraryManagement\TicketSortingAlgorithmB;
use PHPUnit\Framework\TestCase;

class TicketSortingAlgorithmBTestCase extends TestCase
{
    use TestTicketSortingAlgorithmTestingTrait;

    /**
     * @dataProvider inputDataProvider
     */
    public function testSortingB($start, $ticketsArray)
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
}