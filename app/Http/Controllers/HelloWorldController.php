<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bunny\Storage\Client;
use Bunny\Storage\Region;

class HelloWorldController extends Controller
{

    // You Can Find Documentation Here: https://github.com/BunnyWay/BunnyCDN.PHP.Storage?tab=readme-ov-file#listing-objects.
    protected $client;

    public function __construct()
    {
        // Initialize the client in the constructor
        $this->client = new Client(
            'cd5cba9a-14a1-445f-9d0fd042e137-fd65-4055',
            'qusai',
            Region::LONDON
        );
    }

    public function uploadFile()
    {
        try {
            // Upload a file using $this->client
            $this->client->upload(public_path('robots.txt'), 'hello-world.txt');

            // Return the API response
            return response()->json(['message' => 'File uploaded successfully']);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteFile()
    {
        try {
            // Delete a file using $this->client
            $this->client->delete('hello-world.txt');

            // Return the API response
            return response()->json(['message' => 'File deleted successfully']);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function downloadFile()
    {
        try {
            // Download a file using $this->client
            $file = $this->client->download('hello-world.txt', public_path('downloads.txt'));

            // Return the API response
            return response()->json(['message' => 'File downloaded successfully']);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listFiles()
    {
        try {
            // List files using $this->client
            $baseUrl = 'https://qusai.b-cdn.net/';
            $files = $this->client->listFiles('');

            $items = [];

            foreach ($files as $f) {
                $item = [
                    'name' => $f->getName(),
                    'size' => $f->getSize() . ' bytes',
                    'url' => $baseUrl . $f->getName(),
                ];

                $items[] = $item;
            }

            // Return the API response
            return response()->json(['files' => $items]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getFileDetails()
    {
        try {
            $baseUrl = 'https://qusai.b-cdn.net/';

            // Get file details using $this->client
            $file = $this->client->info('hello-world.txt');

            $file = [
                'name' => $file->getName(),
                'size' => $file->getSize() . ' bytes',
                'url' => $baseUrl . $file->getName(),
            ];

            // Return the API response
            return response()->json(['file' => $file]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
