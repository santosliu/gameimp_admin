<?php

namespace App\Admin\Controllers\MHW;

use App\Model\MHW\MHW_Equipment;
use App\Model\MHW\MHW_Skill;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class MHW_EQuipment_Controller extends Controller
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

            $content->header('裝備');
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

            $content->header('裝備');
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

            $content->header('裝備');
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
        return Admin::grid(MHW_Equipment::class, function (Grid $grid) {

            $grid->id('編號')->sortable();

            $grid->equipment_name('裝備名稱');
            $grid->equipment_skill('裝備技能');
            $grid->equipment_skill_level('技能等級');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(MHW_Equipment::class, function (Form $form) {

            $form->display('id', '編號');

            $form->text('equipment_name','裝備名稱');

            // $form->select('equipment_skill_type','技能種類')->options([
            //     "攻擊．防禦．回避" => "攻擊．防禦．回避",
            //     "體力．耐力．回復" => "體力．耐力．回復",
            //     "耐性．無效化" => "耐性．無效化",
            //     "槍手用" => "槍手用",
            //     "報酬．採取．調合" => "報酬．採取．調合",
            //     "艾露猫．其他" => "艾露猫．其他",
            //     "系列技能" => "系列技能",                
            // ]);

            $form->select('equipment_skill','技能名稱')->options(MHW_Skill::pluck('skill_name','skill_name')->toArray());

            $form->number('equipment_skill_level','技能等級');

            $form->html('<a href="https://www.mhchinese.wiki/equipments" target="_blank">裝備資料參考</a>','參考資料');
            

            $form->display('updated_at', '最後更新時間');
        });
    }
}
