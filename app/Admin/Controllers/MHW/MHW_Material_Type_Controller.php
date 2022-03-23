<?php

namespace App\Admin\Controllers\MHW;

use App\Model\MHW\MHW_Material_Type;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class MHW_Material_Type_Controller extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('素材種類');
            $content->description('列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('素材種類');
            $content->description('編輯');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('素材種類');
            $content->description('創建');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(MHW_Material_Type::class, function (Grid $grid) {

            $grid->id('編號')->sortable();

            $grid->material_type('素材種類');

            $grid->created_at('創建時間');
            $grid->updated_at('最後更新時間');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(MHW_Material_Type::class, function (Form $form) {

            $form->display('id', '編號');

            $form->text('material_type', '素材種類');

            $form->display('created_at', '創建時間');
            $form->display('updated_at', '最後更新時間');
        });
    }
}
