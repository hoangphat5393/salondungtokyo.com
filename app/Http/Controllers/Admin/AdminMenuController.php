<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\AdminMenu;
use Validator;

class AdminMenuController extends Controller
{
    public $data;

    public $view;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['title_head'] = 'Menu admin';
        $this->view = 'admin';
        $this->data['layout'] = 'list';
    }

    public function index()
    {
        $this->data['treeMenu'] = (new AdminMenu)->getTree();
        $this->data['url_action'] = route('admin.admin-menu.store');
        $this->data['urlDeleteItem'] = route('admin.admin-menu.destroy');

        return view('backend.admin-menu', $this->data);
    }

    /**
     * Post create new item in admin
     *
     * @return [type] [description]
     */
    public function postCreate()
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInsert = [
            'title' => $data['title'],
            'parent_id' => $data['parent_id'],
            'uri' => $data['uri'],
            'icon' => $data['icon'],
            'sort' => $data['sort'] ?? 0,
        ];

        AdminMenu::createMenu($dataInsert);

        return redirect()->route('admin.admin-menu.index')->with('success', 'Thêm menu thành công!');
    }

    public function edit($id)
    {
        $this->data['menu'] = AdminMenu::find($id);
        $this->data['treeMenu'] = (new AdminMenu)->getTree();

        if ($this->data['menu'] === null) {
            return redirect()->route('admin.admin-menu.index')->with('error', 'Không tìm thấy menu!');
        }

        $this->data['urlDeleteItem'] = route('admin.admin-menu.destroy');
        $this->data['id'] = $id;
        $this->data['layout'] = 'edit';
        $this->data['url_action'] = route('admin.admin-menu.update', $id);

        return view('backend.admin-menu')->with($this->data);
    }

    /**
     * update status
     */
    public function postEdit($id)
    {
        $menu = AdminMenu::find($id);
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Edit
        $dataUpdate = [
            'title' => $data['title'],
            'parent_id' => $data['parent_id'],
            'uri' => $data['uri'],
            'icon' => $data['icon'],
            'sort' => $data['sort'] ?? 0,
            'hidden' => $data['hidden'] ?? 0,
        ];

        AdminMenu::updateInfo($dataUpdate, $id);

        return redirect()->back()->with('success', __('admin.menu.edit_success'));
    }

    /*
    Delete list Item
    Need mothod destroy to boot deleting in model
     */
    public function deleteList()
    {
        if (! request()->ajax() && ! request()->wantsJson()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allowed']);
        } else {
            $id = request('id');
            $check = AdminMenu::where('parent_id', $id)->count();
            if ($check) {
                return response()->json(['error' => 1, 'msg' => 'Menu này có menu con, không thể xóa!']);
            } else {
                AdminMenu::destroy($id);
            }

            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

    /*
    Update menu resort
     */
    public function updateSort()
    {
        $data = request('menu') ?? [];
        $reSort = json_decode($data, true);
        $newTree = [];
        foreach ($reSort as $key => $level_1) {
            $newTree[$level_1['id']] = [
                'parent_id' => 0,
                'sort' => ++$key,
            ];
            if (! empty($level_1['children'])) {
                $list_level_2 = $level_1['children'];
                foreach ($list_level_2 as $key => $level_2) {
                    $newTree[$level_2['id']] = [
                        'parent_id' => $level_1['id'],
                        'sort' => ++$key,
                    ];
                    if (! empty($level_2['children'])) {
                        $list_level_3 = $level_2['children'];
                        foreach ($list_level_3 as $key => $level_3) {
                            $newTree[$level_3['id']] = [
                                'parent_id' => $level_2['id'],
                                'sort' => ++$key,
                            ];
                        }
                    }
                }
            }
        }
        $response = (new AdminMenu)->reSort($newTree);

        return $response;
    }
}
