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
use App\Service\EmployeesService;


class EmployeesController extends Controller
{
    protected $employeesService;

    /**
     * EmployeesController constructor.
     * @param $employeesService
     */
    public function __construct(EmployeesService $employeesService)
    {
        $this->employeesService = $employeesService;
    }


    //  従業員一覧ページ
    public function index()
    {

        $employees = $this->employeesService->all();

        return view('pizzzzza.employee.index', compact('employees'));
    }

    public function history()
    {

        $employees = $this->employeesService->history();

        return view('pizzzzza.employee.history', compact('employees'));
    }


    //  従業員詳細
    public function show($id)
    {

        $employee = $this->employeesService->getEmployee($id);

        return view('pizzzzza.employee.show', compact('employee'));

    }


    //  従業員編集ページ
    public function edit($id)
    {

        $employee = $this->employeesService->getEmployee($id);

        return view('pizzzzza.employee.edit', compact('employee'));

    }

    //  従業員追加ページ
    public function add()
    {
        return view('pizzzzza.employee.add');
    }

    public function store(EmployeeRequest $request)
    {

        $data = $request->all();

        $this->employeesService->addEmployee($data);


        Flash::success('新規登録完了しました。');

        return redirect()->route('employees');

    }

    public function destroy($id)
    {

        $this->employeesService->removeEmployee($id);

        Flash::success('削除しました。');

        return redirect()->route('employees');

    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        $data = $request->all();

        $this->employeesService->updateEmployee($data,$id);


        Flash::success('更新完了しました。');

        return redirect()->route('employees');

    }

}
