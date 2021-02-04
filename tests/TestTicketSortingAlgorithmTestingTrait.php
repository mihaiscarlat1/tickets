<?php


namespace Test;




use EM\ItineraryManagement\Ticket\Ticket;

trait TestTicketSortingAlgorithmTestingTrait
{
    /**
     * Obviously should be batches of data, but one should be enough to get the point across
     * @return array[]
     */
    public function inputDataProvider()
    {
        $ticketsArray[] = $this->getTicketMock('St. Anton am Arlberg Bahnhof', 'Innsbruck Hbf');
        $ticketsArray[] = $this->getTicketMock('Innsbruck Hbf', 'Innsbruck Airport');
        $ticketsArray[] = $this->getTicketMock('Innsbruck Airport', 'Gara Venetia Santa Lucia');
        $ticketsArray[] = $this->getTicketMock('Gara Venetia Santa Lucia', 'Bologna San Ruffillo');
        $ticketsArray[] = $this->getTicketMock('Bologna San Ruffillo', 'Bologna Guglielmo Marconi Airport');
        $ticketsArray[] = $this->getTicketMock('Bologna Guglielmo Marconi Airport', 'Paris CDG Airport');
        $ticketsArray[] = $this->getTicketMock('Paris CDG Airport', 'Chicago');

        return [
            [$ticketsArray],
        ];
    }

    public function duplicateTicketsDataProvider()
    {
        $a = $this->getTicketMock('St. Anton am Arlberg Bahnhof', 'Innsbruck Hbf');
        $b = $this->getTicketMock('Innsbruck Hbf', 'Innsbruck Airport');
        $c = $this->getTicketMock('Innsbruck Airport', 'Gara Venetia Santa Lucia');
        $d = $this->getTicketMock('Gara Venetia Santa Lucia', 'Bologna San Ruffillo');

        return [
            [[$a, $a, $a, $b, $c, $d]],
            [[$a, $b, $c, $d, $d, $d]],
            [[$a, $b, $c, $c, $c, $d]],
            [[$a, $b, $b, $b, $c, $d]],
            [[$a, $b, $a, $b, $a, $c]],
        ];
    }

    private function getTicketMock($from, $to): Ticket
    {
        return $this->getMockForAbstractClass(Ticket::class, [$from, $to]);
    }
}