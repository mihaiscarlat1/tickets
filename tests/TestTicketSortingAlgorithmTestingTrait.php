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
        $ticketsArray[] = $this->getTicketMock('Chicago', 'a');
        $ticketsArray[] = $this->getTicketMock('a', 'b');
        $ticketsArray[] = $this->getTicketMock('b', 'c');
        $ticketsArray[] = $this->getTicketMock('c', 'd');
        $ticketsArray[] = $this->getTicketMock('d', 'e');

        return [
            [$ticketsArray],
        ];
    }

    private function getTicketMock($to, $from): Ticket
    {
        return $this->getMockForAbstractClass(Ticket::class, [$to, $from]);
    }
}