<?php
namespace EM\ItineraryManagement;

abstract class Ticket
{
    private string $from;
    private string $to;

    public function __construct($from, $to)
    {
        $this->to = $to;
        $this->from = $from;
    }

    public function from(): string
    {
        return $this->from;
    }

    public function to(): string
    {
        return $this->to;
    }
}