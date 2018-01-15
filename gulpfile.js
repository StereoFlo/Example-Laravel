var
  gulp         = require('gulp'), // Подключаем Gulp
  sass         = require('gulp-sass'), //Подключаем Sass пакет,
  browserSync  = require('browser-sync'), // Подключаем Browser Sync
  concat       = require('gulp-concat'), // Подключаем gulp-concat (для конкатенации файлов)
  uglify       = require('gulp-uglifyjs'), // Подключаем gulp-uglifyjs (для сжатия JS)
  cssnano      = require('gulp-cssnano'), // Подключаем пакет для минификации CSS
  rename       = require('gulp-rename'), // Подключаем библиотеку для переименования файлов
  del          = require('del'), // Подключаем библиотеку для удаления файлов и папок
  imagemin     = require('gulp-imagemin'), // Подключаем библиотеку для работы с изображениями
  pngquant     = require('imagemin-pngquant'), // Подключаем библиотеку для работы с png
  cache        = require('gulp-cache'), // Подключаем библиотеку кеширования
  autoprefixer = require('gulp-autoprefixer'),// Подключаем библиотеку для автоматического добавления префиксов
  pug          = require('gulp-pug');// Подключаем библиотеку для автоматического добавления префиксов

gulp.task('sass', function(){ // Создаем таск Sass
  return gulp.src('static/sass/**/main.scss') // Берем источник
  .pipe(sass()) // Преобразуем Sass в CSS посредством gulp-sass
  .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
  .pipe(cssnano())
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('static/css')) // Выгружаем результата в папку static/css
});

gulp.task('browser-sync', function() { // Создаем таск browser-sync
  browserSync({ // Выполняем browserSync
  server: { // Определяем параметры сервера
  baseDir: '' // Директория для сервера - static
  },
  notify: false // Отключаем уведомления
  });
});

gulp.task('scripts', function() {
  return gulp.src([ // Берем все необходимые библиотеки
    'static/libs/jQuery/dist/jquery.min.js', // Берем jQuery
    'static/libs/smoothscroll-for-websites/SmoothScroll.js',
    'static/libs/page-scroll-to-id/jquery.malihu.PageScroll2id.js',
    'static/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js',
    'static/libs/fotorama/fotorama.js',
    'static/libs/Tooltip/jquery.tooltip.js',
    'static/libs/fileuploader/jquery.fileuploader.js',
  ])
  .pipe(concat('libs.min.js')) // Собираем их в кучу в новом файле libs.min.js
  .pipe(uglify()) // Сжимаем JS файл
  .pipe(gulp.dest('static/js')); // Выгружаем в папку static/js
});

gulp.task('myScripts', function() {
  return gulp.src([ // Берем все необходимые библиотеки
  'static/js/common.js',
  ])
  .pipe(rename('common.min.js')) // Собираем их в кучу в новом файле libs.min.js
  .pipe(uglify()) // Сжимаем JS файл
  .pipe(gulp.dest('static/js'))
  .pipe(browserSync.reload({stream: true})); // Выгружаем в папку static/js
});

gulp.task('css-libs', ['sass'], function() {
  return gulp.src('static/css/libs.css') // Выбираем файл для минификации
  .pipe(cssnano()) // Сжимаем
  .pipe(rename({suffix: '.min'})) // Добавляем суффикс .min
  .pipe(gulp.dest('static/css')); // Выгружаем в папку static/css
});

gulp.task('watch', ['sass', 'scripts'], function() {
  gulp.watch('static/sass/**/*.scss', ['sass']); // Наблюдение за sass файлами в папке sass
  // gulp.watch('static/js/**/*.js', ['myScripts']);   // Наблюдение за JS файлами в папке js
  // gulp.watch('static/*.html', browserSync.reload);
});

gulp.task('clean', function() {
  return del.sync('dist'); // Удаляем папку dist перед сборкой
});

gulp.task('img', function() {
  return gulp.src('static/img/**/*') // Берем все изображения из static
  .pipe(cache(imagemin({  // Сжимаем их с наилучшими настройками с учетом кеширования
  interlaced: true,
  progressive: true,
  svgoPlugins: [{removeViewBox: false}],
  use: [pngquant()]
  })))
  .pipe(gulp.dest('dist/img')); // Выгружаем на продакшен
});

gulp.task('build', ['clean', 'img', 'sass', 'scripts'], function() {

  var buildCss = gulp.src([ // Переносим библиотеки в продакшен
  'static/css/main.css',
  'static/css/libs.min.css'
  ])
  .pipe(gulp.dest('dist/css'))

  var buildFonts = gulp.src('static/fonts/**/*') // Переносим шрифты в продакшен
  .pipe(gulp.dest('dist/fonts'))

  var buildJs = gulp.src('static/js/**/*') // Переносим скрипты в продакшен
  .pipe(gulp.dest('dist/js'))

  var buildVideo = gulp.src('static/video/**/*') // Переносим скрипты в продакшен
  .pipe(gulp.dest('dist/video'))

  var buildHtml = gulp.src('static/*.html') // Переносим HTML в продакшен
  .pipe(gulp.dest('dist'));

});

gulp.task('clear', function (callback) {
  return cache.clearAll();
})

gulp.task('default', ['watch']);
