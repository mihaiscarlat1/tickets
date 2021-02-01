<?php

define('CLASS_DIR', 'src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_extensions('.php');
spl_autoload_register();

new ApplicationService();

$start = 'St. Anton am Arlberg Bahnhof';
$a = new Ticket('St. Anton am Arlberg Bahnhof', 'Innsbruck Hbf.');
$b = new Ticket('Innsbruck Hbf.', 'Innsbruck Airport');
$c = new Ticket('Innsbruck Airport', 'Gara Venetia Santa Lucia');
$d = new Ticket('Gara Venetia Santa Lucia', 'Bologna San Ruffillo');
$e = new Ticket('Bologna San Ruffillo', 'Bologna Guglielmo Marconi Airport');
$f = new Ticket('Bologna Guglielmo Marconi Airport', 'Paris CDG Airport');
$g = new Ticket('Paris CDG Airport', 'Chicago');

$ticketsArtificialArray = [$a, $b, $c, $d, $e, $f, $g];
shuffle($ticketsArtificialArray);

$tickets = new Tickets(...$ticketsArtificialArray);

$ticketSortingAlgo = new TicketSortingAlgorithmA($tickets);
$orderedTickets = $ticketSortingAlgo->sort($start);

while($orderedTickets->valid()) {
    print_r($orderedTickets->current());
    $orderedTickets->next();
}
