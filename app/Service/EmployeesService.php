<?php

namespace App\Service;

use App\Employee;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployeesService
{
    public function all()
    {

        $employees = Employee::with('user.gender')->get();

        return $employees;
    }

    public function history()
    {
        $employees = Employee::withTrashed()->with('user.gender')->get();

        return $employees;
    }

    public function getEmployee($id)
    {

        $employee = Employee::withTrashed()->with('user.gender')->find($id);

        return $employee;

    }

    public function addEmployee($data)
    {
        if (empty($data['address3'])) {
            $data['address3'] = NULL;
        }

        $user = User::create([
            'name' => $data['name'],
            'kana' => $data['kana'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'postal' => $data['postal'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'address3' => $data['address3'],
            'phone' => $data['phone'],
            'gender_id' => $data['gender_id'],
            'birthday' => $data['birthday'],
            'authority_id' => 2,
        ]);


        Employee::create([
            'users_id' => $user->id,
            'emoloyee_agreement_date' => Carbon::today(),
            'emoloyee_agreement_enddate' => null,
        ]);
    }

    public function removeEmployee($id) {

        $employee = $this->getEmployee($id);

        $employee->emoloyee_agreement_enddate = Carbon::today();
        $employee->save();

        $employee->delete();

    }

    public function updateEmployee($data,$id) {

        $employee = $this->getEmployee($id);

        $employee->user->name = $data['name'];
        $employee->user->kana = $data['kana'];
        $employee->user->birthday = $data['birthday'];
        $employee->user->gender_id = $data['gender_id'];
        $employee->user->postal = $data['postal'];
        $employee->user->address1 = $data['address1'];
        $employee->user->address2 = $data['address2'];
        $employee->user->address3 = $data['address3'];
        $employee->user->phone = $data['phone'];
        $employee->user->email = $data['email'];

        if (empty($data['emoloyee_agreement_enddate'])) {
            $employee->emoloyee_agreement_enddate = NULL;
        } else {
            $employee->emoloyee_agreement_enddate = $data['emoloyee_agreement_enddate'];
        }


        $employee->user->save();
        $employee->save();

    }

}