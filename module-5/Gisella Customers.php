<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gisella Customers</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
        }

        h1, h2 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }

        .result {
            background-color: white;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>

<h1>Customer Information</h1>

<?php

/*
 * Name: Gisella Customers
 * Description: This program creates an array containing customer
 * information and uses PHP array methods to search for customers
 * using different data fields.
 */

// Create an array containing 10 customers.
$customers = [
    [
        "firstName" => "John",
        "lastName" => "Smith",
        "age" => 35,
        "phone" => "717-555-1001"
    ],
    [
        "firstName" => "Maria",
        "lastName" => "Garcia",
        "age" => 28,
        "phone" => "717-555-1002"
    ],
    [
        "firstName" => "David",
        "lastName" => "Johnson",
        "age" => 42,
        "phone" => "717-555-1003"
    ],
    [
        "firstName" => "Sarah",
        "lastName" => "Williams",
        "age" => 31,
        "phone" => "717-555-1004"
    ],
    [
        "firstName" => "Michael",
        "lastName" => "Brown",
        "age" => 25,
        "phone" => "717-555-1005"
    ],
    [
        "firstName" => "Jennifer",
        "lastName" => "Davis",
        "age" => 39,
        "phone" => "717-555-1006"
    ],
    [
        "firstName" => "Robert",
        "lastName" => "Miller",
        "age" => 47,
        "phone" => "717-555-1007"
    ],
    [
        "firstName" => "Lisa",
        "lastName" => "Wilson",
        "age" => 22,
        "phone" => "717-555-1008"
    ],
    [
        "firstName" => "James",
        "lastName" => "Moore",
        "age" => 33,
        "phone" => "717-555-1009"
    ],
    [
        "firstName" => "Amanda",
        "lastName" => "Taylor",
        "age" => 29,
        "phone" => "717-555-1010"
    ]
];

/*
 * Display all customers.
 */
echo "<h2>All Customers</h2>";

echo "<table>";
echo "<tr>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Age</th>";
echo "<th>Phone Number</th>";
echo "</tr>";

foreach ($customers as $customer) {
    echo "<tr>";
    echo "<td>" . $customer["firstName"] . "</td>";
    echo "<td>" . $customer["lastName"] . "</td>";
    echo "<td>" . $customer["age"] . "</td>";
    echo "<td>" . $customer["phone"] . "</td>";
    echo "</tr>";
}

echo "</table>";

/*
 * Search for a customer by first name.
 */
$searchFirstName = "Maria";

echo "<div class='result'>";
echo "<h2>Search by First Name</h2>";

foreach ($customers as $customer) {
    if ($customer["firstName"] === $searchFirstName) {
        echo "Customer found: "
            . $customer["firstName"] . " "
            . $customer["lastName"]
            . ", Age: " . $customer["age"]
            . ", Phone: " . $customer["phone"];
    }
}

echo "</div>";

/*
 * Search for a customer by last name.
 */
$searchLastName = "Miller";

echo "<div class='result'>";
echo "<h2>Search by Last Name</h2>";

foreach ($customers as $customer) {
    if ($customer["lastName"] === $searchLastName) {
        echo "Customer found: "
            . $customer["firstName"] . " "
            . $customer["lastName"]
            . ", Age: " . $customer["age"]
            . ", Phone: " . $customer["phone"];
    }
}

echo "</div>";

/*
 * Search for customers by age.
 */
$searchAge = 29;

echo "<div class='result'>";
echo "<h2>Search by Age</h2>";

foreach ($customers as $customer) {
    if ($customer["age"] === $searchAge) {
        echo "Customer found: "
            . $customer["firstName"] . " "
            . $customer["lastName"]
            . ", Age: " . $customer["age"]
            . ", Phone: " . $customer["phone"];
    }
}

echo "</div>";

/*
 * Search for a customer by phone number.
 */
$searchPhone = "717-555-1007";

echo "<div class='result'>";
echo "<h2>Search by Phone Number</h2>";

foreach ($customers as $customer) {
    if ($customer["phone"] === $searchPhone) {
        echo "Customer found: "
            . $customer["firstName"] . " "
            . $customer["lastName"]
            . ", Age: " . $customer["age"]
            . ", Phone: " . $customer["phone"];
    }
}

echo "</div>";

?>

</body>
</html>