<?php


namespace EM\ItineraryManagement;


class TrainTicket extends Ticket
{
    private string $trainNr;
    private string $platform;
    private ?string $seatNr;

    public function __construct($from, $to, string $trainNr, string $platform, ?string $seatNr)
    {
        parent::__construct($from, $to);
        $this->trainNr = $trainNr;
        $this->platform = $platform;
        $this->seatNr = $seatNr;
    }

    /**
     * @return string
     */
    public function getTrainNr(): string
    {
        return $this->trainNr;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * @return ?string
     */
    public function getSeatNr(): ?string
    {
        return $this->seatNr;
    }

    public function hasSeatNr(): bool
    {
        return null !== $this->seatNr;
    }
}