<?php


namespace EM\ItineraryManagement;


use EM\ItineraryManagement\Ticket\Ticket;

class Printer
{
    public static function printAll(Ticket ...$orderedTickets)
    {
        $i=0;
        echo $i. '. Start'. PHP_EOL;
        foreach($orderedTickets as $ticket) {
            echo ++$i.'. ';
            echo $ticket->humanReadable();
            echo PHP_EOL;
        }
        echo ++$i. '. Last destination reached.';
    }
}