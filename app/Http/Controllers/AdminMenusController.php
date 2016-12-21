<?php
/**
 *
 *  従業員用商品管理ページ
 *      ・商品一覧ページ
 *      ・商品編集ページ
 *      ・商品追加ページ
 *
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\AdminMenuAddForm;
use App\Http\Requests\AdminMenuEditForm;
use Laracasts\Flash\Flash;
use App\Service\MenusService;


class AdminMenusController extends Controller
{

    protected $menusService;

    /**
     * AdminMenusController constructor.
     */
    public function __construct(MenusService $menusService)
    {
        $this->menusService = $menusService;

    }

    public function index()
    {

        $products = $this->menusService->all();

        return view('pizzzzza.menu.index', compact('products'));
    }

    public function destroy($id)
    {

        $this->menusService->destroy($id);


        Flash::success('削除しました。');

        return redirect()->route('AdminMenu');

    }

    public function history()
    {

        $products = $this->menusService->history();

        return view('pizzzzza.menu.history', compact('products'));
    }

    public function show($id)
    {
        $product = $this->menusService->getProduct($id);

        return view('pizzzzza.menu.show', compact('product'));
    }

    public function edit($id)
    {

        $product = $this->menusService->getProduct($id);

        return view('/pizzzzza.menu.edit', compact('product'));
    }

    public function update(AdminMenuEditForm $request, $id)
    {


        $this->menusService->updateProduct($request, $id);


        Flash::success('更新完了しました。');

        return redirect()->route('AdminMenu');

    }


    public function add()
    {
        return view('pizzzzza.menu.add');
    }

    //
    public function store(AdminMenuAddForm $request)
    {

        $this->menusService->addProduct($request);


        Flash::success('登録完了しました。');

        return redirect()->route('AdminMenu');

    }


}
