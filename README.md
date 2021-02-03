# Assumptions
1. The biggest assumption I made is regarding the 3 - 4 statement gap in the example. 
   Example 3 specifies that Kevin reaches Venice Airport. Example 4 continues directly
   from Gara Venetia Santa Lucia. I suspect there is a statement missing (probably
   the aforementioned taxi)
2. The printable information part. I may have misunderstood the requirements and i should have received inputs as strings,
   and break them down and build the objects inside the api. But from what i understand, it should be objects who have an abstraction 
   that allows us to easily print the content. If i were to go one step further here, i would separate the concerns, so the objects
   themselves don't have to contain the printing logic. I think it would be good to have an interface (which extends a general TicketPrinterInterface)
   for each ticket type, so Kevin could decide what colors/ texts / language he likes best.

# Documentation
1. I have used phpdoc to generate the documentation, which can be found in documentation
2. I've also created a sequence_diagram. Mainly i've used to document apis through openapi, i don't have much experience lately with other tools
3. Architecture:
    a. ApplicationService is the entrypoint of the app. Can be initially mocked by using ItineraryManager
    b. The input of the app is an array of the implementations of the abstract class Ticket
    c. The output is the same array of tickets, but this time ordered
    d. The sorting algorithm can be injected
4. AlgorithmA has a complexity of O(n). AlgorithmB is less effective, with a (max) complexity of O(n^2).
    

# How to run the code
1. Install composer
   docker: docker run --rm -v ${pwd}:/app composer:latest install --no-dev
2. try the example from the root folder. In case no php interpreter is installed (ie windows), try:
   docker run -p 82:80 --name php-container --rm -v ${pwd}:/var/www/html php:7.4-cli php /var/www/html/example.php


# How to run the tests
1. Install composer for dev. 
   docker run --rm -v ${pwd}:/app composer:latest install
2. Run the test suite from tests
   docker run -p 82:80 --name php-container --rm -v ${pwd}:/var/www/html php:7.4-cli php /var/www/html/vendor/phpunit/phpunit/phpunit --no-configuration --test-suffix TestCase.php /var/www/html/tests
   
# Suggestions for new types of transit 
1. Hot air balloon. Similar to Airport bus, besides the data from the Ticket class, only a ticketNr is needed.
2. Taxi. Just the to and from data are needed
3. Wagons. Needs the identification number perhaps, or maybe even a description
4. Choice transportation. Kevin could decide between multiple method of transportation from one location to another according to his needs.
5. Ferry boat. Would need ferry boat ticket nr, identification number and optionally seat number. Maybe the dock number.
6. Kevin's family has relatives all across the world so it would make sense that there would be a "call your family itinerary". Not quite what would be considered a ticket according to the logic of my app, but still. Similar to Airport bus, except with a phone number instead of the ticket nr.