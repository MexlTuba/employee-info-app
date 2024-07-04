<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        Log::info('Entered store method');
        Log::info('Request data: ' . json_encode($request->all()));
        Log::info('All uploaded files: ' . json_encode($request->allFiles()));

        if ($request->hasFile('photo')) {
            Log::info('Photo file detected: ' . $request->file('photo')->getClientOriginalName());
        } else {
            Log::info('No photo file detected');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Log::info('Validation passed');

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');

        if ($request->hasFile('photo')) {
            Log::info('Photo file exists');
            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'employee_photos/' . $fileName;

            if (Storage::disk('employee_photos')->put($fileName, file_get_contents($file))) {
                Log::info('File stored successfully');
                $employee->photo = $filePath;
            } else {
                Log::error('Failed to store the file');
            }
        } else {
            Log::error('No photo file in request');
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }




    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }
}
