<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/8
 * Time: 10:47
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SinglePage;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    /**
     * 单页列表
     * @return \Illuminate\View\View
     */
    public function lists()
    {
        $data['singlePage'] = SinglePage::lists();
        return view('admin.singlePage.list', $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            // todo 数据验证
            SinglePage::add($request->input());
            // todo 判断是否添加成功
            return $this->response->responseJSON();
        }

        // 分类信息，用于选择分类，因为在添加页面有一个选择分类。
        // 第一个参数0，代表是从第一次开始查，第二个参数2，代表是查询单页
        $category = Category::getCategoryChildrenIdsByParentId(0, 2);

        $data['category'] = $category;

        return view('admin.singlePage.add', $data);
    }

    public function edit(int $id, Request $request)
    {
        $singlePage = SinglePage::where('id', $id)->first();
        // todo 验证文章是否存在，如果不存在跳转到错误提示页面

        if ($request->isMethod('post')) {
            // todo 数据验证
            SinglePage::edit($singlePage, $request->input());
            // todo 判断是否修改成功
            return $this->response->responseJSON();
        }

        // 分类信息，用于选择分类，因为在添加页面有一个选择分类。
        $category = Category::getCategoryChildrenIdsByParentId(0);

        $data['category'] = $category;
        $data['singlePage'] = $singlePage;
        return view('admin.singlePage.edit', $data);
    }

    public function del(Request $request)
    {
        // todo 数据验证，id必须填，并且必须是大于一的整形数字

        $singlePage = SinglePage::where('id', $request->id)->first();
        // 检查信息是否存在，如果不存在，直接返回错误信息，后续逻辑不再处理
        if (empty($singlePage->id)) {
            $this->response->setMsg(500, '信息不存在');
            return $this->response->responseJSON();
        }

        $delRet = SinglePage::del($singlePage);
        if (!$delRet) {
            $this->response->setMsg(500, '删除失败');
            return $this->response->responseJSON();
        }

        return $this->response->responseJSON();
    }

}