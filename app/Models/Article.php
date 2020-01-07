<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/6
 * Time: 13:48
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * 添加文章
     * @param array $data
     * @return bool
     */
    public static function add(array $data)
    {
        $article = new Article();
        $article->category_id = $data['category_id'];
        $article->title = $data['title'];
        !empty($data['abstract']) && $article->abstract = $data['abstract'];
        !empty($data['keyword']) && $article->keyword = $data['keyword'];
        !empty($data['main_pic']) && $article->main_pic = $data['main_pic'];
        !empty($data['group_pic']) && $article->group_pic = $data['group_pic'];
        !empty($data['link']) && $article->link = $data['link'];
        !empty($data['content']) && $article->content = $data['content'];
        !empty($data['is_top']) && $article->is_top = (int)$data['is_top'];
        !empty($data['is_recommended']) && $article->is_recommended = (int)$data['is_recommended'];
        !empty($data['is_rolling']) && $article->is_rolling = (int)$data['is_rolling'];
        !empty($data['is_release']) && $article->is_release = (int)$data['is_release'];
        !empty($data['sort']) && $article->sort = (int)$data['sort'];
        !empty($data['file']) && $article->file = $data['file'];

        return $article->save();


    }

    /**
     * 编辑文章
     * @param Article $article
     * @param $data
     * @return bool
     */
    public static function edit(Article $article, $data)
    {
        isset($data['category_id']) && $article->category_id = $data['category_id'];
        isset($data['title']) && $article->title = $data['title'];
        isset($data['abstract']) && $article->abstract = $data['abstract'];
        isset($data['keyword']) && $article->keyword = $data['keyword'];
        isset($data['main_pic']) && $article->main_pic = $data['main_pic'];
        isset($data['group_pic']) && $article->group_pic = $data['group_pic'];
        isset($data['link']) && $article->link = $data['link'];
        isset($data['content']) && $article->content = $data['content'];
        isset($data['is_top']) && $article->is_top = (int)$data['is_top'];
        isset($data['is_recommended']) && $article->is_recommended = (int)$data['is_recommended'];
        isset($data['is_rolling']) && $article->is_rolling = (int)$data['is_rolling'];
        isset($data['is_release']) && $article->is_release = (int)$data['is_release'];
        isset($data['sort']) && $article->sort = (int)$data['sort'];
        isset($data['file']) && $article->file = $data['file'];

        return $article->update();

    }

    public static function lists(array $conditions, int $page = 0, int $parPage = 15)
    {
        // 获取指定分类下的所有分类ID，用于查询指定分类下的所有文章。也就是把该分类下的所有子级的id都查询出来
        // 比如，新闻分类下有公司新闻和行业信息，如果选择的是公司新闻，那么行业新闻和公司新闻都必须出现
        $categoryIds = [];
        if (!empty($conditions['category_id'])) {
            $category = Category::getCategoryChildrenIdsByParentId($conditions['category_id']);

        }

        $category = Article::with('category');
        !empty($categoryIds) && $category->whereIn('category_id', $categoryIds);
        !empty($conditions['title']) && $category->where('title', 'like', "{$conditions['title']}%"); // 模糊匹配标题查询
        !empty($conditions['is_top']) && $category->where('is_top', (int)$conditions['is_top']);
        !empty($conditions['is_recommended']) && $category->where('is_recommended', (int)$conditions['is_recommended']);
        !empty($conditions['is_rolling']) && $category->where('is_rolling', (int)$conditions['is_rolling']);
        !empty($conditions['is_release']) && $category->where('is_release', (int)$conditions['is_release']);
        !empty($conditions['begin_time']) && $category->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($conditions['begin_time'])));
        !empty($conditions['end_time']) && $category->where('created_at', '<', date('Y-m-d H:i:s', strtotime('+1 day', strtotime($conditions['begin_time']))));

        $category->where('is_del', 0);
        $category->orderBy('id', 'DESC');

        return $category->paginate($parPage, ['*'], 'page', $page);
    }

    /**
     * 发布文章
     * @param Article $article
     * @return bool
     */
    public static function release(Article $article)
    {
        $article->is_release = !$article->is_release;
        return $article->update();
    }

    /**
     * 删除
     * @param array $ids
     * @return bool
     */
    public static function del(array $ids)
    {

        return Article::whereIn('id', $ids)->update(['is_del' => 1]);
    }
}