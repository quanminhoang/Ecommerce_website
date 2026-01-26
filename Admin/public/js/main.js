const app = {
    // 1. Xử lý Giao diện (Navbar, Scroll Top)
    handleUIEvents: function () {
        const headerBottom = document.querySelector('#navbar');
        const toTop = document.querySelector('#toTop');

        if (headerBottom && toTop) {
            window.onscroll = function () {
                const scrollTop = document.documentElement.scrollTop || window.scrollY;
                
                // Navbar dính
                if (scrollTop >= 50) {
                    headerBottom.style.position = 'fixed';
                    headerBottom.style.top = '0';
                    headerBottom.style.zIndex = '1000';
                    headerBottom.style.width = '100%';
                } else {
                    headerBottom.style.position = 'relative';
                }

                // Nút lên đầu trang
                if (scrollTop >= 50) {
                    toTop.style.display = 'block';
                } else {
                    toTop.style.display = 'none';
                }

                if (scrollTop > 100) {
                    toTop.style.opacity = 1;
                } else {
                    toTop.style.opacity = 0;
                }
            };

            toTop.onclick = function () {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            };
        }
    },

    // 2. Xử lý Bảng dữ liệu (DataTable)
    handleDataTable() {
        try {
            $(document).ready(function () {
                if ($('#table').length) {
                    const height = $('#sidebar').height() - 250;
                    const table = $('#table').DataTable({
                        lengthChange: false,
                        info: false,
                        pageLength: 15,
                        scrollY: height,
                        scrollX: true,
                        language: {
                            paginate: { previous: 'Prev', next: 'Next' },
                        },
                    });

                    $('#myInputTextField').keyup(function () {
                        table.search($(this).val()).draw();
                    });

                    if ($(window).height() >= 900) {
                        table.page.len(15).draw();
                    } else {
                        table.page.len(8).draw();
                    }

                    $('#rowsPerPage').on('change', function () {
                        let row = $('#rowsPerPage').val();
                        table.page.len(row).draw();
                    });
                }
            });
        } catch (error) {
            return;
        }
    },

    // 3. Xử lý Tính toán giá (Form)
    handlePriceCalculation: function() {
        const priceInput = document.getElementById('price');
        const discountInput = document.getElementById('discount');
        const promotionPriceInput = document.getElementById('promotionPrice');

        if (priceInput && discountInput && promotionPriceInput) {
            
            const calculate = () => {
                let priceRaw = priceInput.value;
                let discountRaw = discountInput.value;

                // Xóa dấu chấm (1.000.000 -> 1000000)
                if (priceRaw) {
                    priceRaw = priceRaw.toString().replace(/\./g, '');
                }

                let price = parseFloat(priceRaw) || 0;
                let discount = parseFloat(discountRaw) || 0;

                if (discount < 0) discount = 0;
                if (discount > 100) discount = 100;

                if (price > 0) {
                    let finalPrice = price - (price * (discount / 100));
                    promotionPriceInput.value = Math.round(finalPrice);
                } else {
                    promotionPriceInput.value = 0;
                }
            };

            // Lắng nghe sự kiện gõ phím
            priceInput.addEventListener('input', calculate);
            discountInput.addEventListener('input', calculate);
            priceInput.addEventListener('keyup', calculate);
            discountInput.addEventListener('keyup', calculate);

            // [QUAN TRỌNG] Chạy tính toán ngay lập tức khi load trang
            // Để sửa lỗi hiển thị giá cũ trong Database
            calculate(); 
        }
    },

    // 4. Khởi chạy
    start() {
        this.handleUIEvents();          // Chạy Navbar, Scroll
        this.handleDataTable();         // Chạy bảng
        this.handlePriceCalculation();  // Chạy tính giá
    },
};

app.start();