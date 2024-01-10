<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use stdClass;
use Illuminate\Support\Str;

class EmployeesController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data employee successfully',
            'data' => Employees::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|numeric|unique:employees',
            'ktp_number' => 'required|numeric|unique:employees',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:employees',
            'province_address' => 'required|integer',
            'city_address' => 'required|integer',
            'street_address' => 'required|string',
            'zip_code' => 'required|numeric',
            'current_position' => 'required|integer',
            'bank_account' => 'required|integer',
            'bank_account_number' => 'required|numeric',
            'ktp_file' => 'required|image'
        ]);

        $message = 'Employee created successfully';
        $status = "success";
        $employee = new stdClass();

        try {
            $ktp_filename = '';
            if ($request->hasFile('ktp_file')) {
                $ktp_file = $request->file('ktp_file');
                $ktp_filename = Str::random(32) . '.' . $ktp_file->getClientOriginalExtension();
                $ktp_file->move(base_path('public/ktp_file/'), $ktp_filename);
            }

            $employee = Employees::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'ktp_number' => $request->ktp_number,
                'date_of_birth' => $request->date_of_birth,
                'email' => $request->email,
                'province_address' => $request->province_address,
                'city_address' => $request->city_address,
                'street_address' => $request->street_address,
                'zip_code' => $request->zip_code,
                'current_position' => $request->current_position,
                'bank_account' => $request->bank_account,
                'bank_account_number' => $request->bank_account_number,
                'ktp_file' => $ktp_filename,
            ]);

            if (isset($employee['id'])) {
                $employee['ktp_file_url'] = URL::asset('ktp_file/' . $ktp_filename);
            }
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response([
            'status' => $status,
            'message' => $message,
            'data' => $employee
        ], 200);
    }

    public function show($id)
    {
        $message = "Load data employee successfully";
        $status = "success";
        $employee = Employees::find($id);

        if (!$employee) {
            $status = "error";
            $message = "Data employee not found";
        } else {
            $employee['ktp_file_url'] = URL::asset('ktp_file/' . $employee['ktp_file']);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $employee
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $employee = Employees::find($id);
        if (!$employee) {
            $status = "error";
            $message = "Data employee not found";
        } else {
            $this->validate($request, [
                'first_name' => 'required|string',
                'last_name' => 'string',
                'phone_number' => 'numeric|unique:employees,phone_number,' . $id,
                'ktp_number' => 'numeric|unique:employees,ktp_number,' . $id,
                'date_of_birth' => 'date',
                'email' => 'email|unique:employees,email,' . $id,
                'province_address' => 'integer',
                'city_address' => 'integer',
                'street_address' => 'string',
                'zip_code' => 'numeric',
                'current_position' => 'integer',
                'bank_account' => 'integer',
                'bank_account_number' => 'numeric',
                'ktp_file' => 'image'
            ]);

            $message = 'Employee updated successfully';
            $status = "success";
            try {
                $ktp_filename = '';
                if ($request->hasFile('ktp_file')) {
                    $ktp_file = $request->file('ktp_file');
                    $ktp_filename = Str::random(32) . '.' . $ktp_file->getClientOriginalExtension();
                    $ktp_file->move(base_path('public/ktp_file/'), $ktp_filename);

                    if ($employee['ktp_file'] && file_exists(base_path('public/ktp_file/' . $employee['ktp_file'])))
                        unlink(base_path('public/ktp_file/' . $employee['ktp_file']));
                }

                $update = Employees::find($id)->update([
                    'first_name' => $request->first_name ?: $employee->first_name,
                    'last_name' => $request->last_name ?: $employee->last_name,
                    'phone_number' => $request->phone_number ?: $employee->phone_number,
                    'ktp_number' => $request->ktp_number ?: $employee->ktp_number,
                    'date_of_birth' => $request->date_of_birth ?: $employee->date_of_birth,
                    'email' => $request->email ?: $employee->email,
                    'province_address' => $request->province_address ?: $employee->province_address,
                    'city_address' => $request->city_address ?: $employee->city_address,
                    'street_address' => $request->street_address ?: $employee->street_address,
                    'zip_code' => $request->zip_code ?: $employee->zip_code,
                    'current_position' => $request->current_position ?: $employee->current_position,
                    'bank_account' => $request->bank_account ?: $employee->bank_account,
                    'bank_account_number' => $request->bank_account_number ?: $employee->bank_account_number,
                    'ktp_file' => $ktp_filename ? $ktp_filename : $employee->ktp_file,
                ]);
                if ($update === true) {
                    $employee = Employees::find($id);
                }

                $employee['ktp_file_url'] = URL::asset('ktp_file/' . $employee['ktp_file']);
            } catch (\Throwable $th) {
                $status = "error";
                $message = $th->getMessage();
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $employee
        ], 200);
    }

    public function destroy($id)
    {
        $message = 'Employee deleted successfully';
        $status = "success";

        $employee = Employees::find($id);
        if ($employee) {
            try {
                if ($employee['ktp_file'] && file_exists(base_path('public/ktp_file/' . $employee['ktp_file'])))
                    unlink(base_path('public/ktp_file/' . $employee['ktp_file']));
                $employee->delete();
            } catch (\Throwable $th) {
                $status = "error";
                $message = $th->getMessage();
            }
        } else {
            $status = "error";
            $message = "Data employee not found";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }
}
