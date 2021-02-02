<?php


namespace EM\ItineraryManagement\PortAdapter;


use EM\ItineraryManagement\AirportBusTicket;
use EM\ItineraryManagement\AirportTicket;
use EM\ItineraryManagement\Ticket;
use EM\ItineraryManagement\Tickets;
use EM\ItineraryManagement\TrainTicket;
use EM\ItineraryManagement\TramTicket;

class Printer
{
    const TRAIN_OUTPUT = 'Board train %s, Platform %s from %s to %s. %s.';
    const AIRPORT_OUTPUT = 'From %s, board the flight %s to %s from gate %s, seat %s. %s.';
    const TRAM_OUTPUT = 'Board the Tram %s from %s to %s.';
    const AIRPORT_BUS_OUTPUT = 'Board the airport bus from %s to %s. %s';

    const SEAT_NUMBER_OUTPUT = 'Seat number %s';
    const NO_SEAT_OUTPUT = 'No seat assignment';

    const SELF_LUGGAGE_OUTPUT = 'Self-checkin luggage at counter';
    const PREVIOUS_FLIGHT_LUGGAGE_OUTPUT = 'Luggage will transfer automatically from the last flight';

    public static function output(Ticket $ticket): string
    {
        if($ticket instanceof TrainTicket) {
            return sprintf(
                self::TRAIN_OUTPUT,
                $ticket->trainNr(),
                $ticket->platform(),
                $ticket->from(),
                $ticket->to(),
                self::getSeatOutput($ticket->seatNr())
            );
        }

        if($ticket instanceof AirportTicket) {
            return sprintf(
                self::AIRPORT_OUTPUT,
                $ticket->from(),
                $ticket->ticketNr(),
                $ticket->to(),
                $ticket->gate(),
                $ticket->seat(),
                self::getLuggageOutput($ticket->luggageType())
            );
        }

        if($ticket instanceof TramTicket) {
            return sprintf(
                self::TRAM_OUTPUT,
                $ticket->getTicketNr(),
                $ticket->from(),
                $ticket->to(),
            );
        }

        if($ticket instanceof AirportBusTicket) {
            return sprintf(
                self::AIRPORT_BUS_OUTPUT,
                $ticket->from(),
                $ticket->to(),
                self::getSeatOutput($ticket->seatNr())
            );
        }

        return '';
    }

    private static function getSeatOutput(?string $seatNr): string
    {
        if($seatNr) {
            return sprintf(self::SEAT_NUMBER_OUTPUT, $seatNr);
        } else {
            return self::NO_SEAT_OUTPUT;
        }
    }

    public static function printAll(Tickets $orderedTickets)
    {
        $i=0;
        echo $i. '. Start'. PHP_EOL;
        while($orderedTickets->valid()) {
            echo ++$i.'. ';
            echo Printer::output($orderedTickets->current());
            echo PHP_EOL;
            $orderedTickets->next();
        }
        echo ++$i. '. Last destination reached.';
    }

    private static function getLuggageOutput(string $getLuggageType)
    {
        if($getLuggageType === AirportTicket::LUGGAGE_PREVIOUS_FLIGHT) {
            return self::PREVIOUS_FLIGHT_LUGGAGE_OUTPUT;
        }
        if($getLuggageType === AirportTicket::SELF_LUGGAGE) {
            return self::SELF_LUGGAGE_OUTPUT;
        }
        return '';
    }
}