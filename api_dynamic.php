<?php

    ini_set('display_errors', 1);
    ini_set('displau_startup_errors', 1);
    error_reporting(E_ALL);
    //this is the basic way of getting a database handler from PDO, PHP's built in quasi-ORM
    $dbhandle = new PDO("sqlite:scrabble.sqlite") or die("Failed to open DB");
    if (!$dbhandle) die ($error);

    //$test = json_decode($_POST,true);
    //$sword = $test["word"];
    $rackback = $_POST.word;

    //this is a sample query which gets some data, the order by part shuffles the results
    //the limit 0, 10 takes the first 10 results.
    // you might want to consider taking more results, implementing "pagination",
    // ordering by rank, etc.
    $query = "SELECT rack, words FROM racks WHERE rack=".$rackback;

    //this next line could actually be used to provide user_given input to the query to
    //avoid SQL injection attacks
    $statement = $dbhandle->prepare($query);
    $statement->execute();

    //The results of the query are typically many rows of data
    //there are several ways of getting the data out, iterating row by row,
    //I chose to get associative arrays inside of a big array
    //this will naturally create a pleasant array of JSON data when I echo in a couple lines
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    //$results = $results[0];
    // $rackCombos = array($combinations($results.rack));
    //
    // $combinations = new Func(function($string = null) {
    //   $result = new Arr();
    //   $loop = new Func(function($start = null, $depth = null, $prefix = null) use (&$string, &$loop, &$result) {
    //     for ($i = $start; $i < get($string, "length"); $i++) {
    //       $next = _plus($prefix, get($string, $i));
    //       if ($depth > 0.0) {
    //         call($loop, _plus($i, 1.0), to_number($depth) - 1.0, $next);
    //       } else {
    //         call_method($result, "push", $next);
    //       }
    //     }
    //   });
    //   for ($i = 0.0; $i < get($string, "length"); $i++) {
    //     call($loop, 0.0, $i, "");
    //   }
    //   return $result;
    // });

    //this part is perhaps overkill but I wanted to set the HTTP headers and status code
    //making to this line means everything was great with this request
    header('HTTP/1.1 200 OK');
    //this lets the browser know to expect json
    header('Content-Type: application/json');
    //this creates json and gives it back to the browser
    echo json_encode($results);
?>
