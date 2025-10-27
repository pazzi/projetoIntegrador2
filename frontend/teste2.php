<?php
$ch = curl_init(); // Initialize cURL session

// Set the URL of the API endpoint
curl_setopt($ch, CURLOPT_URL, "http://localhost:3001/usuarios");

// Set the request method (e.g., GET, POST, PUT, DELETE)
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

// Set options to return the transfer as a string instead of outputting it directly
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set any necessary headers
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer YOUR_API_KEY'
));

// If sending data (e.g., for POST or PUT requests)
// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['key' => 'value']));

$response = curl_exec($ch); // Execute the cURL request

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch); // Handle errors
} else {
    $data = json_decode($response); // Decode JSON response
    print_r($data); // Process the API response
}

echo $data[0]->username; // Example of accessing a property from the response

foreach ($data as $usuario) {
    echo "ID: " . $usuario->id . "\n";
    echo "Username: " . $usuario->username . "\n";
    echo "Nome completo: " . $usuario->nome_completo . "\n";
    echo "Email: " . $usuario->email . "\n";
    echo "---\n";
}


curl_close($ch); // Close cURL session
