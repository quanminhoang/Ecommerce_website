// App
const app = {
    //----- Function handle ------
    // Handle event
    handleEvent: function () {
        const headerBottom = document.querySelector('#navbar');
        const toTop = document.querySelector('#toTop');

        document.onscroll = function () {
            const scrollTop =
                document.documentElement.scrollTop || window.scrollY;

            // Handle navbar
            if (scrollTop >= 50) {
                headerBottom.style.position = 'fixed';
            } else {
                headerBottom.style.position = 'relative';
            }

            // Handle button to top
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

            toTop.onclick = function () {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            };
        };
    },

    // function start
    start: function () {
        this.handleEvent();
    },
};

// Init function start
app.start();
