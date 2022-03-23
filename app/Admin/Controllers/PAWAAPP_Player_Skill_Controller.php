<?php

namespace App\Admin\Controllers;

use App\PAWAAPP_Player_Skill;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PAWAAPP_Player_Skill_Controller extends Controller
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

            $content->header('實況野球手機版-技能');
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

            $content->header('實況野球手機版-技能');
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

            $content->header('實況野球手機版-技能');
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
        return Admin::grid(PAWAAPP_Player_Skill::class, function (Grid $grid) {
            $grid->skill_name('技能名稱');
            $grid->skill_type('技能等級');
            $grid->skill_position('技能種類');
            $grid->skill_score('單獨查定值');
            $grid->skill_description('技能說明');

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
    
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });

            $grid->filter(function ($filter) {    
                $filter->disableIdFilter();            
                $filter->like('skill_name','技能名稱');
    
                $filter->equal('skill_type','技能等級')->radio([
                    "金特"=>"金特",
                    "藍特"=>"藍特",
                    "綠特"=>"綠特",
                    "紅特"=>"紅特",
                    "其他"=>"其他",
                ]);
    
                $filter->equal('skill_position','技能種類')->radio([
                    "投手"=>"投手",
                    "野手"=>"野手",
                ]);
            });

        });

        
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(PAWAAPP_Player_Skill::class, function (Form $form) {

            $form->display('id', '編號');

            $form->text('skill_name','技能名稱');

            $form->radio('skill_type','技能等級')->options([
                "金特"=>"金特",
                "藍特"=>"藍特",
                "綠特"=>"綠特",
                "紅特"=>"紅特",
                "其他"=>"其他"
                ]);

            $form->radio('skill_position','技能種類')->options(["投手"=>"投手","野手"=>"野手"]);

            $form->number('skill_score','單獨查定');
            $form->number('skill_exp','技能總點數');
            
            $form->text('skill_description','技能說明');
            
            $form->html('查定資料請參考 <a href="http://hobby23.net/pawapuro/satei.html" target="_blank">mspwpr</a>','參考資料');

            $form->display('updated_at', '最後更新時間');
        });
    }
}
