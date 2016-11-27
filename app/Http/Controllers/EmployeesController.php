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

class EmployeesController extends Controller
{
    //  従業員一覧ページ
    public function index()  {

        $employees = Employee::with('user.gender')->get();

        return view('pizzzzza/employee.index',compact('employees'));
    }

    public function handler(Request $request,$id) {

        if ($request->has('delete')) {

            $this->destroy($id);

            return redirect()->route('employees');

        }else{

        }

    }


    //  従業員詳細
    public function show($id)  {

        $employee = Employee::with('user.gender')->find($id);

        return view('pizzzzza/employee.show',compact('employee'));
    }


    //  従業員編集ページ
    public function edit()  {
        return view('pizzzzza/employee.edit');
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
        $employee->delete();

    }

}
