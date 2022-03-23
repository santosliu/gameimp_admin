<?php

namespace App\Admin\Controllers;

use App\PAWAAPP_Player;
use App\PAWAAPP_Player_Skill;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PAWAAPP_Player_Controller extends Controller
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

            $content->header('人物');
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

            $content->header('人物');
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

            $content->header('人物');
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
        return Admin::grid(PAWAAPP_Player::class, function (Grid $grid) {

            $grid->id('編號')->sortable();
            $grid->player_name('人物名稱');
            $grid->player_event_position('前後事件');
            $grid->player_position_1('主守備位置');
            $grid->player_practice_1('主得意練習');
            $grid->updated_at('最後更新時間');

            $grid->actions(function ($actions) {
                $actions->disableDelete();            
            });

            // $grid->filter(function ($filter) {
                        
            // });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(PAWAAPP_Player::class, function (Form $form) {

            $form->display('id', '編號');

            $form->text('player_name','人物名稱');
            
            $habits = [
                "右投右打" => "右投右打",
                "右投左打" => "右投左打",
                "右投兩打" => "右投兩打",
                "左投右打" => "左投右打",
                "左投左打" => "左投左打",
                "左投兩打" => "左投兩打",
            ];
            
            $form->select('player_habit','投打習慣')->options($habits);
            
            $form->radio('player_event_position','前後事件')->options(['前'=>'前','後'=>'後']);

            $positions = [
                ""=>"",
                "女友"=>"女友",
                "相棒"=>"相棒",
                "投手"=>"投手",
                "捕手"=>"捕手",
                "一壘手"=>"一壘手",
                "二壘手"=>"二壘手",
                "三壘手"=>"三壘手",
                "游擊手"=>"游擊手",
                "外野手"=>"外野手",
            ];

            $form->select('player_position_1','主守位')->options($positions);
            $form->select('player_position_2','副守位')->options($positions);

            $practices = [
                ""=>"",
                "打擊"=>"打擊",
                "筋力"=>"筋力",
                "走壘"=>"走壘",
                "肩力"=>"肩力",
                "守備"=>"守備",
                "メンタル"=>"メンタル",
                "球速"=>"球速",
                "コントロール"=>"コントロール",
                "スタミナ"=>"スタミナ",
                "變化球"=>"變化球",
            ];

            $form->select('player_practice_1','主得意練習')->options($practices);
            $form->select('player_practice_2','副得意練習')->options($practices);
            
            $form->select('player_gold_skill_1','野手金特 1')->options(PAWAAPP_Player_Skill::where([
                ['skill_position','=','野手'],
                ['skill_type','=','金特'],
            ])->pluck('skill_name','skill_name')->toArray());

            $form->select('player_gold_skill_3','野手金特 2')->options(PAWAAPP_Player_Skill::where([
                ['skill_position','=','野手'],
                ['skill_type','=','金特'],
            ])->pluck('skill_name','skill_name')->toArray());

            $form->select('player_gold_skill_2','投手金特 1')->options(PAWAAPP_Player_Skill::where([
                ['skill_position','=','投手'],
                ['skill_type','=','金特'],
            ])->pluck('skill_name','skill_name')->toArray());

            $form->select('player_gold_skill_4','投手金特 2')->options(PAWAAPP_Player_Skill::where([
                ['skill_position','=','投手'],
                ['skill_type','=','金特'],
            ])->pluck('skill_name','skill_name')->toArray());

            $form->text('player_thumb_url','小圖連結');

            $form->display('created_at', '創建時間');
            $form->display('updated_at', '最後更新時間');

        });
    }
}
