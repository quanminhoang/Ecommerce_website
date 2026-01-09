<?php
class CategoryController extends BaseController
{
    private $categoryModel;


    public function __construct()
    {
        $this->categoryModel = $this->model('CategoryModel');
    }

    public function sayHi()
    {
        $Categories = $this->categoryModel->getCategories();
        $this->view('main-layout', [
            'page' => 'categories/index',
            'pageName' => 'Danh mục',
            'categories' => $Categories
        ]);
    }



    public function add()
    {
        $Categories = $this->categoryModel->getCategories();
        $this->view('main-layout', [
            'page' => 'categories/addCategory',
            'pageName' => 'Thêm danh mục',
            'categories' => $Categories
        ]);
    }

    public function search()
    {
        $name = $_POST['name'];
        if ($name) {
            $categories = $this->categoryModel->searchCategories($name);
            $this->view(
                'main-layout',
                [
                    'page' => 'categories/searchCategory',
                    'pageName' => 'Tìm kiếm danh mục sản phẩm',
                    'categories' => $categories
                ]
            );
        } else {
            header('Location:sayHi');
        }
    }

    public function create()
    {
        $name = $_POST['name'];
        if ($name) {
            $data = ['Name' => $name];
            $this->categoryModel->createCategory($data);
            header("location:add");
        } else {
            header("location:add");
        }
    }

    public function edit($id)
    {
        $category = $this->categoryModel->getCategory($id);
        $this->view('main-layout', [
            'page' => 'categories/editCategory',
            'pageName' => 'Thêm danh mục',
            'category' => $category,
        ]);
    }

    public function update($id)
    {
        $data = [];
        $name = $_POST['name'];
        $category = $this->categoryModel->getCategory($id);

        if ($name != $category['Name']) {
            $data['Name'] = $name;
        }

        if (count($data) > 0) {
            $this->categoryModel->updateCategory($id, $data);
            header("location:../edit/${id}");
        } else {
            header("location:edit/$id");
        }
    }

    public function delete()
    {
        $productModel = $this->model('ProductModel');
        $id = $_POST['id'];
        if ($id) {
            $productsByCategory = $productModel->getProductsByCategory($id);
            $numProductsByCategory = mysqli_num_rows($productsByCategory);
            if ($numProductsByCategory > 0) {
                $productModel->deleteProductByCategory($id);
            }
            $this->categoryModel->deleteCategory($id);
            header("location:sayHi");
        } else {
            header("location:sayHi");
        }
    }
}
