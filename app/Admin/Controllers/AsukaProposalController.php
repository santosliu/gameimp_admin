<?php

namespace App\Admin\Controllers;

use App\Asuka_Proposal;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AsukaProposalController extends Controller
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

            $content->header('提案');
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

            $content->header('提案');
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

            $content->header('提案');
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
        return Admin::grid(Asuka_Proposal::class, function (Grid $grid) {

            $grid->cardName('提案武將')->sortable();
            $grid->proposalName('提案名稱');
            $grid->proposalType('提案種類');
            $grid->proposalDesc('提案效果');

            $grid->filter(function ($filter) {    
                $filter->disableIdFilter();            
                $filter->like('cardName','提案武將');
                $filter->like('proposalName','提案名稱');
                                
                $filter->equal('proposalType','提案種類')->radio([
                    '建物' => '建案',
                    '武器' => '武器',
                ]);

                $filter->like('proposalDesc','提案效果');
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
        return Admin::form(Asuka_Proposal::class, function (Form $form) {

            $form->text('cardID', '提案武將編號');
            $form->text('cardName', '提案武將名稱');
            $form->text('proposalName', '提案名稱');

            $ProposalTypes = [                
                '建物' => '建物',                
                '武器' => '武器',
            ];
        
            $form->select('proposalType', '提案種類')->options($ProposalTypes);

            $form->text('proposalDesc', '提案效果');
        });
    }
}
