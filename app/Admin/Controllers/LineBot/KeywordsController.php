<?php

namespace App\Admin\Controllers\LineBot;

use App\Models\LineBot\Keywords;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class KeywordsController extends Controller
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
        return Admin::grid(Keywords::class, function (Grid $grid) {
            $grid->model()->where('game', '=', 'royal');

            $grid->id('編號')->sortable();
            
            $grid->type('抓取方式');
            $grid->keyword('關鍵字');
            $grid->reply_type('回應方式');
            $grid->reply_content('回應內容')->style('width:30%');

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
        return Admin::form(Keywords::class, function (Form $form) {

            $form->display('id', '編號');

            // $grid->type('抓取方式');
            // $grid->keyword('關鍵字');
            // $grid->reply_type('回應方式');
            // $grid->reply_content('回應內容');
            $form->select('game','遊戲')->options([
                'royal' => '皇室戰爭',                
            ]);

            $form->select('type','抓取方式')->options([
                'part' => '部分吻合',
                'full' => '全部吻合',
                'member_join' => '加入群時',
            ]);

            $form->text('keyword','關鍵字');

            $form->select('reply_type','回應方式')->options([
                'text' => '純文字',
                'pic' => '圖片連結',
                'album' => '圖庫代碼',
            ]);

            $form->textarea('reply_content','回應內容')->rows(10);

            $form->display('updated_at', '最後更新時間');
        });
    }
}
