<?php


namespace EM\ItineraryManagement;

use EM\ItineraryManagement\Exception\InvalidArgumentException;

class AirportTicket extends Ticket
{
    const SELF_LUGGAGE = 'self';
    const LUGGAGE_PREVIOUS_FLIGHT = 'previous';

    const LUGGAGE_TYPES = [
        self::SELF_LUGGAGE,
        self::LUGGAGE_PREVIOUS_FLIGHT
    ];

    private string $ticketNr;
    private string $gate;
    private string $seat;
    private string $luggageType;

    public function __construct(string $from, string $to, string $ticketNr, string $gate, string $seat, string $luggageType)
    {
        parent::__construct($from, $to);
        $this->ticketNr = $ticketNr;
        $this->gate = $gate;
        $this->seat = $seat;
        $this->luggageType = $luggageType;

        if(!in_array($luggageType, self::LUGGAGE_TYPES)) {
            throw new InvalidArgumentException('Luggage type invalid, must be one of: ['. implode(',', self::LUGGAGE_TYPES). ']');
        }
        $this->luggageType = $luggageType;
    }

    /**
     * @return string
     */
    public function ticketNr(): string
    {
        return $this->ticketNr;
    }

    /**
     * @return string
     */
    public function gate(): string
    {
        return $this->gate;
    }

    /**
     * @return string
     */
    public function seat(): string
    {
        return $this->seat;
    }

    /**
     * @return string
     */
    public function luggageType(): string
    {
        return $this->luggageType;
    }
}