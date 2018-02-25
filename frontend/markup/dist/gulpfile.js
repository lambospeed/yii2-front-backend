var gulp       = require('gulp'),
    sass         = require('gulp-sass'),
    concat       = require('gulp-concat'),
    cssnano      = require('gulp-cssnano'),
    rename       = require('gulp-rename'),
    autoprefixer = require('gulp-autoprefixer'),
    connect    = require('gulp-connect'),
    livereload = require('gulp-livereload'),
    sourcemaps = require('gulp-sourcemaps');

gulp.task('connect', function() {
    connect.server({
        root:'',
        livereload:true
    });

});

gulp.task('sass', function(){ // Создаем таск Sass
    return gulp.src('app/sass/style.sass') // Берем источник
        .pipe(sourcemaps.init())
        .pipe(sass()) // Преобразуем Sass в CSS посредством gulp-sass
        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('app/css')) // Выгружаем результата в папку app/css
        .pipe(connect.reload());
});

gulp.task('html', function () {
    gulp.src('index.html')
        .pipe(connect.reload());
});



gulp.task('sass-watch', function() {
    return gulp.src('app/sass/style.css') // Выбираем файл для минификации
        .pipe(cssnano()) // Сжимаем
        .pipe(rename({suffix: '.min'})) // Добавляем суффикс .min
        .pipe(gulp.dest('css/')); // Выгружаем в папку app/css
});

gulp.task('watch', function () {
    gulp.watch('app/sass/style.sass', ['sass']);
    gulp.watch('index.html', ['html']);
});


gulp.task('default', ['watch', 'sass-watch', 'connect', 'sass', 'html']);