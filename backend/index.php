<?php
require 'lib/Flight.php';
require 'services/EventService.php';
require 'services/VenueService.php';

$eventService = new EventService();
$venueService = new VenueService();

Flight::route('GET /events', function() use ($eventService) {
    Flight::json($eventService->getAllEvents());
});

Flight::route('GET /events/@id', function($id) use ($eventService) {
    Flight::json($eventService->getEvent($id));
});

Flight::route('POST /events', function() use ($eventService) {
    $data = Flight::request()->data->getData();
    try {
        $eventService->createEvent($data);
        Flight::json(["message" => "Event created"], 201);
    } catch (Exception $e) {
        Flight::json(["error" => $e->getMessage()], 400);
    }
});

Flight::route('PUT /events/@id', function($id) use ($eventService) {
    $data = Flight::request()->data->getData();
    $eventService->updateEvent($id, $data);
    Flight::json(["message" => "Event updated"]);
});

Flight::route('DELETE /events/@id', function($id) use ($eventService) {
    $eventService->deleteEvent($id);
    Flight::json(["message" => "Event deleted"]);
});

Flight::route('GET /venues', function() use ($venueService) {
    Flight::json($venueService->getAllVenues());
});

Flight::route('GET /venues/@id', function($id) use ($venueService) {
    Flight::json($venueService->getVenue($id));
});

Flight::route('POST /venues', function() use ($venueService) {
    $data = Flight::request()->data->getData();
    try {
        $venueService->createVenue($data);
        Flight::json(["message" => "Venue created"], 201);
    } catch (Exception $e) {
        Flight::json(["error" => $e->getMessage()], 400);
    }
});

Flight::route('PUT /venues/@id', function($id) use ($venueService) {
    $data = Flight::request()->data->getData();
    $venueService->updateVenue($id, $data);
    Flight::json(["message" => "Venue updated"]);
});

Flight::route('DELETE /venues/@id', function($id) use ($venueService) {
    $venueService->deleteVenue($id);
    Flight::json(["message" => "Venue deleted"]);
});

Flight::start();
