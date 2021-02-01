<?php
namespace EM\ItineraryManagement;

abstract class Ticket
{
    protected string $from;
    protected string $to;

    public function __construct(string $from,string $to)
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