<?php

echo phpinfo();
die;
class Ticket
{
    public $from;
    public $to;

    public function __construct($from, $to)
    {
        $this->to = $to;
        $this->from = $from;
    }
}

$start = 'St. Anton am Arlberg Bahnhof';
$a = new Ticket('St. Anton am Arlberg Bahnhof', 'Innsbruck Hbf.');
$b = new Ticket('Innsbruck Hbf.', 'Innsbruck Airport');
$c = new Ticket('Innsbruck Airport', 'Gara Venetia Santa Lucia');
$d = new Ticket('Gara Venetia Santa Lucia', 'Bologna San Ruffillo');
$e = new Ticket('Bologna San Ruffillo', 'Bologna Guglielmo Marconi Airport');
$f = new Ticket('Bologna Guglielmo Marconi Airport', 'Paris CDG Airport');
$g = new Ticket('Paris CDG Airport', 'Chicago');
$end = 'Chicago';


$tickets = [$a, $b, $c, $d, $e, $f, $g];

shuffle($tickets);


/**
 * @param Ticket[] $ticketArray
 * @return array
 */
function quick_sort_tickets($ticketArray/*, $initial, $last*/)
{
    $lt = $gt = array();
    if (count($ticketArray) < 2) {
        return $ticketArray;
    }
    $pivot_key = key($ticketArray);
    $pivot = array_shift($ticketArray);
    foreach ($ticketArray as $val) {
        if ($val->from === $pivot->to /* || $val->from === $last*/) {
            $gt[] = $val;
        } elseif ($val->to === $pivot->from/* || $val->to === $initial*/) {
            $lt[] = $val;
        }
    }
    return array_merge(quick_sort_tickets($lt/*, $initial, $last*/), [$pivot_key => $pivot], quick_sort_tickets($gt/*, $initial, $last*/));
}

/**
 * @param Ticket[] $ticketArray
 * @return array
 */
function sort_tickets($ticketArray, $start)
{
    $newArrayFrom = $orderedArray = [];
    foreach($ticketArray as $ticket) {
        $newArrayFrom[$ticket->from] = $ticket;
    }
    $orderedArray[] = $newArrayFrom[$start];
    foreach($ticketArray as $ticket) {
        $prev = end($orderedArray);
        if(isset($newArrayFrom[$prev->to]))
            $orderedArray[] = $newArrayFrom[$prev->to];
    }
    return $orderedArray;
}


print_r(sort_tickets($tickets, $start));

//print_r($tickets);

