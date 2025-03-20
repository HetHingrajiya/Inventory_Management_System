<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        // Use paginate() instead of all() or get()
        $employees = Employee::paginate(10); // Adjust the number of items per page as needed
        return view('dashboard', compact('employees'));
    }
}
?>
