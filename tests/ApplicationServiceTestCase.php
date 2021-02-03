<?php


namespace Test;


use EM\ItineraryManagement\Algorithm\TicketSortingAlgorithm;
use EM\ItineraryManagement\ApplicationService;
use EM\ItineraryManagement\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ApplicationServiceTestCase extends TestCase
{
    /**
     * @var TicketSortingAlgorithm|\PHPUnit\Framework\MockObject\MockObject
     */
    private $sortingAlgorithm;

    public function setUp(): void
    {
        $this->sortingAlgorithm = $this->createMock(TicketSortingAlgorithm::class);
    }

    public function testSortWithInvalidInputShouldReceiveException()
    {
        $this->expectException(InvalidArgumentException::class);

        $app = new ApplicationService($this->sortingAlgorithm);

        $invalidData = [1, '', []];
        $app->sort($invalidData);
    }
}