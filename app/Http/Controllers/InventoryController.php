<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function showInventory()
    {
        return view('Inventory.InInventory'); // Refers to resources/views/home.blade.php
    }

    public function showOutInventory()
    {
        return view('Inventory.OutInventory'); // Refers to resources/views/home.blade.php
    }

    public function showDeployment()
    {
        return view('Inventory.Deployment'); // Refers to resources/views/home.blade.php
    }

    public function showAllInventory()
    {
        return view('Inventory.AllInventory'); // Refers to resources/views/home.blade.php
    }
}
