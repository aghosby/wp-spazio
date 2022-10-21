# StarBoxTech WordPress Starter Theme 
StarBoxTech default minimal WordPress starter theme based on Boostrap 5 framework. This starter theme uses WPGulp, an advanced & extensively documented Gulp WordPress workflow 🔥.

![StarBoxTech WordPress Starter Theme ](screenshot.jpg)

## Built with
- [WordPress](https://wordpress.org/)
- [Underscores (_s) Theme](https://github.com/Automattic/_s)
- [WPGulp](https://github.com/ahmadawais/WPGulp)
- [Bootstrap 5](https://github.com/twbs/bootstrap)
- [SASS](https://sass-lang.com/)
- [jQuery](https://jquery.com/)
- [Slick](https://kenwheeler.github.io/slick/)
- [Font Awesome 5](https://fontawesome.com/v5/changelog/latest)

## Requirements
 - NPM
 - Composer

## Install
**NB:** This is a template repository. **Please do not install a new site on this repository!**

1. To install this starter theme on a new project, create a new repository using this as a template. The steps are detailed in the **Set up Website Theme** section of the SBX WordPress Development Guide.
2. Once a new repository has been created from this one, run the command below to install the site and tart the frontend development build. Make sure to update the GitHub repository URL to that of the newly-created repository.

```
    git clone git@github.com:starboxtech/the_new_project_repo.git
    composer install
    npm install
    npm audit fix
    npm start
```

## Gulp Tasks
Detailed explanation found in `gulfile.babel.js`.
### styles
Compiles Sass, Autoprefixes it and Minifies CSS.
```
gulp styles
```

### stylesRTL
Compiles Sass, Autoprefixes it, Generates RTL stylesheet, and Minifies CSS.
```
gulp stylesRTL
```

### vendorsJS
Concatenate and uglify vendor JS scripts. e.g. Bootstrap
```
gulp vendorsJS
```

### customJS
Concatenate and uglify custom JS scripts.
```
gulp customJS
```

### images
Minifies PNG, JPEG, GIF and SVG images.
```
gulp images
```

### fonts
Copies font files to build directory.
```
gulp fonts
```

### clear-images-cache
Deletes the images cache. By running the "images" task next, each image will be regenerated.
```
gulp clear-images-cache
```

### translate
WP POT Translation File Generator.
```
gulp translate
```

### zip
Zips theme or plugin and places in the parent directory
```
gulp zip
```

### default
Watches for file changes and runs specific tasks.
```
gulp
```
OR
```
gulp default
```

## Contributors
- Osita Ugwueze (@OsitaNathan)

## License
Copyright (c) 2022 StarBox Technologies Ltd.

For enquiries please contact us at [hello@starboxtech.com](mailto:hello@starboxtech.com).
