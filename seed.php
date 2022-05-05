<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   require_once 'vendor/autoload.php';

   // checks wheter we are logged in
   $faker = Faker\Factory::create();
    // build INSERT query
    // run query
    // x5
    
    for($i = 0; $i <5; $i++)
    {
        $studentid = $faker->numberBetween(20000001, 29999999);
        $password = password_hash($faker->password(), PASSWORD_DEFAULT);
        $dob = $faker->date($format = 'Y-m-d', $max = '-18 years');
        $firstname = $faker->firstName($gender = null | 'male'|'female');
        $lastname = $faker->lastName();
        $streetAddress = $faker->streetAddress();
        $town = "Reading";
        $county = "Birkshire";
        $country = "United Kingdom";
        $postcode =  "RG1" . $faker->numberBetween(0, 1) . " " . 
        $faker->randomNumber(2, false) . 
        strtoupper($faker->randomLetter()) . strtoupper($faker->randomLetter());
  
        $sql = "INSERT INTO student ('studentid', 'password', 'dob', 'firstname', 'lastname', 'house', 'town', 'county', 'country', 'postcode')
        VALUES ('$studentID', '$password', '$dob', '$firstName', '$lastName', '$streetAddress', '$town', '$county', '$country',
         '$postCode')";

         $result = mysqli_query($conn, $sql);

    }


?>
