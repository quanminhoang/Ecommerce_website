const app = {
    handleDataTable() {
        try {
            $(document).ready(function () {
                const height = $('#sidebar').height() - 250;
                table = $('#table').DataTable({
                    lengthChange: false,
                    info: false,
                    pageLength: 15,
                    scrollY: height,
                    scrollX: true,
                    language: {
                        paginate: {
                            previous: 'Prev',
                            next: 'Next',
                        },
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
            });
        } catch (error) {
            return;
        }
    },
    start() {
        this.handleDataTable();
    },
};

app.start();
