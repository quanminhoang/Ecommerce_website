<?php
class BrandController extends BaseController
{
    private $brandModel;

    public function __construct()
    {
        $this->brandModel = $this->model('BrandModel');
    }

    public function sayHi()
    {
        $listBrands = $this->brandModel->getBrands();
        $this->view(
            'main-layout',
            ['page' => 'brands/index', 'pageName' => 'Hãng', 'brands' => $listBrands]
        );
    }

    public function add()
    {
        $this->view(
            'main-layout',
            ['page' => 'brands/addBrand', 'pageName' => 'Thêm hãng']
        );
    }

    public function search()
    {
        $name = $_POST['name'];
        if ($name) {
            $brands = $this->brandModel->searchBrands($name);
            $this->view(
                'main-layout',
                [
                    'page' => 'brands/searchBrand',
                    'pageName' => 'Tìm kiếm hãng sản phẩm',
                    'brands' => $brands
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
            $data  = ['Name' => $name];
            $this->brandModel->createBrand($data);
            header("location:add");
        } else {
            header("location:add");
        }
    }

    public function edit($id)
    {
        $brand = $this->brandModel->getBrand($id);
        $this->view(
            'main-layout',
            ['page' => 'brands/editBrand', 'pageName' => 'Cập nhật hãng', 'brand' => $brand]
        );
    }

    public function update($id)
    {
        $data = [];
        $name = $_POST['name'];
        $brand = $this->brandModel->getBrand($id);


        if ($name) {
            if ($name != $brand['Name']) {
                $data['Name'] = $name;
            }
        }

        if (count($data) > 0) {
            $this->brandModel->updateBrand($id, $data);
            header("location:../edit/${id}");
        } else {
            header("location:../edit/${id}");
        }
    }

    public function delete()
    {
        $productModel = $this->model('ProductModel');
        $id = $_POST['id'];
        if ($id) {
            $productsByBrand = $productModel->getProductsByBrand($id);
            $numProductsByBrand = mysqli_num_rows($productsByBrand);
            if ($numProductsByBrand == 0) {
                $this->brandModel->deleteBrand($id);
                header("location:sayHi");
            } else {
                header("location:sayHi");
            }
        } else {
            header("location:sayHi");
        }
    }
}
