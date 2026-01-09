<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức Về Giày</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .news-container {
            max-width: 800px;
            margin: auto;
        }

        .news-item {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
        }

        .news-item h2 {
            font-size: 24px;
            margin: 0;
            color: #2c3e50;
        }

        .news-item p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .news-item a {
            color: #3498db;
            text-decoration: none;
        }

        .news-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="news-container">
        <h1>Tin Tức Về Giày</h1>

        <?php
        // Mảng lưu trữ thông tin tin tức về giày
        $newsList = [
            [
                "title" => "Xu Hướng Giày Thể Thao 2024",
                "description" => "Năm 2024 hứa hẹn sẽ bùng nổ với những mẫu giày thể thao độc đáo, kết hợp công nghệ và thời trang để mang lại sự thoải mái và phong cách...",
                "link" => "#"
            ],
            [
                "title" => "5 Mẫu Giày Không Thể Thiếu Trong Tủ Đồ",
                "description" => "Từ giày sneaker cho đến giày tây, đây là 5 mẫu giày mà bất kỳ ai cũng nên sở hữu để có thể phối hợp với nhiều phong cách khác nhau...",
                "link" => "#"
            ],
            [
                "title" => "Cách Chăm Sóc Giày Da Đúng Cách",
                "description" => "Giày da cần được chăm sóc đúng cách để giữ được độ bền và vẻ đẹp. Hãy tìm hiểu các mẹo đơn giản để bảo vệ đôi giày yêu thích của bạn...",
                "link" => "#"
            ],
            [
                "title" => "Giày Sneaker Mới Ra Mắt Đang Gây Sốt",
                "description" => "Các thương hiệu giày lớn đang tung ra những mẫu sneaker mới với thiết kế và công nghệ tiên tiến. Những mẫu giày này đang gây sốt trong cộng đồng yêu giày...",
                "link" => "#"
            ],
            [
                "title" => "Phối Đồ Với Giày Boot Cho Mùa Thu Đông",
                "description" => "Giày boot là lựa chọn hoàn hảo cho mùa thu đông. Hãy khám phá cách phối đồ với giày boot để luôn phong cách và ấm áp...",
                "link" => "#"
            ]
        ];

        // Lặp qua mảng và hiển thị từng tin tức
        foreach ($newsList as $news) {
            echo '<div class="news-item">';
            echo '<h2><a href="' . $news['link'] . '">' . htmlspecialchars($news['title']) . '</a></h2>';
            echo '<p>' . htmlspecialchars($news['description']) . '</p>';
            echo '</div>';
        }
        ?>

    </div>

</body>

</html>