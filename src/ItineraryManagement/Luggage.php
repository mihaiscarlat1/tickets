<?php


namespace EM\ItineraryManagement;


class Luggage
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}