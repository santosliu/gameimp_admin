<?php

namespace App\Admin\Controllers;

use App\Asuka_Skill;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AsukaSkillController extends Controller
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
            $content->description('新增');

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
        return Admin::grid(Asuka_Skill::class, function (Grid $grid) {

            $grid->SkillName('技能名稱')->sortable();
            $grid->SkillDesc('技能描述')->sortable();
            $grid->SkillType('技能種類')->sortable();

            $grid->filter(function ($filter) {    
                $filter->disableIdFilter();            
                $filter->equal('SkillType','技能種類')->radio([
                    '奧義' => '奧義',
                    '秘技' => '秘技',
                ]);
                
                $filter->like('SkillName','技能名稱');
                $filter->like('SkillDesc','技能描述');
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
        return Admin::form(Asuka_Skill::class, function (Form $form) {

            $form->text('SkillName', '技能名稱');
            $form->text('SkillDesc', '技能描述');


            $SkillTypes = [
                '奧義' => '奧義',
                '秘技' => '秘技',                
            ];
        
            $form->select('SkillType', '技能種類')->options($SkillTypes);
            
            
        });
    }
}
