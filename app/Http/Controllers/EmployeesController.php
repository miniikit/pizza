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

        dd($data);

        User::create([
            'name' => '近沢邦彦',
            'kana' => 'チカザワクニヒコ',
            'email' => 'B5164@oic.jp',
            'password' => bcrypt('zawatika'),
            'postal' => 5550012,
            'address1' => '大阪府大阪市大正区北恩加島',
            'address2' => '2-8-2',
            'address3' => null,
            'phone' => '08037401939',
            'gender_id' => 1,
            'birthday' => 19960607,
            'authority_id' => 3,
        ]);

    }

    public function destroy($id) {

        $employee = Employee::with('user.gender')->find($id);
        $employee->delete();

    }

}
