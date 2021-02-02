<?php


namespace EM\ItineraryManagement\PortAdapter;


use EM\ItineraryManagement\Domain\Tickets;

class Printer
{
    public static function printAll(Tickets $orderedTickets)
    {
        $i=0;
        echo $i. '. Start'. PHP_EOL;
        while($orderedTickets->valid()) {
            echo ++$i.'. ';
            echo $orderedTickets->current()->humanReadable();
            echo PHP_EOL;
            $orderedTickets->next();
        }
        echo ++$i. '. Last destination reached.';
    }
}