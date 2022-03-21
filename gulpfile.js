"use strict";

const del          = require('del');
const {
	src,
	dest,
	watch,
	series,
	parallel
}                  = require('gulp');
const plumber      = require('gulp-plumber');
const sass         = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');

function compile1(done) {
	src('./assets/stylesheets/sass/src/style.scss')
	.pipe(plumber())
	.pipe(sass.sync({
		includePaths: './assets/stylesheets/sass/preset'
	}))
	.pipe(autoprefixer())
	.pipe(dest('./'));

	done();
}

function watch1(done) {
	watch([
		'./assets/stylesheets/sass/src/style.scss',
		'./assets/stylesheets/sass/src/style/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], compile1);

	done();
}

function compile2(done) {
	src('./assets/stylesheets/sass/src/admin/style_admin.scss')
	.pipe(plumber())
	.pipe(sass.sync({
		includePaths: [
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
		]
	}))
	.pipe(autoprefixer())
	.pipe(dest('./assets/stylesheets/css/admin'));

	done();
}

function watch2(done) {
	watch([
		'./assets/stylesheets/sass/src/_define.scss',
		'./assets/stylesheets/sass/src/admin/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], compile2);

	done();
}

function compile3(done) {
	src('./assets/stylesheets/sass/src/editor/block_editor_style.scss')
	.pipe(plumber())
	.pipe(sass.sync({
		includePaths: [
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/src/editor',
			'./assets/stylesheets/sass/preset',
		]
	}))
	.pipe(autoprefixer())
	.pipe(dest('./assets/stylesheets/css/editor'));

	done();
}

function watch3(done) {
	watch([
		'./assets/stylesheets/sass/src/_define.scss',
		'./assets/stylesheets/sass/src/editor/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], compile3);

	done();
}

function del4(done) {
	del('./assets/stylesheets/css/core');

	done();
}

function compile4(done) {
	src([
		'./assets/stylesheets/sass/src/block/**/*.scss',
	])
	.pipe(plumber())
	.pipe(sass.sync({
		includePaths: [
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
			'./assets/stylesheets/sass/src/block',
		]
	}))
	.pipe(autoprefixer())
	.pipe(dest('./assets/stylesheets/css'));

	done();
}

function watch4(done) {
	watch([
		'./assets/stylesheets/sass/src/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], series(del4, compile4));

	done();
}

exports.compile = parallel([
	series(compile1, watch1),
	series(compile2, watch2),
	series(compile3, watch3),
	series(del4, compile4, watch4),
]);
