<?php
include 'vendor/autoload.php';

use EM\ItineraryManagement\AirportBusTicket;
use EM\ItineraryManagement\AirportTicket;
use EM\ItineraryManagement\Printer;
use EM\ItineraryManagement\Tickets;
use EM\ItineraryManagement\TicketSortingAlgorithmA;
use EM\ItineraryManagement\TicketSortingAlgorithmB;
use EM\ItineraryManagement\TrainTicket;
use EM\ItineraryManagement\TramTicket;

$start = 'St. Anton am Arlberg Bahnhof';
$a = new TrainTicket('St. Anton am Arlberg Bahnhof', 'Innsbruck Hbf', 'RJX 765', '3', '17C');
$b = new TramTicket('Innsbruck Hbf', 'Innsbruck Airport', 'S5');
$c = new AirportTicket('Innsbruck Airport', 'Gara Venetia Santa Lucia', 'AA904', '10', '18B', AirportTicket::SELF_LUGGAGE);
$d = new TrainTicket('Gara Venetia Santa Lucia', 'Bologna San Ruffillo', 'ICN 35780', '1', '13F');
$e = new AirportBusTicket('Bologna San Ruffillo', 'Bologna Guglielmo Marconi Airport');
$f = new AirportTicket('Bologna Guglielmo Marconi Airport', 'Paris CDG Airport', 'AF1229', '22', '10A', AirportTicket::SELF_LUGGAGE);
$g = new AirportTicket('Paris CDG Airport', 'Chicago', 'AF136', '32', '10A', AirportTicket::LUGGAGE_PREVIOUS_FLIGHT);

$ticketsArtificialArray = [$a, $b, $c, $d, $e, $f, $g];
shuffle($ticketsArtificialArray);

$tickets = new Tickets(...$ticketsArtificialArray);

$ticketSortingAlgo = new TicketSortingAlgorithmB($tickets);
$orderedTickets = $ticketSortingAlgo->sort($start);

//print_r($orderedTickets);

Printer::printAll($orderedTickets);
