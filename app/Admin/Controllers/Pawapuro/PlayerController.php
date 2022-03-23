<?php

namespace App\Admin\Controllers\Pawapuro;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

use App\Models\Pawapuro\Players;

class PlayerController extends Controller
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

            $content->header('實況角色');
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

            $content->header('實況角色');
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

            $content->header('實況角色');
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
        return Admin::grid(Players::class, function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc');

            $grid->id('流水號')->sortable();
            $grid->name('角色名稱');
            
            $grid->event_order('前後事件');
            
            $grid->column('event_order')->display(function ($order) {
                if ($order == null) return '請進行編輯';
                
                return $order;
            });

            $grid->created_at('新增時間');
            $grid->updated_at('最後更新時間');
            
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableRowSelector();            

            $grid->paginate(100);
            
            $grid->actions(function ($actions) {
                $actions->disableDelete();
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
        return Admin::form(Players::class, function (Form $form) {

            $form->display('id', '流水號');

            $form->display('name', '角色全名');
            $form->text('nick', '角色簡稱');
            $form->text('image_url', '頭像網址')->help('請從 https://imgur.com/gallery/tq83Hiy 中取得');

            $form->select('practice_1','得意練習 1')->options([
                '球速' => '球速',
                '控球' => '控球',
                '體力' => '體力',
                '變化' => '變化',
                '守備' => '守備',
                '精神' => '精神',
                '打框' => '打框',
                '打力' => '打力',
                '走力' => '走力',
                '肩力' => '肩力',
            ]);

            $form->select('practice_2','得意練習 1')->options([
                '球速' => '球速',
                '控球' => '控球',
                '體力' => '體力',
                '變化' => '變化',
                '守備' => '守備',
                '精神' => '精神',
                '打框' => '打框',
                '打力' => '打力',
                '走力' => '走力',
                '肩力' => '肩力',
            ]);

            $form->select('event_order','前後事件')->options([
                '前' => '前',
                '後' => '後',
            ]);
            
            $form->select('role','役割')->options([
                '紫' => '紫',
                '綠' => '綠',
                '藍' => '藍',
                '紅' => '紅',
            ]);

            $form->text('special_pitcher_1','投手金特 1');
            $form->text('special_pitcher_2','投手金特 2');
            $form->text('special_fielder_1','野手金特 1');
            $form->text('special_fielder_2','野手金特 2');

            $form->text('gamewith_url','角色 GameWith 網址')->help('請從 https://xn--odkm0eg.gamewith.jp/article/show/10913 查閱後填入');

            $form->switch('limit_speed', '球速突破');
            $form->switch('limit_control', '控球突破');
            $form->switch('limit_stamina', '體力突破');
            $form->switch('limit_hit', '打框突破');
            $form->switch('limit_power', '打力突破');
            $form->switch('limit_run', '走力突破');
            $form->switch('limit_toss', '肩力突破');
            $form->switch('limit_defense', '守備突破');

            $form->select('class','身分')->options([
                '投手' => '投手',
                '野手' => '野手',
                '二刀' => '二刀',
                '女友' => '女友',
                '相棒' => '相棒',
            ]);
        });
    }
}
