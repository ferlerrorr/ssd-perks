<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function listFiles()
    {
        // Get the list of files in the 'GrabSftp' directory
        $files = Storage::allFiles('GrabSftp');

        // Return a view with the list of files
        return view('file-list', ['files' => $files]);
    }

    public function downloadCSVFiles()
    {
        // Specify the directory where your CSV files are located
        $directory = public_path('GrabSftp');

        // Get the list of CSV files in the directory
        $csvFiles = glob("$directory/*.csv");

        // Create an array to store the file names and URLs for download
        $fileList = [];

        foreach ($csvFiles as $csvFile) {
            $fileList[basename($csvFile)] = asset('GrabSftp/' . basename($csvFile));
        }

        // Return a view with the list of CSV files for download
        return view('csv-files', ['fileList' => $fileList]);
    }
}
