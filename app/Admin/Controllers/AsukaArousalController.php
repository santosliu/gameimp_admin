<?php

namespace App\Admin\Controllers;

use App\Asuka_Arousal;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AsukaArousalController extends Controller
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

            $content->header('覺醒');
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

            $content->header('覺醒');
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

            $content->header('覺醒');
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
        return Admin::grid(Asuka_Arousal::class, function (Grid $grid) {

            $grid->cardId('覺醒武將編號')->sortable();

            $grid->arousalLv('覺醒等級');
            $grid->arousalDesc('覺醒效果');

            $grid->filter(function ($filter) {    
                $filter->disableIdFilter();            
                $filter->like('cardId','武將編號');
                                
                $filter->equal('arousalLv','覺醒等級')->radio([
                    '3' => 3,
                    '5' => 5,
                    '6' => 6,
                    '9' => 9,
                    '15' => 15,
                    '25' => 25,
                    '45' => 45,
                ]);

                $filter->like('arousalDesc','覺醒效果');
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
        return Admin::form(Asuka_Arousal::class, function (Form $form) {

            $form->text('cardId','覺醒武將編號');
            $form->text('arousalLv','覺醒等級');
            $form->text('arousalDesc','覺醒效果');


            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
