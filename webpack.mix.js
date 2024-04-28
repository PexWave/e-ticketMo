const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .vue()
    .postCss("resources/css/app.css", [
        require("postcss-import"),
        require("tailwindcss"),
        require("autoprefixer"),
        require("@fortawesome/fontawesome-free/css/all.min.css"),
    ]);
