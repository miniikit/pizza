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
use App\Http\Requests;

class EmployeesController extends Controller
{
    //  従業員一覧ページ
    public function index()  {

        $employees = Employee::with('user.gender')->get();

        return view('pizzzzza/employee.index',compact('employees'));
    }

    //  従業員詳細
    public function show()  {
        $employee = Employee::with('user.gender')->find(1);
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
}
