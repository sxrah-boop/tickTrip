let mix = require("laravel-mix");

mix.sass("resources/sass/app.scss", "public/css/style.css")
    .js("resources/js/app.js", "resources/js/app.js")
    .extract(["vue", "axios", "lodash", "jquery", "bootstrap", "popper.js"])
    .browserSync({
        proxy: "http://localhost:8000",
        open: false,
        files: [
            "app/**/*.php",
            "resources/views/**/*.php",
            "public/js/**/*.js",
            "public/css/**/*.css",
        ],
    });

mix.sourceMaps();
