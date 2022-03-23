<?php

namespace App\Admin\Controllers\MHW;

use App\Model\MHW\MHW_Material;
use App\Model\MHW\MHW_Material_Type;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class MHW_Material_Controller extends Controller
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

            $content->header('素材');
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

            $content->header('素材');
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

            $content->header('素材');
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
        return Admin::grid(MHW_Material::class, function (Grid $grid) {

            $grid->id('編號')->sortable();

            $grid->material_name('素材名稱');
            $grid->material_type('素材種類');
            $grid->material_rarity('稀有度');
            $grid->material_hold('最大持有量');
            $grid->material_sell_price('售價');

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
        return Admin::form(MHW_Material::class, function (Form $form) {

            $form->display('id', '編號');

            $form->text('material_name','素材名稱');
            $form->select('material_type','素材種類')->options(MHW_Material_Type::pluck('material_type','material_type')->toArray());
            $form->number('material_rarity','稀有度');
            $form->number('material_hold','最大持有量');
            $form->number('material_sell_price','售價');

            // $form->hasMany('paintings', function (Form\NestedForm $form) {
            //     $form->text('title');
            //     $form->image('body');
            //     $form->datetime('completed_at');
            // });

            $form->display('created_at', '創建時間');
            $form->display('updated_at', '最後更新時間');
        });
    }
}
