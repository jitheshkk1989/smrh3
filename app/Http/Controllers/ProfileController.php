<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\ProfessionalDetail;
use App\Models\ContactDetail;
use App\Models\FinanceDetail;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $employee = $user->load('employee.professionalDetail', 'employee.contactDetail', 'employee.financeDetail')->employee;

        if (!$employee) {
            return redirect()->route('home')->with('error', 'No employee profile found.');
        }

        return view('profile.my-profile', compact('employee'));
    }

    // Edit Methods (Existing)
    public function editProfessional()
    {
        $user = Auth::user();
        $employee = $user->load('employee.professionalDetail')->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        return view('profile.edit-professional', compact('employee'));
    }

    public function editContact()
    {
        $user = Auth::user();
        $employee = $user->load('employee.contactDetail')->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        return view('profile.edit-contact', compact('employee'));
    }

    public function editFinance()
    {
        $user = Auth::user();
        $employee = $user->employee;
    
        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }
    
        $financeDetail = FinanceDetail::find($user->id);
    
        if (!$financeDetail) {
            return redirect()->route('my-profile')->with('error', 'Finance detail not found.');
        }
    
        // **Crucial Authorization Check:**
        if ($financeDetail->employee_id !== $employee->id) {
            return redirect()->route('my-profile')->with('error', 'You are not authorized to edit this finance detail.');
        }
    
        return view('profile.edit-finance', compact('employee', 'financeDetail'));
    }

    // Create Methods (New)
    public function createProfessional()
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        return view('profile.create-professional', compact('employee'));
    }

    public function createContact()
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        return view('profile.create-contact', compact('employee'));
    }

    public function createFinance()
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        return view('profile.create-finance', compact('employee'));
    }

    // Update Methods (Existing)
    public function updateProfessionalDetails(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        $validatedData = $request->validate([
            'department' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'experience' => 'nullable|string|max:255',
        ]);

        $employee->professionalDetail()->updateOrCreate(
            [],
            $validatedData
        );

        return redirect()->route('my-profile')->with('success', 'Professional details updated.');
    }

    public function updateContactDetails(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        $validatedData = $request->validate([
            'permanent_address' => 'nullable|string',
            'current_address' => 'nullable|string',
            'phone_emergency' => 'nullable|string',
        ]);

        $employee->contactDetail()->updateOrCreate(
            [],
            $validatedData
        );

        return redirect()->route('my-profile')->with('success', 'Contact details updated.');
    }

    public function updateFinanceDetails(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        $validatedData = $request->validate([
            'salary' => 'nullable|numeric',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'pan_number' => 'nullable|string|max:255',
        ]);

        $employee->financeDetail()->updateOrCreate(
            [],
            $validatedData
        );

        return redirect()->route('my-profile')->with('success', 'Finance details updated.');
    }

    public function storeProfessionalDetails(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        $validatedData = $request->validate([
            'department' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'experience' => 'nullable|string|max:255',
        ]);

        $employee->professionalDetail()->create($validatedData);

        return redirect()->route('my-profile')->with('success', 'Professional details created.');
    }

    public function storeContactDetails(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        $validatedData = $request->validate([
            'permanent_address' => 'nullable|string',
            'current_address' => 'nullable|string',
            'phone_emergency' => 'nullable|string',
        ]);

        $employee->contactDetail()->create($validatedData);

        return redirect()->route('my-profile')->with('success', 'Contact details created.');
    }

    public function storeFinanceDetails(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return redirect()->route('my-profile')->with('error', 'No employee profile found.');
        }

        $validatedData = $request->validate([
            'salary' => 'nullable|numeric',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'pan_number' => 'nullable|string|max:255',
        ]);

        $employee->financeDetail()->create($validatedData);

        return redirect()->route('my-profile')->with('success', 'Finance details created.');
    }
}