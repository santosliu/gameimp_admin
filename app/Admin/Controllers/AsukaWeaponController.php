<?php

namespace App\Admin\Controllers;

use App\Asuka_Weapon;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AsukaWeaponController extends Controller
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

            $content->header('武器');
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

            $content->header('武器');
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

            $content->header('武器');
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
        return Admin::grid(Asuka_Weapon::class, function (Grid $grid) {

            $grid->weaponId('武器編號')->sortable();
            $grid->weaponName('武器名稱')->sortable();
            $grid->weaponRarity('稀有度')->sortable();
            $grid->weaponType('職業')->sortable();
            $grid->weaponNote('出處');

            $grid->filter(function ($filter) {    
                $filter->disableIdFilter();            
                
                $filter->like('weaponId','武器編號');
                $filter->like('weaponName','武器名稱');

                $filter->equal('weaponRarity','稀有度')->radio([
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                ]);

                $filter->equal('weaponType','職業')->radio([
                    '斬' => '斬',
                    '打' => '打',
                    '突' => '突',
                    '投' => '投',
                    '射' => '射',
                    '彈' => '彈',
                ]);
                
                $filter->like('weaponNote','出處');
                
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
        return Admin::form(Asuka_Weapon::class, function (Form $form) {

            $form->text('weaponId', '編號');
            $form->text('weaponName', '武器名稱');

            $weaponTypes = [
                '斬'  => '斬',
                '打'  => '打',
                '突'  => '突',
                '投'  => '投',
                '射'  => '射',
                '彈'  => '彈',                
            ];
        
            $form->select('weaponType', '職業')->options($weaponTypes);

            $weaponRarities = [
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
                '7' => 7,
            ];
        
            $form->select('weaponRarity', '星等')->options($weaponRarities);

            $form->text('weaponAttack', '攻擊');
            $form->text('weaponDefense', '防禦');
            $form->text('weaponProficient', '特性');
            $form->text('weaponMaster', '專精');
            $form->text('weaponNote', '出處');
        });
    }
}
