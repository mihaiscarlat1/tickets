<?php


class Tickets implements Iterator
{
    private array $tickets;

    public function __construct(Ticket ...$tickets)
    {
        foreach($tickets as $ticket) {
            $this->tickets[] = $ticket;
        }
    }

//    public function sort(string $start)
//    {
//        $newArrayFrom = $orderedArray = [];
//        foreach($this->tickets as $ticket) {
//            $newArrayFrom[$ticket->from()] = $ticket;
//        }
//        $orderedArray[] = $newArrayFrom[$start];
//        foreach($this->tickets as $ticket) {
//            $prev = end($orderedArray);
//            if(isset($newArrayFrom[$prev->to()]))
//                $orderedArray[] = $newArrayFrom[$prev->to()];
//        }
//        return $orderedArray;
//    }

    public function current()
    {
        return current($this->tickets);
    }

    public function next()
    {
        return next($this->tickets);
    }

    public function key()
    {
        return key($this->tickets);
    }

    public function valid()
    {
        return $this->key() !== null;
    }

    public function rewind()
    {
        return reset($this->tickets);
    }
}