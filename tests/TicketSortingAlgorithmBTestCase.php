<?php

namespace Test;

use EM\ItineraryManagement\Domain\TicketsStack;
use EM\ItineraryManagement\PortAdapter\TicketSortingAlgorithmB;
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

        $ticketsCorrectOrder = new TicketsStack(...$ticketsArray);
        $ticketsShuffled = new TicketsStack(...$ticketsArtificialArray);

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