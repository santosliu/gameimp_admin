<?php

namespace App\Admin\Controllers;

use App\Asuka_Card;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AsukaCardController extends Controller
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
            
            $content->header('武將');
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

            $content->header('武將');
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

            $content->header('武將');
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
        return Admin::grid(Asuka_Card::class, function (Grid $grid) {

            // $grid->id('ID')->sortable();
            $grid->cardNo('武將編號')->sortable();
            $grid->cardName('武將姓名');
            $grid->cardType('職業')->sortable();
            $grid->cardRarity('星數')->sortable();
            $grid->cardElement('屬性')->sortable();
            $grid->cardMainSkill('奧義');
            $grid->cardSkill('秘技');

            $grid->joinDate('加入日')->sortable();
            
            $grid->filter(function ($filter) {    
                $filter->disableIdFilter();            
                $filter->like('cardName','武將姓名');
                $filter->like('cardMainSkill','奧義');
                $filter->like('cardSkill','秘技');
                $filter->equal('cardNo','武將編號');

                $filter->equal('cardType','職業')->radio([
                    '斬' => '斬',
                    '打' => '打',
                    '突' => '突',
                    '投' => '投',
                    '射' => '射',
                    '彈' => '彈',
                ]);

                $filter->equal('cardRarity','星數')->radio([
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,                    
                ]);

                $filter->equal('cardElement','屬性')->radio([
                    '火' => '火',
                    '水' => '水',
                    '木' => '木',
                    '陽' => '陽',
                    '月' => '月',                    
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
        return Admin::form(Asuka_Card::class, function (Form $form) {

            $form->disableReset();

            $form->text('cardNo', '卡片編號');

            $form->text('cardName','武將姓名');

            $cardTypes = [
                '斬'  => '斬',
                '打'  => '打',
                '突'  => '突',
                '投'  => '投',
                '射'  => '射',
                '彈'  => '彈',                
            ];
        
            $form->select('cardType', '職業')->options($cardTypes);

            $cardRarities = [
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
            ];
        
            $form->select('cardRarity', '星等')->options($cardRarities);

            $cardElements = [
                '火' => '火',
                '水' => '水',
                '木' => '木',
                '陽' => '陽',
                '月' => '月',
            ];
        
            $form->select('cardElement', '屬性')->options($cardElements);

            $SkillTypes = [
                '傷害' => '傷害',
                '輔助' => '輔助',
                '護盾' => '護盾',
                '回復' => '回復',
                '控場' => '控場',
                '特殊' => '特殊',
            ];
        
            $form->select('cardMainSkillType', '奧義種類')->options($SkillTypes);

            $form->text('cardMainSkill','奧義');
            $form->text('cardSkill','秘技');
            $form->text('cardStory','背景');

            $form->date('joinDate', '加入日期');
            // $form->text('joinDate','加入日期');

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
