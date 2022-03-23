<?php

namespace App\Admin\Controllers\MHW;

use App\Model\MHW\MHW_Skill_Series;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class MHW_Skill_Series_Controller extends Controller
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

            $content->header('技能系列');
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

            $content->header('技能系列');
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

            $content->header('技能系列');
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
        return Admin::grid(MHW_Skill_Series::class, function (Grid $grid) {

            $grid->id('編號')->sortable();

            $grid->skill_series_name('技能系列名稱');
            

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(MHW_Skill_Series::class, function (Form $form) {

            $form->display('id', '編號');

            $form->text('skill_series_name','技能系列名稱');

            

            $form->display('updated_at', '最後更新時間');
        });
    }
}
