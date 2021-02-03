<?php


namespace EM\ImplementationExample;

use EM\ItineraryManagement\Exception\InvalidArgumentException;
use EM\ItineraryManagement\Ticket\Ticket;

/** @package ImplementationExample */
class AirportTicket extends Ticket
{
    const HUMAN_READABLE = 'From %s, board the flight %s to %s from gate %s, seat %s. %s.';
    const SELF_LUGGAGE_OUTPUT = 'Self-checkin luggage at counter';
    const PREVIOUS_FLIGHT_LUGGAGE_OUTPUT = 'Luggage will transfer automatically from the last flight';

    const HUMAN_READABLE_LUGGAGE_OPTIONS = [
        self::SELF_LUGGAGE => self::SELF_LUGGAGE_OUTPUT,
        self::LUGGAGE_PREVIOUS_FLIGHT => self::PREVIOUS_FLIGHT_LUGGAGE_OUTPUT
    ];

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

    public function humanReadable(): string
    {
        return sprintf(
            self::HUMAN_READABLE,
            $this->from,
            $this->ticketNr,
            $this->to,
            $this->gate,
            $this->seat,
            self::HUMAN_READABLE_LUGGAGE_OPTIONS[$this->luggageType]
        );
    }
}