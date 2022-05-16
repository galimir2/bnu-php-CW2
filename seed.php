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
    global $result;
    for($i = 0; $i <5; $i++)
    {
        $studentid = $faker->numberBetween(20000001, 29999999);
        $password = password_hash($faker->password(), PASSWORD_DEFAULT);
        $dob = $faker->date($format = 'Y-m-d', $max = '-18 years');
        $firstname = $faker->firstName($gender = 'male'|'female');
        $lastname = $faker->lastName();
        $streetAddress = $faker->streetAddress();
        $town = "Reading";
        $county = "Berkshire";
        $country = "United Kingdom";
        $postcode =  "RG1" . $faker->numberBetween(0, 1) . " " . 
        $faker->randomNumber(2, false) . 
        strtoupper($faker->randomLetter()) . strtoupper($faker->randomLetter());
  
        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
        VALUES ('$studentid', '$password', '$dob', '$firstname', '$lastname', '$streetAddress', '$town', '$county', '$country',
         '$postcode')";

         $result = mysqli_query($conn, $sql);

    }
    if($result)
    {
        echo "Students have been successfully added";
    }

?>
