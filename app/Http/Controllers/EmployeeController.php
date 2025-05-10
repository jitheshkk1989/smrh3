<?php

    namespace App\Http\Controllers;

    use App\Models\Employee;
    use App\Models\User;
    use App\Models\UserGroup;
    use App\Models\Company; // Add Company model
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\DB;
    class EmployeeController extends Controller
    {
        public function create()
        {
            $userGroups = UserGroup::all();
            $companies = Company::all(); // Fetch all companies
            return view('employees.create', compact('userGroups', 'companies')); // Pass companies to the view
        }
        public function index()
        {
            $employees = Employee::all(); // Or use pagination, etc.
            return view('employees.index', compact('employees'));
        }
    public function store(Request $request)
    {
        // dd($request->all());
    $request->validate([
        'company_id' => 'required|exists:companies,id',
        'user_group_id' => 'required|exists:user_groups,id',
        'employee_code' => 'required|unique:employees',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'phone' => 'nullable|string|max:20',
        'position' => 'nullable|string|max:255',
        'address' => 'nullable|string',
        'city' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'pincode' => 'nullable|string|max:20',
        'hire_date' => 'nullable|date',
        'status' => 'required|in:active,inactive,terminated',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        DB::beginTransaction();
        $firstname=$request->first_name;
        $lastname=$request->last_name;
        $emailid=$request->email;
        $user = User::create([
            'name' => $firstname . ' ' . $lastname,
            'email' =>$emailid,
            'password' => Hash::make($request->password),
        ]);
        $employee = Employee::create([
            'company_id' => $request->company_id,
            'user_id' => $user->id,
            'user_group_id' => $request->user_group_id,
            'employee_code' => $request->employee_code,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'email' => $emailid,  // Corrected line
            'phone' => $request->phone,
            'position' => $request->position,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode,
            'hire_date' => $request->hire_date,
            'status' => $request->status,
        ]);

        DB::commit();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        dd($request->all());
        dd($e->getMessage());
        // return back()->with('error', 'Failed to create employee: ' . $e->getMessage());
    }
}
    

        // ... other methods ...
    }