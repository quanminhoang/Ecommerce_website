<?php
class SupplierController extends BaseController
{
    private $supplierModel;
    public function __construct()
    {
        $this->supplierModel = $this->model('SupplierModel');
    }

    public function sayHi()
    {
        $listSupplier = $this->supplierModel->getSuppliers();
        $this->view(
            'main-layout',
            [
                'page' => 'suppliers/index',
                'pageName' => 'Nhà cung cấp',
                'suppliers' => $listSupplier
            ]
        );
    }

    public function add()
    {
        $this->view(
            'main-layout',
            [
                'page' => 'suppliers/addSupplier',
                'pageName' => 'Thêm nhà cung cấp'
            ]
        );
    }

    public function search()
    {
        $name = $_POST['name'];
        if ($name) {
            $suppliers = $this->supplierModel->searchSuppliers($name);
            $this->view(
                'main-layout',
                [
                    'page' => 'suppliers/searchSupplier',
                    'pageName' => 'Tìm kiếm hãng sản phẩm',
                    'suppliers' => $suppliers
                ]
            );
        } else {
            header('Location:sayHi');
        }
    }

    public function create()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];

        $data  = [
            'Name' => $name,
            'Email' => $email,
            'PhoneNumber' => $phoneNumber,
            'Address' => $address,
        ];

        if ($name && $email && $phoneNumber && $address) {
            $this->supplierModel->createSupplier($data);
            header("location:add");
        } else {
            header("location:add");
        }
    }

    public function edit($id)
    {
        $supplier = $this->supplierModel->getSupplier($id);
        $this->view(
            'main-layout',
            [
                'page' => 'suppliers/editSupplier',
                'pageName' => 'Cập nhật nhà cung cấp',
                'supplier' => $supplier
            ]
        );
    }

    public function update($id)
    {
        $data = [];
        $supplier = $this->supplierModel->getSupplier($id);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];

        if ($name && $email && $phoneNumber && $address) {
            if ($name != $supplier['Name']) {
                $data['Name'] = $name;
            }

            if ($email != $supplier['Email']) {
                $data['Email'] = $email;
            }

            if ($phoneNumber != $supplier['PhoneNumber']) {
                $data['PhoneNumber'] = $phoneNumber;
            }

            if ($address != $supplier['Address']) {
                $data['Address'] = $address;
            }
        } else {
            header("location:../edit/${id}");
        }

        if ((count($data) > 0)) {
            $this->supplierModel->updateSupplier($id, $data);
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
            $productsBySupplier = $productModel->getProductsBySupplier($id);
            $numProductsBySupplier = mysqli_num_rows($productsBySupplier);
            if ($numProductsBySupplier == 0) {
                $this->supplierModel->deleteSupplier($id);
                header("location:sayHi");
            } else {
                header("location:sayHi");
            }
        } else {
            header("location:sayHi");
        }
    }
}
