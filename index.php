<?php
include 'vendor/autoload.php';

use EM\ItineraryManagement\AirportBus;
use EM\ItineraryManagement\AirportTicket;
use EM\ItineraryManagement\Printer;
use EM\ItineraryManagement\Tickets;
use EM\ItineraryManagement\TicketSortingAlgorithmA;
use EM\ItineraryManagement\TrainTicket;
use EM\ItineraryManagement\TramTicket;


$start = 'St. Anton am Arlberg Bahnhof';
$a = new TrainTicket('St. Anton am Arlberg Bahnhof', 'Innsbruck Hbf');
$b = new TramTicket('Innsbruck Hbf', 'Innsbruck Airport');
$c = new AirportTicket('Innsbruck Airport', 'Gara Venetia Santa Lucia');
$d = new TrainTicket('Gara Venetia Santa Lucia', 'Bologna San Ruffillo');
$e = new AirportBus('Bologna San Ruffillo', 'Bologna Guglielmo Marconi Airport');
$f = new AirportTicket('Bologna Guglielmo Marconi Airport', 'Paris CDG Airport');
$g = new AirportTicket('Paris CDG Airport', 'Chicago');

$ticketsArtificialArray = [$a, $b, $c, $d, $e, $f, $g];
shuffle($ticketsArtificialArray);

$tickets = new Tickets(...$ticketsArtificialArray);

$ticketSortingAlgo = new TicketSortingAlgorithmA($tickets);
$orderedTickets = $ticketSortingAlgo->sort($start);

while($orderedTickets->valid()) {
    echo Printer::output($orderedTickets->current());
    $orderedTickets->next();
}
