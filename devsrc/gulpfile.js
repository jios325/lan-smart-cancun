'use strict'
require('dotenv').config({path: './../.env'})

const gulp = require('gulp')
const stylus = require('gulp-stylus')
const clean = require('gulp-clean')
const plumber = require('gulp-plumber')
const rename = require('gulp-rename')
const autoprefixer = require('gulp-autoprefixer')
const minifycss = require('gulp-clean-css')
const mmq = require('gulp-merge-media-queries')
const nib = require('nib')
const browserSync = require('browser-sync')
const nunjucksRender = require('gulp-nunjucks-render')
const watch = require('gulp-watch')
const imagemin = require('gulp-imagemin')
const imageminJpg = require('imagemin-jpeg-recompress')
const imageminPng = require('imagemin-pngquant')
const rev = require('gulp-rev')

const awspublish = require('gulp-awspublish')
const awspublishRouter = require("gulp-awspublish-router")
const parallelize = require("concurrent-transform")
// cross-env
var isDev = (process.env.NODE_ENV === 'development')
let dirPublicFiles = [
  './../public/css/*'
]
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
  dev: ['styles', 'browser-sync', 'watch'
  ], // inicia los estilos y escucha los cambios
  prod: ['clean', 'styles', 'errorStyles'] // Eejecuta estilos
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
gulp.task('clean', () => {
  gulp.src(dirPublicFiles, {
    read: false
  }).pipe(clean({
    force: true
  }))
})
gulp.task('styles', function () {
  return (isDev) ?
    gulp.src('./src/styles/estilos.styl')
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
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(minifycss())
    .pipe(rev())
    .pipe(gulp.dest('./dist/css'))
    .pipe(browserSync.reload({
      stream: true
    })) :
    gulp.src('./src/styles/estilos.styl')
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
    .pipe(gulp.dest('./../public/css'))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(minifycss())
    .pipe(rev())
    .pipe(gulp.dest('./../public/css'))
})
// gulp.task('styles_hotspot', function () {
//   return (isDev) ?
//     gulp.src('./src/styles/hotspot/estilos.styl')
//     .pipe(plumber())
//     .pipe(stylus({
//       paths: ['node_modules'],
//       import: ['nib', 'rupture/rupture'],
//       use: [nib()],
//       'include css': true
//     }))
//     .pipe(autoprefixer({
//       browsers: ['last 2 versions', 'ios 6'],
//       cascade: false
//     }))
//     .pipe(rename({
//       suffix: '.min'
//     }))
//     .pipe(minifycss())
//     .pipe(rev())
//     .pipe(gulp.dest('./dist/css'))
//     .pipe(browserSync.reload({
//       stream: true
//     })) :
//     gulp.src('./src/styles/hotspot/estilos.styl')
//     .pipe(stylus({
//       paths: ['node_modules'],
//       import: ['nib', 'rupture/rupture'],
//       use: [nib()],
//       'include css': true
//     }))
//     .pipe(autoprefixer({
//       browsers: ['last 2 versions', 'ios 6'],
//       cascade: false
//     }))
//     .pipe(mmq({
//       log: true
//     }))
//     .pipe(gulp.dest('./../public/css/hotspot'))
//     .pipe(rename({
//       suffix: '.min'
//     }))
//     .pipe(minifycss())
//     .pipe(rev())
//     .pipe(gulp.dest('./../public/css/hotspot'))
// })
gulp.task('errorStyles', function () {
  return gulp
    .src('src/styles/error_404.styl')
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
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(minifycss())
    .pipe(rev())
    .pipe(gulp.dest('./../public/css'))
})
// gulp.task('templates', function () {
//   return gulp.src('src/templates/*.html')
//     .pipe(nunjucksRender({
//       path: ['src/templates/'] // String or Array
//     }))
//     .pipe(gulp.dest('./dist'))
// })
// gulp.task('movejsons', function () {
//   return gulp
//     .src([
//       'src/jsons/**'
//     ])
//     .pipe(gulp.dest('dist/jsons'))
// })

// enviar a CDN los JS, CSS, FONTS e IMG
// gulp.task('publish', function () {
//   let publisher = awspublish.create({
//     endpoint: process.env.AWS_URL + '/assets',
//     // region: 'sfo2',
//     accessKeyId: process.env.AWS_ACCESS_KEY_ID,
//     secretAccessKey: process.env.AWS_SECRET_ACCESS_KEY,
//     params: {
//       Bucket: process.env.AWS_BUCKET
//     }
//   })
//   return (
//     gulp
//     .src('./../public/*/**')
//     .pipe(awspublishRouter({
//       cache: {
//         // cache for 5 minutes by default
//         cacheTime: 300
//       },
//       routes: {
//         "^.+$": "$&"
//       }
//     }))
//     // .pipe(awspublish.gzip({ext: '.gz'}))
//     .pipe(parallelize(publisher.publish(), 50))
//     .pipe(publisher.sync())
//     .pipe(awspublish.reporter())
//   )
// })

gulp.task('watch', function () {
  watch(['src/styles/**/*.styl'], function () {
    gulp.start(['styles', 'errorStyles'])
  })
  // watch(['src/templates/**/*.html'], function () {
  //   gulp.start(['templates'])
  // })
  // watch(['dist/**/*.html'], function () {
  //   gulp.start(['bs-reload'])
  // })
  // watch(['src/img/**/*.+(png|jpeg|jpg|gif|svg)'], function () {
  //   gulp.start(['images'])
  // })
})

gulp.task('default', taskArray.dev)

gulp.task('prod', taskArray.prod)
