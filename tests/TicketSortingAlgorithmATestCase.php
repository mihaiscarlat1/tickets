<?php

namespace Test;

use EM\ItineraryManagement\Domain\TicketsStack;
use EM\ItineraryManagement\PortAdapter\TicketSortingAlgorithmA;
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

        $ticketsCorrectOrder = new TicketsStack(...$ticketsArray);
        $ticketsShuffled = new TicketsStack(...$ticketsToBeShuffled);

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
}