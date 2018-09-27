'use strict'
const gulp = require('gulp')
const fs = require('fs')
const stylus = require('gulp-stylus')
// const clean = require('gulp-clean')
const plumber = require('gulp-plumber')
const rename = require('gulp-rename')
const data = require('gulp-data')
const autoprefixer = require('gulp-autoprefixer')
const minifycss = require('gulp-clean-css')
const mmq = require('gulp-merge-media-queries')
// const staticI18nHtml = require('gulp-static-i18n-html')
const nib = require('nib')
const browserSync = require('browser-sync')
const nunjucksRender = require('gulp-nunjucks-render')
const watch = require('gulp-watch')
// const imagemin = require('gulp-imagemin')
// const imageminJpg = require('imagemin-jpeg-recompress')
// const imageminPng = require('imagemin-pngquant')
// cross-env
var isDev = (process.env.NODE_ENV === 'development')
// let dirPublicFiles = [
//   './../public/css/*'
// ]
gulp.task('browser-sync', function () {
  browserSync({
    server: {
      open: false,
      baseDir: './',
      directory: true
    }
  })
})
gulp.task('bs-reload', function () {
  browserSync.reload()
})
// separar las tareas por entorno
var taskArray = {
  dev: ['html', 'styles', 'browser-sync', 'watch'], // inicia los estilos y escucha los cambios
  prod: ['styles','copy']// Eejecuta estilos
}
// gulp.task('images', () => {
//   gulp
//     .src('./src/img/**/*.+(png|jpeg|jpg|gif|svg)')
//     .pipe(imagemin([imageminPng(), imageminJpg()], {
//       progressive: true,
//       optimizationLevel: 5
//     }))
//     .pipe(gulp.dest('./dist/img'))
// })

// gulp.task('clean', () => {
//   gulp.src(dirPublicFiles, { read: false }).pipe(clean({ force: true }))
// })
gulp.task('styles', function () {
  return (isDev)
  ? gulp.src('./src/styles/estilos.styl')
  .pipe(plumber())
  .pipe(stylus({
    paths: ['node_modules'],
    import: ['nib', 'rupture/rupture'],
    use: [nib()],
    'include css': true
  }))
  .pipe(autoprefixer({
    browsers: ['last 2 versions', 'ios 6'],
    cascade: false
  }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest('./dist/css'))
    .pipe(browserSync.reload({ stream: true }))
  : gulp.src('./src/styles/estilos.styl')
  .pipe(stylus({
    paths: ['node_modules'],
    import: ['nib', 'rupture/rupture'],
    use: [nib()],
    'include css': true
  }))
  .pipe(autoprefixer({
    browsers: ['last 2 versions', 'ios 6'],
    cascade: false
  }))
  .pipe(mmq({
    log: true
  }))
    .pipe(gulp.dest('./dist/css'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest('./dist/css'))
})
// gulp.task('templates', function () {
//   return gulp.src('src/templates/*.html')
//     .pipe(nunjucksRender({
//       path: ['src/templates/'] // String or Array
//     }))
//     .pipe(gulp.dest('./dist'))
// })
gulp.task('copy', function () {
  gulp.src('./dist/es/index.html')
      .pipe(gulp.dest('./dist'));
});
gulp.task('html', function() {
  fs.readdir('./languages/',function(err,files){
      if(err) throw err;
          files.forEach(function(file){
              var language = file.split('.')[0];
              console.log(language)
              // Gets .html and .nunjucks files in pages
              return gulp.src('src/templates/*.html')
              // Adding data to Nunjucks
              .pipe(data(function() {
                  return require('./languages/' + language + '.json')
              }))
              // Renders template with nunjucks
              .pipe(nunjucksRender({
                path: ['src/templates/'] // String or Array
              }))
              .pipe(gulp.dest('./dist/' + language));
      });
  });
});
gulp.task('watch', function () {
  watch(['src/styles/**/*.styl'], function () {
    gulp.start(['styles'])
  })
  watch(['src/templates/**/*.html'], function () {
    gulp.start(['html','copy'])
  })
  watch(['dist/**/*.html'], function () {
    gulp.start(['bs-reload'])
  })
  // watch(['src/img/**/*.+(png|jpeg|jpg|gif|svg)'], function () {
  //   gulp.start(['images'])
  // })
})

gulp.task('default', taskArray.dev)

gulp.task('prod', taskArray.prod)
