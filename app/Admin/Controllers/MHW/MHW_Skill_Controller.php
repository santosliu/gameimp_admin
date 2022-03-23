<?php

namespace App\Admin\Controllers\MHW;

use App\Model\MHW\MHW_Skill;
use App\Model\MHW\MHW_Skill_Series;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class MHW_Skill_Controller extends Controller
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

            $content->header('技能');
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

            $content->header('技能');
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

            $content->header('技能');
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
        return Admin::grid(MHW_Skill::class, function (Grid $grid) {

            $grid->id('編號')->sortable();

            $grid->skill_name('技能名稱');
            $grid->skill_type('技能種類');
            $grid->skill_level('技能等級');
            $grid->skill_description('技能說明');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(MHW_Skill::class, function (Form $form) {

            $form->display('id', '編號');

            
            $form->select('skill_type','技能種類')->options([
                "攻擊．防禦．回避" => "攻擊．防禦．回避",
                "體力．耐力．回復" => "體力．耐力．回復",
                "耐性．無效化" => "耐性．無效化",
                "槍手用" => "槍手用",
                "報酬．採取．調合" => "報酬．採取．調合",
                "艾露猫．其他" => "艾露猫．其他",
                "系列技能" => "系列技能",                
            ]);

            $form->select('skill_series','技能系統')->options(MHW_Skill_Series::pluck('skill_series_name','skill_series_name')->toArray());

            $form->text('skill_name','技能名稱');

            $form->html('技能資料請參考 <a href="https://www.mhchinese.wiki/skills/5a787636254778297bc70c63" target="_blank">這裡</a>','參考資料');

            $form->number('skill_level','技能等級');
            $form->text('skill_description','技能說明');

            $form->display('updated_at', '最後更新時間');
        });
    }
}
