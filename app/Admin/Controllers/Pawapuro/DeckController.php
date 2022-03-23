<?php

namespace App\Admin\Controllers\Pawapuro;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

use App\Models\Pawapuro\Decks;
use App\Models\Pawapuro\Schools;

class DeckController extends Controller
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

            $content->header('實況牌組');
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

            $content->header('實況牌組');
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

            $content->header('實況牌組');
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
        return Admin::grid(Decks::class, function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc');

            $grid->id('流水號');
            $grid->deck_title('牌組標題');
            $grid->deck_description('牌組描述');
            $grid->column('school.school_name');
            
            $grid->deck_type('牌組種類')->display(function ($deck_type) {
                return $deck_type ? '投手' : '野手';
            })->sortable();
            
            $grid->origin('出處');
            $grid->created_at('新增時間');
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
        return Admin::form(Decks::class, function (Form $form) {

            $form->display('id', '流水號');

            $form->text('deck_title', '牌組標題');
            $form->textarea('deck_description', '牌組描述');

            $form->select('school_id','學校')->options(Schools::orderBy('id','desc')->pluck('school_name', 'id'));
            $form->select('deck_type','牌組種類')->options([
                1 => '投手',
                0 => '野手',
            ]);

            $form->text('pic_1','圖片 1');
            $form->text('pic_2','圖片 2');
            $form->text('pic_3','圖片 3');
            $form->text('pic_4','圖片 4')->help('請上傳至 https://imgur.com 後複製圖片網址貼入此處');

            $form->text('origin', '出處')->help('填入推特或者 Youtube 來源');
            
        });
    }
}
