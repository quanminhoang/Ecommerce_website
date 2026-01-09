<?php
class Func
{

    private $url;


    public function __construct()
    {
        if (isset($_REQUEST['url'])) {
            $this->url =  explode('/', filter_var(trim($_REQUEST['url'], '/')));
        }
    }

    public function getUrl()
    {
        return $this->url;
    }



    function handleActive($name)
    {
        if (empty($this->url)) {
            $display = 'active';
        }
        if ($this->url[0] == $name) {
            $active = 'active';
        }

        return ['active' => $active, 'display' => $display];
    }




    public function handleDisplayPageLink()
    {

        $url = $this->url;
        if (isset($url[1]) && $url[1] !== 'sayHi') {
            return ['display' => 'display:flex', 'url' => $url];
        }
    }

    public function handlePaddingContent()
    {
        $url = $this->url;
        if (isset($url[1]) && $url[1] !== 'sayHi') {
            return 'padding:40px 20px 20px 20px;';
        }
    }

    public function handleNameController()
    {

        switch ($this->url[0]) {
            case 'product':
                return 'Sản phẩm';
                break;
            case 'category':
                return 'Danh mục';
                break;
            case 'brand':
                return 'Hãng sản phẩm';
                break;
            case 'supplier':
                return 'Nhà cung cấp';
                break;
            case 'customer':
                return 'Khách hàng';
                break;
            case 'order':
                return 'Đơn hàng';
                break;
        }
    }

    public function handleNameAction()
    {
        switch ($this->url[1]) {
            case 'add':
                return "Thêm " . strtolower($this->handleNameController());
                break;
            case 'show':
                return "Chi tiết " . strtolower($this->handleNameController());
                break;
            case 'edit':
                return "Cập nhật " . strtolower($this->handleNameController());
                break;
            case 'search':
                return "Tìm kiếm " . strtolower($this->handleNameController());
                break;
        }
    }
}
