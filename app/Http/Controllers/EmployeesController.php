<?php
/**
 *
 *  従業員用ページ
 *      ・従業員一覧ページ
 *      ・従業員編集ページ
 *      ・従業員追加ページ
 *
 */
namespace App\Http\Controllers;

use DebugBar\DebugBar;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Employee;
use App\User;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;


class EmployeesController extends Controller
{
    //  従業員一覧ページ
    public function index()  {

        $employees = Employee::with('user.gender')->get();

        return view('pizzzzza/employee.index',compact('employees'));
    }

    public function history()  {

        $employees = Employee::withTrashed()->with('user.gender')->get();

        return view('pizzzzza/employee.history',compact('employees'));
    }


    //  従業員詳細
    public function show($id)  {

        $employee = Employee::withTrashed()->with('user.gender')->find($id);
        return view('pizzzzza/employee.show',compact('employee'));

    }


    //  従業員編集ページ
    public function edit($id)  {

        $employee = Employee::withTrashed()->with('user.gender')->find($id);
        return view('pizzzzza/employee.edit',compact('employee'));

    }

    //  従業員追加ページ
    public function add()  {
        return view('pizzzzza/employee.add');
    }

    public function store(EmployeeRequest $request)  {

        $data = $request->all();

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


        Flash::success('新規登録完了しました。');

        return redirect()->route('employees');

    }

    public function destroy($id) {

        $employee = Employee::with('user.gender')->find($id);

        $employee->emoloyee_agreement_enddate = Carbon::today();
        $employee->save();

        $employee->delete();

        Flash::success('削除しました。');

        return redirect()->route('AdminMenu');

    }

    public function update(EmployeeUpdateRequest $request,$id) {

        $employee = Employee::withTrashed()->with('user.gender')->find($id);

        $data = $request->all();

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


        if (empty($data['emoloyee_agreement_enddate'])){
            $employee->emoloyee_agreement_enddate = NULL;
        }else{
            $employee->emoloyee_agreement_enddate = $data['emoloyee_agreement_enddate'];

        }

        $employee->user->save();
        $employee->save();

        Flash::success('更新完了しました。');

        return redirect()->route('employees');

    }

}
