<?php
include 'vendor/autoload.php';

use EM\ItineraryManagement\Algorithm\TicketSortingAlgorithmB;
use EM\ItineraryManagement\ApplicationService;
use EM\ImplementationExample\AirportBusTicket;
use EM\ImplementationExample\AirportTicket;
use EM\ImplementationExample\TrainTicket;
use EM\ImplementationExample\TramTicket;
use EM\ItineraryManagement\Exception\DuplicateTicketsException;
use EM\ItineraryManagement\Exception\UnconnectableTicketsException;

$start = 'St. Anton am Arlberg Bahnhof';
$a = new TrainTicket('St. Anton am Arlberg Bahnhof', 'Innsbruck Hbf', 'RJX 765', '3', '17C');
$b = new TramTicket('Innsbruck Hbf', 'Innsbruck Airport', 'S5');
$c = new AirportTicket('Innsbruck Airport', 'Gara Venetia Santa Lucia', 'AA904', '10', '18B', AirportTicket::SELF_LUGGAGE);
$d = new TrainTicket('Gara Venetia Santa Lucia', 'Bologna San Ruffillo', 'ICN 35780', '1', '13F');
$e = new AirportBusTicket('Bologna San Ruffillo', 'Bologna Guglielmo Marconi Airport');
$f = new AirportTicket('Bologna Guglielmo Marconi Airport', 'Paris CDG Airport', 'AF1229', '22', '10A', AirportTicket::SELF_LUGGAGE);
$g = new AirportTicket('Paris CDG Airport', 'Chicago', 'AF136', '32', '10A', AirportTicket::LUGGAGE_PREVIOUS_FLIGHT);

$ticketsArray = [$a, $b, $c, $d, $e, $f, $g];
shuffle($ticketsArray);

$sortingAlgo = new TicketSortingAlgorithmB();

$app = new ApplicationService($sortingAlgo); // should be configurable through a service container

try {
    $orderedTickets = $app->sort($ticketsArray);
} catch (UnconnectableTicketsException $e) {
    die('Gap in your itinerary. Please check again!');
} catch (DuplicateTicketsException $e) {
    die('Duplicate tickets. Decide which route you want to take and try again!');
} catch (InvalidArgumentException $e) {
    die('Invalid tickets!');
}


$i=0;
echo $i. '. Start'. PHP_EOL;
foreach($orderedTickets as $ticket) {
    echo ++$i.'. ';
    echo $ticket->humanReadable();
    echo PHP_EOL;
}
echo ++$i. '. Last destination reached.';