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

    public function index()
    {

        $menusService = new MenusService();
        $products = $menusService->all();

        return view('pizzzzza.menu.index', compact('products'));
    }

    public function destroy($id)
    {

        $menusService = new MenusService();
        $menusService->destroy($id);


        Flash::success('削除しました。');

        return redirect()->route('AdminMenu');

    }

    public function history()
    {
        $menusService = new MenusService();
        $products = $menusService->history();

        return view('pizzzzza.menu.history', compact('products'));
    }

    public function show($id)
    {
        $menusService = new MenusService();
        $product = $menusService->getProduct($id);

        return view('pizzzzza.menu.show', compact('product'));
    }

    public function edit($id)
    {

        $menusService = new MenusService();
        $product = $menusService->getProduct($id);

        return view('/pizzzzza.menu.edit', compact('product'));
    }

    public function update(AdminMenuEditForm $request, $id)
    {


        $menusService = new MenusService();
        $menusService->updateProduct($request, $id);


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

        $menusService = new MenusService();
        $menusService->addProduct($request);


        Flash::success('登録完了しました。');

        return redirect()->route('AdminMenu');

    }


}
